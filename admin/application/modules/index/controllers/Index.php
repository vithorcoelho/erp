<?php
class Index extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Fluxo_model');
		$this->Fluxo_model->setTable('erp_fluxocaixa'.$this->session->userdata('admin_id'));

		login_verify();
	}

	public function index()
	{
		$dados['titulo'] = 'Home';
		$dados['titulo_header'] = 'Home';

		$mensal = $this->Fluxo_model->getFluxo(array('month(data)'=>date('m')));

		$dados['customensal'] = is_float(0.00);
		$dados['receitamensal'] = is_float(0.00);

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

		$this->load->view('index', $dados);
	}
}