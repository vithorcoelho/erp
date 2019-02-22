<?php
class Pdv extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Produtos_model'));
		
		login_verify();
	}

	public function index()
	{
		$this->load->view('pdv');
	}

	public function buscaprodutos()
	{
		if($this->input->post())
		{
			$produtos = $this->Produtos_model->getProdutos(null, null, null, null, array('nome'=>$this->input->post()['texto']));

			$dados['qtd'] = $this->Produtos_model->countAll();

			$dados['dados'] = '';
			foreach ($produtos as $value)
			{
				$dados['dados'] .= '<a href="#" class="produto" id="'.$value->id.':'.$value->preco.'">'.$value->nome.'</a>';
			}

			echo json_encode($dados);
		}
	}

	public function addproduto()
	{
		if($this->input->post()['idproduto'])
		{
			$produtos = $this->Produtos_model->getProdutos(null, array('id'=>$this->input->post()['idproduto']));

			$retorno['dados'] = '';

			foreach ($produtos as $value)
			{
				$retorno['dados'] .= 
				'<tr class='.$value->id.'>
				<td width=200><input type="hidden" value="'.$value->nome.'" name="produtos[]">'.$value->nome.'</td>
				<td><input type="text" id="preco" value="'.$value->preco.'" class="form-control" name="preco[]"></td>
				<td><input type="text" class="qtdproduto form-control" value="1" name="quantidade[]"></td>	
				<td>'.$value->preco.'</td>
				<td width=2><a href=#'.$value->id.' class="excluirproduto btn btn-danger ks-no-text"><label class="la la-close ks-icon"></label></a></td>
				</tr>';
			}
			
			$retorno['idproduto'] = $value->id;

			echo json_encode($retorno);
		}
	}
}