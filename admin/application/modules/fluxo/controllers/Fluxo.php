<?php
class Fluxo extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('css_html', 'form', 'functions', 'login_verify'));
		$this->load->library('form_validation');
		$this->load->model('Fluxo_model');
		$this->Fluxo_model->setTable('erp_fluxocaixa'.$this->session->userdata('admin_id'));
		login_verify();
	}

	public function index()
	{
		$dados['titulo'] = 'Financeiro';
		$dados['fluxo'] = $this->Fluxo_model->getFluxo(null, array('data' => 'DESC'), 50);

		$mensal = $this->Fluxo_model->getFluxo(array('month(data)'=>date('m')));

		$dados['customensal'] = 0;
		$dados['receitamensal'] = 0;

		foreach ($mensal as $v)
		{
			if($v->tipo == 'Receita')
			{
				$dados['receitamensal'] = $dados['receitamensal'] + str_replace(',', '.', ($v->valor));
			}
			else
			{
				$dados['customensal'] = $dados['customensal'] + str_replace(',', '.', ($v->valor));
			}
		}

		$this->load->view('fluxo', $dados);
	}
	public function addreceita()
	{
		if ($this->input->post()) {
			$this->Fluxo_model->inFluxo($this->input->post());
			echo ('Cadastrado com sucesso!');
			return false;
		}
		$this->load->view('add-receita');
	}
	public function adddespesa()
	{
		if ($this->input->post()) {

			$this->form_validation->set_rules('descricao', 'required|trim');
			$this->form_validation->set_rules('valor', 'required|trim');
			$this->form_validation->set_rules('data', 'required|trim');

			if($this->form_validation->run() == false)
			{
				$this->Fluxo_model->inFluxo($this->input->post());
				echo ('Cadastrado com sucesso!');
			}
			else
			{
				echo 'Preencha os campos';
			}
			return false;
		}
		$this->load->view('add-despesa');
	}
	public function verfluxo()
	{
		$dados['titulo'] = 'Fluxo de Caixa';

		$dados['fluxo'] = $this->Fluxo_model->getFluxo(array('id'=>$this->uri->segment(3)), null, 1);

		$this->load->view('verfluxo', $dados);
	}

	public function deletandofluxo()
	{
		$this->Fluxo_model->deleteFluxo(array('id'=>$this->uri->segment(3)));

		redirect(base_url('fluxo'));
	}

	public function atualizafluxo()
	{
		if($this->input->post())
		{
			$this->Fluxo_model->updateFluxo($this->input->post(), array('id'=>$this->input->post()['id']));
		}
	}
}