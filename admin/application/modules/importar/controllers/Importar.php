<?php
class Importar extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
		$this->load->library('importarcsv');
		$this->load->model('Clientes_model');
	}

	public function clientes()
	{
		$dados['titulo'] = 'Importando Clientes';

		if($this->input->post())
		{
			if($_FILES['file']['tmp_name'] && $_FILES['file']['type'] == 'application/vnd.ms-excel')
			{
				if($_FILES['file']['size'] < (1024 * 1000)) // 1mb
				{
					$query = $this->importarcsv->CSVencode('file', array('nome', 'email', 'telefone', 'cidade'), 10);

					if(is_array($query))
					{
						foreach ($query[0] as $key => $value)
						{
							$this->Clientes_model->insertCliente($value);

							$dados['msg'] = '<script>msg_flutuante("Os dados foram importados com sucesso", "bottomCenter")</script>';
						}
					}
					else
					{
						$dados['msg'] = '<script>msg_flutuante("'.$query.'", "error")</script>';
					}
				}
				else
				{
					$dados['msg'] = '<script>msg_flutuante("O arquivo excede o tamanho de 1mb", "error")</script>';
				}	
			}
			else
			{
				$dados['msg'] = '<script>msg_flutuante("Nenhum arquivo selecionado", "error")</script>';
			}
		}
		$this->load->view('clientes', @$dados);
	}

	public function produtos()
	{
		$dados['titulo'] = 'Importando Produtos';

		if($this->input->post())
		{
			if($_FILES['file']['tmp_name'] && $_FILES['file']['type'] == 'application/vnd.ms-excel')
			{
				if($_FILES['file']['size'] < (1024 * 1000)) // 1mb
				{
					$query = $this->importarcsv->CSVencode('file', array('nome', 'email', 'telefone', 'cidade'), 10);

					if(is_array($query))
					{
						foreach ($query[0] as $key => $value)
						{
							$this->Clientes_model->insertCliente($value);

							$dados['msg'] = '<script>msg_flutuante("Os dados foram importados com sucesso", "bottomCenter")</script>';
						}
					}
					else
					{
						$dados['msg'] = '<script>msg_flutuante("'.$query.'", "error")</script>';
					}
				}
				else
				{
					$dados['msg'] = '<script>msg_flutuante("O arquivo excede o tamanho de 1mb", "error")</script>';
				}	
			}
			else
			{
				$dados['msg'] = '<script>msg_flutuante("Nenhum arquivo selecionado", "error")</script>';
			}
		}
		$this->load->view('produtos', @$dados);
	}
}