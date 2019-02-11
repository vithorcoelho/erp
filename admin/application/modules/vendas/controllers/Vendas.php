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

		$dadosdb = $this->Vendas_model->getVendas(null, null, 50);
		
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

		$produtos['produtos'] = null;
		$produtos['quantidade'] = null;
		$produtos['preco'] = null;

		$contadorquantidade = 1;
		foreach ($post as $key => $value)
		{
			if($key == 'quantidade'.$contadorquantidade)
			{
				$produtos['quantidade'][] .= $value;
				$contadorquantidade = $contadorquantidade + 1;
			}
		}
		$contadorproduto = 1;
		foreach ($post as $key => $value)
		{
			if($key == 'produto'.$contadorproduto)
			{
				$produtos['produtos'][] .= $value;
				$contadorproduto = $contadorproduto + 1;
			}
		}

		$contadorpreco = 1;
		foreach ($post as $key => $value)
		{
			if($key == 'preco'.$contadorpreco)
			{
				$produtos['preco'][] .= $value;
				$contadorpreco = $contadorpreco + 1;
			}
		}

		$linha[] = null;

		foreach ($produtos['produtos'] as $key => $value) {
			$linha[$key]['produto'] = $value;
		}
		foreach ($produtos['quantidade'] as $key => $value) {
			if($value)
			{
			$linha[$key]['quantidade'] = $value;
			}
		}
		foreach ($produtos['preco'] as $key => $value) {
			if($value)
			{
				$linha[$key]['preco'] = $value;
			}
		}

		$chavevenda = rand(100000,1000000000);

		$insertvenda = array('idcliente'=>$post['cliente'], 'data'=>date('Y-m-d'), 'status'=>$post['status'], 'obs'=>$post['obs'], 'chave'=>$chavevenda);

		$insertvenda['total'] = 0;

		foreach ($linha as $key => $value) {
			$value['idcliente'] = $post['cliente'];
			$value['chave'] = $chavevenda;
			$insertvenda['total'] =+ $insertvenda['total'] + ($value['preco'] * $value['quantidade']);

			$this->Listavendas_model->insertLista($value);
		}

		$insertfluxo = array('tipo'=>'Receita', 'data'=>date('Y-m-d'),'descricao'=>'Venda de mercadoria', 'valor'=>$insertvenda['total'], 'SKU'=>$chavevenda);

		$this->Fluxo_model->inFluxo($insertfluxo);
		$this->Vendas_model->insertVenda($insertvenda);

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