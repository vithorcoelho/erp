<?php
class Produtos extends MX_Controller
{
	private $tabela_order = array('id'=>'DESC');
	private $tabela_limit = 50;

	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'functions'));
		$this->load->library('form_validation');
		$this->load->model(array('Produtos_model'));
		
		login_verify();
	}

	public function index()
	{
		$dados['page_titulo'] = 'Produtos';

		$this->CookieFiltroProduto();
		
		$dados['paginacao'] = $this->PaginacaoProdutos();

		$rota_start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$dados['produtos'] = $this->Produtos_model->getProdutos('id, nome, preco, ref' ,null, $this->tabela_order, $this->tabela_limit, $rota_start);
		$this->load->view('produtos', $dados);
	}

	public function CookieFiltroProduto()
	{
		// Importante: depende de requisição de formulário (order_name, order, limit)
		
		if($this->input->post())
		{
			delete_cookie('filtrotabelaprodutos');

			$filtrotabelaprodutos = $this->security->xss_clean($this->input->post());

			set_cookie('filtrotabelaprodutos', serialize($filtrotabelaprodutos), 3000);

			redirect(base_url('produtos'));
		}
		else
		{
			if(($filtro_tabela_produtos = unserialize(get_cookie('filtrotabelaprodutos'))))
			{
				$this->tabela_order = array($filtro_tabela_produtos['order_name']=>$filtro_tabela_produtos['order']);
				$this->tabela_limit = $filtro_tabela_produtos['limit'];
			}
		}
	}

	public function PaginacaoProdutos()
	{
		$this->load->helper('paginacao');
		
		return createPaginate('produtos/index/', $this->Produtos_model->countAll(), $this->tabela_limit, 3);
	}

	public function DadosProduto()
	{
		$dados['titulo'] = 'Produto';

		$dados['produto'] = $this->Produtos_model->getProdutos(null, array('id'=>$this->uri->segment(3)), null, 1);
		
		if($dados['produto'])
		{
			$this->load->view('dados_produto', $dados);
		}
		else
		{
			show_404();
		}
	}
	
	public function Ajax_BuscaProdutos()
	{
		if($this->input->post())
		{
			if($this->input->post()['nome'])
			{
				$resultado = $this->Produtos_model->getProdutos('id, nome', null, null, null, null, $this->input->post());
			}

			if(!empty($resultado))
			{
				echo '<h5 class="card-header">Resultados da busca:</h5><div class="card-block ks-browse ks-scrollable jspScrollable" style="" tabindex="0">
	                    <table class="table table-striped stacktable small-only"><tbody>';
	                        foreach ($resultado as $v):
		                    echo '<tr><td id="td-nome"><a href="'. base_url('produtos/dados_produto/'.$v->id) .'">'. $v->nome .'</a></td></tr>';
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
	# CRUD ERP PRODUTO
	#
	
	public function Ajax_CadastrarProduto()
	{
		if ($this->input->post())
		{
			$this->form_validation->set_rules('nome', 'nome', 'required|trim');
			$this->form_validation->set_rules('preco', 'preço', 'required|trim');

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

				$return['id'] = $this->Produtos_model->insertProduto($query);

				$return['success'] = 'Produto cadastrado com sucesso!';

				echo json_encode($return);
			}
			exit;

        	# Realiza o upload da imagem
        	# À IMPLEMENTAR:
        	
        	$this->load->library('upload', config_upload('./assets/images/catalogo', $insert));

	        if ($this->upload->do_upload('img'))
	        {     
	        	$dados_upload = $this->upload->data();
	        	clearstatcache();

	            if(!$dados_upload)
	            {
	            	$msg = $this->upload->display_errors();
	            }
	        }
		}
	}

	public function Ajax_AtualizarProduto()
	{
		if ($this->input->post())
		{
			$this->form_validation->set_rules('nome', 'nome', 'required|trim');
			$this->form_validation->set_rules('preco', 'preço', 'required|trim');

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
				$this->Produtos_model->updateProduto($query, array('id'=>$query['id']));

				$return['success'] = 'Produto salvo com sucesso!';

				echo json_encode($return);
			}
		}
	}

	public function DeletarProduto()
	{
		$this->load->model('Listavendas_model');

		$produto = $this->Produtos_model->getProdutos('id, nome', array('id'=>$this->uri->segment(3)), null, 1);

		if($this->Listavendas_model->getLista(array('produto'=>$produto[0]->nome)))
		{
			set_message_cookie('<script>msg_flutuante("Não foi possivel excluir, já existem vendas realizadas com este produto", "error")</script>');

			redirect('produtos/dadosproduto/'.$this->uri->segment(3));

			// Verifica se existe vendas com este produto, caso existir ele não deleta e retorna um mensagem em cookie
		}
		else
		{
			set_message_cookie('<script>msg_flutuante("Produto excluido com sucesso", "success")</script>');
			$this->Produtos_model->deleteProduto(array('id'=>$produto[0]->id));
			redirect('produtos');
		}
	}
}