<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends MX_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'css_html', 'functions'));
		$this->load->library('form_validation');
		$this->load->model('Cadastro_model');
	}

	public function index()
	{
		$dados['titulo'] = 'Cadastro';

		// Regras de validação
		$this->form_validation->set_rules('nome', 'nome', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('senha', 'senha', 'trim|required|min_length[6]|max_length[12]');
		$this->form_validation->set_rules('senha2', 'repetir senha', 'trim|required|min_length[6]|max_length[12]|matches[senha]');

		// Veririca a validação
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

			$this->session->unset_userdata('logged');
			$this->session->unset_userdata('admin_id');
			$this->session->unset_userdata('admin_email');
			$this->session->unset_userdata('admin_nome');

			if($this->Cadastro_model->getUser('email', array('email'=>$dados_form['email'])))
			{
				Set_msg(alert_red('O email solicitado já existe!'));
				redirect('login');
			}
			else
			{
				$dados = array('nome'=>$dados_form['nome'], 'email'=>$dados_form['email'], 'senha'=>password_hash($dados_form['senha'], PASSWORD_DEFAULT));
				$inserido = $this->Cadastro_model->insertUser($dados);

				if($inserido)
				{
					Set_msg(alert_success('Cadastro realizado com sucesso!'));
					$this->installUser($inserido);
					redirect('login', 'refresh');
				}
			}
		}

		// Carrega a view do Painel ADM
		$this->load->view('setup', $dados);
	}
	public function installUser($id_cliente = '')
	{
		$clientes = false;
		$produtos = false;
		$listavendas = false;
		$vendas = false;
		$fluxocaixa = false;

		// Verifica se cada tabela existe
		foreach ($this->db->list_tables() as $value)
		{
			if($value == 'erp_clientes'.$id_cliente)
			{
				$clientes = true;
			}
			if($value == 'erp_produtos'.$id_cliente)
			{
				$produtos = true;
			}
			if($value == 'erp_listavendas'.$id_cliente)
			{
				$listavendas = true;
			}
			if($value == 'erp_vendas'.$id_cliente)
			{
				$vendas = true;
			}
			if($value == 'erp_fluxocaixa'.$id_cliente)
			{
				$fluxocaixa = true;
			}
		}

		$primarykey = file_get_contents(__DIR__ . 	"/../files/alter_table_primarykey.sql");
		$auto_increment = file_get_contents(__DIR__ . 	"/../files/auto_increment_id.sql");

		if(!$clientes)
		{
			$erp_clientes_sql = file_get_contents(__DIR__ . 	"/../files/erp_clientes.sql");
			$erp_clientes_sql = str_replace('erp_clientes', 'erp_clientes'.$id_cliente, $erp_clientes_sql);
			
			$primarykey_cliente = str_replace('{primarykey}', 'erp_clientes'.$id_cliente, $primarykey);
			$auto_increment_cliente = str_replace('{autoincrement}', 'erp_clientes'.$id_cliente, $auto_increment);

			$this->Cadastro_model->installTables($erp_clientes_sql);
			$this->Cadastro_model->installTables($primarykey_cliente);
			$this->Cadastro_model->installTables($auto_increment_cliente);
		}
		if(!$produtos)
		{
			$erp_produtos_sql = file_get_contents(__DIR__ . 	"/../files/erp_produtos.sql");
			$erp_produtos_sql = str_replace('erp_produtos', 'erp_produtos'.$id_cliente, $erp_produtos_sql);

			$primarykey_produto = str_replace('{primarykey}', 'erp_produtos'.$id_cliente, $primarykey);
			$auto_increment_produto = str_replace('{autoincrement}', 'erp_produtos'.$id_cliente, $auto_increment);

			$this->Cadastro_model->installTables($erp_produtos_sql);
			$this->Cadastro_model->installTables($primarykey_produto);
			$this->Cadastro_model->installTables($auto_increment_produto);
		}
		if(!$vendas)
		{
			$erp_vendas_sql = file_get_contents(__DIR__ . 	"/../files/erp_vendas.sql");
			$erp_vendas_sql = str_replace('erp_vendas', 'erp_vendas'.$id_cliente, $erp_vendas_sql);

			$primarykey_vendas = str_replace('{primarykey}', 'erp_vendas'.$id_cliente, $primarykey);
			$auto_increment_vendas = str_replace('{autoincrement}', 'erp_vendas'.$id_cliente, $auto_increment);

			$this->Cadastro_model->installTables($erp_vendas_sql);
			$this->Cadastro_model->installTables($primarykey_vendas);
			$this->Cadastro_model->installTables($auto_increment_vendas);
		}
		if(!$listavendas)
		{
			$erp_listavendas_sql = file_get_contents(__DIR__ . 	"/../files/erp_listavendas.sql");
			$erp_listavendas_sql = str_replace('erp_listavendas', 'erp_listavendas'.$id_cliente, $erp_listavendas_sql);

			$primarykey_listavendas = str_replace('{primarykey}', 'erp_listavendas'.$id_cliente, $primarykey);
			$auto_increment_listavendas = str_replace('{autoincrement}', 'erp_listavendas'.$id_cliente, $auto_increment);

			$this->Cadastro_model->installTables($erp_listavendas_sql);
			$this->Cadastro_model->installTables($primarykey_listavendas);
			$this->Cadastro_model->installTables($auto_increment_listavendas);
		}
		if(!$fluxocaixa)
		{
			$erp_fluxocaixa_sql = file_get_contents(__DIR__ . 	"/../files/erp_fluxocaixa.sql");
			$erp_fluxocaixa_sql = str_replace('erp_fluxocaixa', 'erp_fluxocaixa'.$id_cliente, $erp_fluxocaixa_sql);

			$primarykey_fluxocaixa = str_replace('{primarykey}', 'erp_fluxocaixa'.$id_cliente, $primarykey);
			$auto_increment_fluxocaixa = str_replace('{autoincrement}', 'erp_fluxocaixa'.$id_cliente, $auto_increment);

			$this->Cadastro_model->installTables($erp_fluxocaixa_sql);
			$this->Cadastro_model->installTables($primarykey_fluxocaixa);
			$this->Cadastro_model->installTables($auto_increment_fluxocaixa);
		}		
	}
}
