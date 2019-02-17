<?php
class Vendas extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('css_html', 'form', 'functions', 'login_verify'));
		$this->load->library('form_validation');
		$this->load->model(array('Vendas_model', 'Produtos_model', 'Clientes_model', 'Listavendas_model', 'Fluxo_model'));
		
		$this->Vendas_model->setTable('erp_vendas' . $this->session->userdata('admin_id'));
		$this->Produtos_model->setTable('erp_produtos' . $this->session->userdata('admin_id'));
		$this->Clientes_model->setTable('erp_clientes' . $this->session->userdata('admin_id'));
		$this->Listavendas_model->setTable('erp_listavendas' . $this->session->userdata('admin_id'));
		$this->Fluxo_model->setTable('erp_fluxocaixa' . $this->session->userdata('admin_id'));

		login_verify();
	}

	public function index()
	{ 
		if($this->session->userdata('filtervendas'))
		{
			$where = array('data'=>$this->session->userdata('filtervendas')['data']);
			print_r($this->session->userdata('filtervendas'));
		}
		else
		{
			$where = null;
		}

		$dadosdb = $this->Vendas_model->getVendas(null,  array('id' => 'DESC'), 50);
		
		if($dadosdb)
		{
			$vendas = null;
			
			foreach ($dadosdb as $key => $value)
		    {
				$cliente = $this->Clientes_model->getClientes(array('id'=>$value->idcliente));
				if($cliente)
				{
					$value->nome = $cliente[0]->nome;
					$vendas[] = $value;
				}
			} 

			$dados['vendas'] = $vendas;
		}
		
		$dados['titulo'] = 'Vendas';

		$this->load->view('vendas', $dados);
	}

	public function filtervendas()
	{
		// FILTRO DE ORDENAR - OK
		if($this->input->post())
		{
			$this->session->set_userdata('filtervendas', array('data'=>$this->input->post()['data_filter']));
		}
		redirect(base_url('vendas'));
	}

	public function modalvenda()
	{
		$dados['clientes'] = $this->Clientes_model->getClientes(null, array('nome' => 'ASC'));
		$dados['produtos'] = $this->Produtos_model->getProdutos(null, array('nome' => 'ASC'));
		$this->load->view('modal-add-venda', $dados);
	}
	public function addvenda()
	{
		$post = $this->input->post();

		$total = 0;
		$chave = date('Ymdhis');

		foreach ($post['produtos'] as $key => $value)
		{
			$total += ($post['preco'][$key] * $post['quantidade'][$key]);
			$this->Listavendas_model->insertLista(array('idcliente'=>$post['cliente'], 'produto'=>$value, 'preco'=>$post['preco'][$key], 'quantidade'=>$post['quantidade'][$key], 'chave'=>$chave));
		}

		$this->Vendas_model->insertVenda(array('idcliente'=>$post['cliente'], 'data'=>date('Y-m-d'), 'chave'=>0, 'status'=>$post['status'], 'total'=>$total, 'chave'=>$chave));
		$this->Fluxo_model->inFluxo(array('tipo'=>'Receita', 'data'=>date('Y-m-d'),'descricao'=>'Venda de mercadoria', 'valor'=>$total, 'SKU'=>$chave));

		echo 'Cadastrado com sucesso!';
	}

	public function vervenda()
	{
		$dados['titulo'] = 'Vendas';

		$dados['venda'] = $this->Vendas_model->getVendas(array('chave'=>$this->uri->segment(3)), null, 1);

		$dados['cliente'] = $this->Clientes_model->getClientes(array('id'=>$dados['venda'][0]->idcliente), null, 1);

		$dados['produtos'] = $this->Listavendas_model->getLista(array('chave'=>$this->uri->segment(3)));
		
		$this->load->view('vervenda', $dados);
	}

	public function deletandovenda()
	{
		$this->Vendas_model->deleteVenda(array('chave'=>$this->uri->segment(3)));
		$this->Listavendas_model->deleteLista(array('chave'=>$this->uri->segment(3)));
		$this->Fluxo_model->deleteFluxo(array('SKU'=>$this->uri->segment(3)));

		redirect('vendas');
	}
}