<?php
class Clientes extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form'));
		$this->load->library(array('form_validation', 'security'));
		$this->load->model('Clientes_model');

		login_verify();
		$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$this->p();
	}
 
	public function p()
	{
		$dados['titulo'] = 'Clientes';
		
		$dados['css'] = array(
			"libs/datatables-net/media/css/dataTables.bootstrap4.min.css",
			"libs/datatables-net/extensions/buttons/css/buttons.bootstrap4.min.css",
			"assets/styles/libs/datatables-net/datatables.min.css",
			"libs/select2/css/select2.min.css",
			"assets/styles/libs/select2/select2.min.css");

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

	public function importplanilha()
	{
		$dados['titulo'] = 'Importar lista de clientes';
		
		if(!empty($_FILES['file']))
		{
			//readfile($_FILES['file']['tmp_name']);
			$handle = fopen($_FILES['file']['tmp_name'], "r");
			$csv = fgetcsv($handle, 1000, ";");

			$table = array(
					'nome',
					'email',
					'cpf',
					'cidade',
					'endereco',
					'telefone',
					'celular');

			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE)
			{
				foreach ($data as $key => $value)
				{
					$csv[$key] = strtolower($csv[$key]);

					foreach ($table as $t)
					{
						if($csv[$key] == strtolower($t))
						{
							$array[$csv[$key]] = $this->security->xss_clean(htmlspecialchars(trim($value)));
						}
					}
				}

				if(!@$array['nome'] || @$array['nome'] == '')
				{
					$dados['error'] = 'Algumas informações não foram cadastradas porque o campo nome é obrigatória. Verifique as regras de importação de clientes.';
				}
				else
				{
					$this->Clientes_model->insertCliente($array);
				}
			}

			fclose($handle);
		}

		$this->load->view('importcsv', $dados);
	}

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

	/*
	*
	* CRUD CLIENTE
	*
	*/

	public function addcliente()
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
				$this->Clientes_model->insertCliente($query);

				$return['success'] = 'Cliente cadastrado com sucesso!';

				echo json_encode($return);
			}
		}
	}

	public function atualizacliente()
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
			
			Set_msg('excluido');

			redirect('clientes');
		}
	}
}