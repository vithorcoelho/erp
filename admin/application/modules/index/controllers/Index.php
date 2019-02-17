<?php
class Index extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model(array('Fluxo_model', 'Vendas_model'));
		$this->Fluxo_model->setTable('erp_fluxocaixa'.$this->session->userdata('admin_id'));

		login_verify();
	}

	public function index()
	{
		$dados['titulo'] = 'Home';
		$dados['titulo_header'] = 'Resumo';
		$dados['css'] = array(
			base_url('assets/styles/widgets/panels.min.css')
		);

		$mensal = $this->Fluxo_model->getFluxo(array('month(data)'=>date('m')));

		$dados['customensal'] = 0;
		$dados['receitamensal'] = 0;

		foreach ($mensal as $v)
		{
			if($v->tipo == 'Receita')
			{
				$dados['receitamensal'] = $dados['receitamensal'] + str_replace(',', '.', ($v->valor));;
			}
			else
			{
				$dados['customensal'] = $dados['customensal'] + str_replace(',', '.', ($v->valor));
			}
		}

		$dados['qtdvendas'] = $this->Vendas_model->countAll(array('month(data)'=>date('m')));

		$this->load->view('index', $dados);
	}
}