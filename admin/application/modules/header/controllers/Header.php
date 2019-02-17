<?php
class Header extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$dados['config_header'] = $this->config_header();

		$this->load->view('header', $dados);
	}

	public function config_header()
	{
		$dados['titulo'] = 'mG';

		$dados['navlogo'] = array(
			'Dashboard' 	=> array(base_url('assets/img/menu-grid/dashboard.png'), base_url('#')),
			'Projetos' 		=> array(base_url('assets/img/menu-grid/flask.png'), base_url('#')),
			'Calendario' 	=> array(base_url('assets/img/menu-grid/calendar.png'), base_url('#')),
			'Profile' 		=> array(base_url('assets/img/menu-grid/profile.png'), base_url('#')),
			'Tickets' 		=> array(base_url('assets/img/menu-grid/ticket.png'), base_url('#')),
			'Configurações' => array(base_url('assets/img/menu-grid/settings.png'), base_url('#')),
			'Sair' 			=> array(base_url('assets/img/menu-grid/settings.png'), str_replace('admin/', '', base_url('login/logout')))
		);

		$dados['nav'] = array(
			'Resumo' 			=> base_url(),
			'Clientes'		=> base_url('clientes'),
			'Produtos'		=> base_url('produtos'),
			'Vendas'		=> base_url('vendas'),
			'Fluxo de caixa' => base_url('fluxo')
		);

		return $dados;
	}
}