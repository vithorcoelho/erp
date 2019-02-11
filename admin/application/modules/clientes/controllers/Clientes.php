<?php
class Clientes extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form'));
		$this->load->library('form_validation');
		$this->load->model('Clientes_model');

		login_verify();
	}

	public function index()
	{
		$this->p();
	}

	public function p()
	{
		$this->output->cache(30);

		$dados['titulo'] = 'Clientes';

		if($this->session->userdata('filtercliente'))
		{
			$order = $this->session->userdata('filtercliente');
		}
		else
		{
			$order = array('id'=>'DESC');
		}
		if($this->session->userdata('limitcliente'))
		{
			$limit = $this->session->userdata('limitcliente');
		}
		else
		{
			$limit = 50;
		}

		$this->load->helper('paginacao');
		
		$rota = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$dados['paginacao'] = createPaginate('clientes/p/', $this->Clientes_model->countAll(), $limit, 3);
		$dados['clientes'] = $this->Clientes_model->getClientes(null, $order, $limit, $rota);

		$this->load->view('clientes', $dados);
	}

	public function vercliente()
	{
		$dados['titulo'] = 'Clientes';
		$dados['cliente'] = $this->Clientes_model->getClientes(array('id'=>$this->uri->segment(3)), null, 1);

		if($dados['cliente'])
		{
			$this->load->view('viewcliente', $dados);
		}
		else
		{
			echo 'Nada encontrado';
		}
	}

	/*
	*
	*
	* Metodos sem interação com usuário
	*
	*	
	*/

	public function buscaclientes()
	{
		if($this->input->post())
		{
			if($this->input->post()['nome'])
			{
				$resultado = $this->Clientes_model->getClientes(null, null, null, null, $this->input->post());
			}

			if(!empty($resultado))
			{
				echo '
				
				<h5 class="card-header">Resultados da busca:</h5>
	                <div class="card-block ks-browse ks-scrollable jspScrollable" style="" tabindex="0">
	                    <table class="table table-striped stacktable small-only">';
	                        	foreach ($resultado as $v):
		                    	echo '<tr>
		                        	<td id="td-nome"><a href="'. base_url('clientes/vercliente/'.$v->id) .'">'. $v->nome .'</a></td>
		                        	<td id="td-email">'. $v->email  .'</td>
		                        	<td id="td-telefone">'. $v->telefone .'</td>
		                        	<td id="td-endereco">'. $v->endereco .'</td>
		                        </tr>';
		                    	endforeach;
		        echo '</tbody>
	                	</table>';
	        }
	        else
	        {
	        	return false;
	        }
		}
	}

	public function filtercliente()
	{
		if($this->input->post())
		{
			if(!$this->session->userdata('filtercliente') || !$this->session->userdata('limitcliente'))
			{
				$this->session->set_userdata('limitcliente', $this->input->post()['limit']);
				$this->session->set_userdata('filtercliente', array($this->input->post()['order_name']=>$this->input->post()['order']));
			}
			else
			{
				$this->session->unset_userdata('filtercliente');
				$this->session->set_userdata('filtercliente', array($this->input->post()['order_name']=>$this->input->post()['order']));

				$this->session->unset_userdata('limitcliente');
				$this->session->set_userdata('limitcliente', $this->input->post()['limit']);
			}
		}
		redirect(base_url('clientes'));
	}

	public function modalcliente()
	{
		$this->output->cache(7200);

		$this->load->view('modaladdclientes');
	}

	public function addcliente()
	{
		if ($this->input->post()) {
			$this->Clientes_model->insertCliente($this->input->post());
			Set_msg('addcliente');
			redirect(base_url('clientes'));
		}
	}

	public function atualizacliente()
	{
		if($this->input->post())
		{
			$this->Clientes_model->updateCliente($this->input->post(), array('id'=>$this->input->post()['id']));
			//Set_msg(alert_success('Editado com sucesso!'));
			echo 'Cliente editado com sucesso!';
		}
	}
	
	public function deletandocliente()
	{
		$this->load->model('Vendas_model');

		if($this->Vendas_model->getVendas(array('idcliente'=>$this->uri->segment(3))))
		{
			Set_msg(alert_red('Não foi possivel excluir, já existem vendas realizadas com este cliente'));

			redirect('clientes/vercliente/'.$this->uri->segment(3));
		}
		else
		{
			$this->Clientes_model->deleteCliente(array('id'=>$this->uri->segment(3)));
			
			Set_msg('deletecliente');

			redirect('clientes');
		}
	}
}