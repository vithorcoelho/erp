<?php
class Vendas extends MX_Controller
{
	private $tabela_order = array('id'=>'DESC');
	private $tabela_limit = 50;

	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('css_html', 'form', 'functions'));
		$this->load->library('form_validation');
		$this->load->model(array('Vendas_model', 'Produtos_model', 'Clientes_model', 'Listavendas_model', 'Fluxo_model'));

		login_verify();
	}

	public function index()
	{
		$dados['page_titulo'] = 'Vendas';

		$dados['paginacao'] = $this->PaginacaoVendas();

		$rota_start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$tabela_vendas = $this->Vendas_model->getVendas('id, idcliente, data, chave, status, total', null,  array('id' => 'DESC'), $this->tabela_limit, $rota_start);
			
		// Pega os registros de vendas e busca os clientes pelo id da tabela clientes

		if($tabela_vendas)
		{
			foreach ($tabela_vendas as $colunas_vendas)
		    {
				$tabela_cliente = $this->Clientes_model->getClientes(null, array('id'=>$colunas_vendas->idcliente));
				
				if($tabela_cliente)
				{
					$colunas_vendas->nome = $tabela_cliente[0]->nome;
					$vendas[] = $colunas_vendas;
				}
			}
			$dados['vendas'] = $vendas;
		}

		$this->load->view('vendas', $dados);
	}

	public function CookieFiltroProduto()
	{
	}

	public function PaginacaoVendas()
	{
		$this->load->helper('paginacao');
		
		return createPaginate('vendas/index/', $this->Vendas_model->countAll(), $this->tabela_limit, 3);
	}

	public function Ajax_ModalCadastraVenda()
	{
		$dados['clientes'] = $this->Clientes_model->getClientes('id, nome', null, array('nome' => 'ASC'));
		
		$this->load->view('include_addvendas', $dados);
	}

	#
	# CRUD ERP VENDAS
	# 

	public function Ajax_CadastrarVenda()
	{
		$post = $this->input->post();

		$total = 0;
		$chave = date('Ymdhis');

		foreach ($post['produtos'] as $key => $value)
		{
			$total += (floatval($post['preco'][$key]) * $post['quantidade'][$key]);

			$query_venda = array(
				'idcliente' => $post['cliente'],
				'produto' => $value, 
				'preco' => $post['preco'][$key], 
				'quantidade' => $post['quantidade'][$key], 
				'chave' => $chave
			);

			$this->Listavendas_model->insertLista($query_venda);
		}

		$this->Vendas_model->insertVenda(array('idcliente'=>$post['cliente'], 'data'=>date('Y-m-d'), 'chave'=>0, 'status'=>$post['status'], 'total'=>$total, 'chave'=>$chave));
		$this->Fluxo_model->inFluxo(array('tipo'=>'Receita', 'data'=>date('Y-m-d'),'descricao'=>'Venda de mercadoria', 'valor'=>$total, 'SKU'=>$chave));

		echo json_encode('Venda cadastrada com sucesso!');
	}

	public function DadosVenda()
	{
		$dados['titulo'] = 'Venda';

		$dados['venda'] = $this->Vendas_model->getVendas(null, array('chave'=>$this->uri->segment(3)), null, 1);
		$dados['cliente'] = $this->Clientes_model->getClientes(null, array('id'=>$dados['venda'][0]->idcliente), null, 1);
		$dados['produtos'] = $this->Listavendas_model->getLista(array('chave'=>$this->uri->segment(3)));
		
		$this->load->view('dadosvenda', $dados);
	}

	public function DeletarVenda()
	{
		$this->Vendas_model->deleteVenda(array('chave'=>$this->uri->segment(3)));
		$this->Listavendas_model->deleteLista(array('chave'=>$this->uri->segment(3)));
		$this->Fluxo_model->deleteFluxo(array('SKU'=>$this->uri->segment(3)));

		redirect('vendas');
	}
}