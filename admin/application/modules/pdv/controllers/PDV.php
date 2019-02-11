<?php
class PDV extends MX_Controller
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

			$dados['dados'] = '';
			$dados['qtd'] = $this->Produtos_model->countAll(null, array('nome'=>'joia'));

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
			$produtos = $this->Produtos_model->getProdutos(array('id'=>$this->input->post()['idproduto']));

			$retorno['dados'] = '';

			foreach ($produtos as $value)
			{
				$retorno['dados'] .= '<tr><td>'.utf8_encode($value->nome).'</td><td><input type="text" id="preco" value="'.$value->preco.'" size="3" /></td><td><input type="text" id="qtd"/></td>';
			}
			
			//$retorno['dados'] .= '<td>R$ '.number_format($subTotal, 2, ',', '.').'</td></tr>';

			echo json_encode($retorno);
		}
	}
}