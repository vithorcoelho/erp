<?php

class Clientes extends MX_Controller
{
	private $tabela_order = array('id'=>'DESC');
	private $tabela_limit = 50;

	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'functions'));
		$this->load->library(array('form_validation', 'security'));
		$this->load->model('Clientes_model');

		login_verify();
	}

	public function index()
	{
		$dados['page_titulo'] = 'Clientes';

		$this->CookieFiltroClientes();
		
		$dados['paginacao'] = $this->PaginacaoClientes();

		$rotaStart = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$dados['clientes'] = $this->Clientes_model->getClientes(array('id', 'nome', 'email', 'telefone', 'endereco'), null, $this->tabela_order, $this->tabela_limit, $rotaStart);

		$this->load->view('clientes', $dados);
	}

	public function PaginacaoClientes()
	{
		$this->load->helper('paginacao');

		return createPaginate('clientes/index/', $this->Clientes_model->countAll(), $this->tabela_limit, 3);
	}

	public function CookieFiltroClientes()
	{
		if($this->input->post())
		{
			delete_cookie('filtrotabelaclientes');

			$filtrotabelaclientes = $this->security->xss_clean($this->input->post());

			set_cookie('filtrotabelaclientes', serialize($filtrotabelaclientes), 3000);

			redirect(base_url('clientes'));
		}
		else
		{
			if(($filtro_tabela_clientes = unserialize(get_cookie('filtrotabelaclientes'))))
			{
				$this->tabela_order = array($filtro_tabela_clientes['order_name']=>$filtro_tabela_clientes['order']);
				$this->tabela_limit = $filtro_tabela_clientes['limit'];
			}
		}
	}
	
	public function DadosCliente()
	{
		$dados['page_titulo'] = 'Cliente';
		$dados['cliente'] = $this->Clientes_model->getClientes(null, array('id'=>$this->uri->segment(3)), null, 1);

		if($dados['cliente'])
		{
			$this->load->view('dadoscliente', $dados);
		}
		else
		{
			show_404();
		}
	}
	
	public function Ajax_BuscarClientes()
	{
		if($this->input->post())
		{
			if($this->input->post()['nome'])
			{
				$resultado = $this->Clientes_model->getClientes(array('id', 'nome', 'email', 'telefone', 'endereco'), null, null, 100, 0, $this->security->xss_clean($this->input->post()));
			}

			if(!empty($resultado))
			{
				echo '<h5 class="card-header">Resultados da busca:</h5><div class="card-block ks-browse ks-scrollable jspScrollable"><table class="table table-striped stacktable small-only">';
	               	foreach ($resultado as $v):
			           	echo '<tr><td><a href="'. base_url('clientes/dados_cliente/'.$v->id) .'">'. $v->nome .'</a></td>
			               	<td>'. $v->email  .'</td>
			               	<td>'. $v->telefone .'</td>
			               	<td>'. $v->endereco .'</td></tr>';
		           	endforeach;
		        echo '</tbody></table>';
	        }
	        else
	        {
	        	return false;
	        }
		}
	}

	#
	# CRUD ERP CLIENTE:
	#

	public function Ajax_CadastrarCliente()
	{
		if ($this->input->post())
		{
			$this->form_validation->set_rules('nome', 'nome', 'required|trim');

			if($this->form_validation->run() == false)
			{
				$return['error'] = validation_errors();
				
				echo json_encode($return); 
			}
			else
			{
				foreach ($this->input->post() as $key => $value)
				{
					$query[$key] = $this->security->xss_clean(strip_tags(trim($value)));
				}

				$return['id'] = $this->Clientes_model->insertCliente($query); 

				$return['success'] = 'Cliente cadastrado com sucesso!';

				echo json_encode($return);
			}
		}
	}

	public function Ajax_AtualizarCliente()
	{
		if ($this->input->post())
		{

			$this->form_validation->set_rules('nome', 'nome', 'required|trim');

			if($this->form_validation->run() == false)
			{
				$return['error'] = validation_errors();
				
				echo json_encode($return);
			}
			else
			{
				foreach ($this->input->post() as $key => $value)
				{
					$query[$key] = $this->security->xss_clean(strip_tags(trim($value)));
				}
				$this->Clientes_model->updateCliente($query, array('id'=>$query['id']));

				$return['success'] = 'Cliente salvo com sucesso!';

				echo json_encode($return);
			}
		}
	}
	
	public function DeletarCliente()
	{
		$this->load->model('Vendas_model');

		if($this->Vendas_model->getVendas(array('id', 'idcliente'), array('idcliente'=>$this->uri->segment(3))))
		{
			set_message_cookie('<script>msg_flutuante("Não foi possivel excluir, já existem vendas realizadas com este cliente", "error")</script>');

			redirect('clientes/dadoscliente/'.$this->uri->segment(3));

			// !IMPORTANTE! Verifica se existe vendas com este cliente, caso existir ele não deleta e retorna um mensagem em cookie
		}
		else
		{
			$this->Clientes_model->deleteCliente(array('id'=>$this->uri->segment(3)));
			set_message_cookie('<script>msg_flutuante("Cliente excluido com sucesso", "success")</script>');
			redirect('clientes');
		}
	}
}