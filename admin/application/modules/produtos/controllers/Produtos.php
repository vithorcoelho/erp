<?php
class Produtos extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'paginacao'));
		$this->load->library('form_validation');
		$this->load->model(array('Produtos_model'));
		
		login_verify();
	}
	
	public function index()
	{
		$this->p();
	}

	public function p()
	{
		$dados['titulo'] = 'Produtos';

		if($this->session->userdata('filterproduto'))
		{
			$order = $this->session->userdata('filterproduto');
		}
		else
		{
			$order = array('id'=>'DESC');
		}
		if($this->session->userdata('limitproduto'))
		{
			$limit = $this->session->userdata('limitproduto');
		}
		else
		{
			$limit = 5;
		}
		
		$rota = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$dados['paginacao'] = createPaginate('produtos/p/', $this->Produtos_model->countAll(), $limit, 3);
		$dados['produtos'] = $this->Produtos_model->getProdutos(null, $order, $limit, $rota);

		$this->load->view('produtos', $dados);
	}



	public function modalproduto()
	{
		// CARREGA MODAL PARA CADASTRAR PRODUTOS: OK
		$this->load->view('modal-add-produtos');
	}


	public function verproduto ()
	{
		// VISUALIZA INFORMAÇÕES DO PRODUTO: FALTA ESTASTICAS DO PRODUTO E ESTOQUE
		$dados['titulo'] = 'Produto';
		$dados['produto'] = $this->Produtos_model->getProdutos(array('id'=>$this->uri->segment(3)), null, 1);
		
		if($dados['produto'])
		{
			$this->load->view('verproduto', $dados);
		}
		else
		{
			echo 'Nada encontrado!';
		}
	}










	########## METODOS SEM INTERAÇÃO DO USUÁRIO ##############


	public function buscaprodutos()
	{
		if($this->input->post())
		{
			if($this->input->post()['nome'])
			{
				$resultado = $this->Produtos_model->getProdutos(null, null, null, null, $this->input->post());
			}

			if(!empty($resultado))
			{
				echo '
				<h5 class="card-header">Resultados da busca:</h5>
	                <div class="card-block ks-browse ks-scrollable jspScrollable" style="" tabindex="0">
	                    <table class="table table-striped stacktable small-only">';
	                        	foreach ($resultado as $v):
		                    	echo '<tr>
		                        	<td id="td-nome"><a href="'. base_url('produtos/verproduto/'.$v->id) .'">'. $v->nome .'</a></td>
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

	public function filterproduto()
	{
		if($this->input->post())
		{
			if(!$this->session->userdata('filterproduto') || !$this->session->userdata('limitproduto'))
			{
				$this->session->set_userdata('limitproduto', $this->input->post()['limit']);
				$this->session->set_userdata('filterproduto', array($this->input->post()['order_name']=>$this->input->post()['order']));
			}
			else
			{
				$this->session->unset_userdata('filterproduto');
				$this->session->set_userdata('filterproduto', array($this->input->post()['order_name']=>$this->input->post()['order']));

				$this->session->unset_userdata('limitproduto');
				$this->session->set_userdata('limitproduto', $this->input->post()['limit']);
			}
		}
		redirect(base_url('produtos'));
	}

	public function addproduto()
	{
		// CADASTRAD PRODUTOS: ! FALTA VALIDAÇÃO DOS DADOS !
		if ($this->input->post())
		{
			
			$dados = $this->input->post();

			$insert = $this->Produtos_model->insertProduto($dados);

        	# Realiza o upload da imagem
        	$this->load->library('upload', config_upload('./assets/images/catalogo', $insert));

	        if ($this->upload->do_upload('img'))
	        {     
	        	$dados_upload = $this->upload->data();
	        	clearstatcache();

	            if(!$dados_upload)
	            {
	            	$msg = $this->upload->display_errors();

	            	Set_msg(alert_red($msg));
	            }
	        }
			redirect('produtos');
		}
	}

	public function atualizaproduto()
	{
		// FALTA A VALIDAÇÃO DOS DADOS
		if($this->input->post())
		{
			$dados = $this->input->post();
			$dados['loja'] = (isset($this->input->post()['loja'])) ? ($dados['loja']) : 0;

			# Realiza o upload da imagem
        	$this->load->library('upload', config_upload('./assets/images/catalogo', $dados['id']));

	        if ($this->upload->do_upload('img'))
	        {     
	        	$dados_upload = $this->upload->data();
	        	clearstatcache();

	            if(!$dados_upload)
	            {
	            	$msg = $this->upload->display_errors();

	            	Set_msg(alert_red($msg));
	            }
	        }

			$this->Produtos_model->updateProduto($dados, array('id'=>$this->input->post()['id']));

			Set_msg(alert_success('Produto editado com sucesso!'));

			redirect('produtos/verproduto/'.$dados['id']);
		}
		else
		{
			redirect('produtos');
		}
	}

	public function deletandoproduto()
	{
		$this->load->model('Listavendas_model');

		$produto = $this->Produtos_model->getProdutos(array('id'=>$this->uri->segment(3)), null, 1);

		if($this->Listavendas_model->getLista(array('produto'=>$produto[0]->nome)))
		{
			Set_msg(alert_red('Não foi possivel excluir, já existem vendas realizadas com este produto'));
			redirect('produtos/verproduto/'.$this->uri->segment(3));
		}
		else
		{
			$this->Produtos_model->deleteProduto(array('id'=>$produto[0]->id));
			redirect('produtos');
		}
	}
}