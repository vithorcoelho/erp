<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'css_html', 'functions'));
		$this->load->library('form_validation');
		$this->load->model('Login_model');
	}

	public function index()
	{
		if($this->session->userdata('logged'))
		{
			redirect('admin');
		}

		$dados['titulo'] = 'Login';

		$this->form_validation->set_rules('email', 'e-mail', 'trim|required');
		$this->form_validation->set_rules('senha', 'senha', 'trim|required');

		if($this->form_validation->run() == FALSE)
		{
			if(validation_errors())
			{
				Set_msg(alert_red(validation_errors()));
			}
		}
		else
		{
			$dados_form = $this->input->post();

			if($this->Login_model->getUser('email', array('email'=>$dados_form['email'])))
			{
				// Usuário existe
				if(password_verify($dados_form['senha'], $this->Login_model->getUser('senha')))
				{
					$this->session->set_userdata('logged', TRUE);
					$this->session->set_userdata('admin_id', $this->Login_model->getUser('id', array('email'=>$dados_form['email'])));
					$this->session->set_userdata('admin_nome', $this->Login_model->getUser('nome', array('email'=>$dados_form['email'])));
					$this->session->set_userdata('admin_email', $this->Login_model->getUser('email', array('email'=>$dados_form['email'])));

					// Faz Redirect para a Home do Admin
					// ---------------------------------
					redirect('admin');
				}
				else
				{
					Set_msg(alert_red('Senha incorreta'));
				}
			}
			else 
			{
				// Usuario nao existe
				Set_msg(alert_red('Usuario não existe'));
			}
		}

		$this->load->view('login', $dados);
	}

	public function logout()
	{
		$this->session->unset_userdata('logged');
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_email');
		$this->session->unset_userdata('admin_nome');

		Set_msg(alert_success('Logout realizado'));
		redirect('login');
	}
}
