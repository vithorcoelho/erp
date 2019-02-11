<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('login_verify')):
	// Verifica se o usuario esta logado
	function login_verify($redirect = 'admin/login')
	{
		$ci = & get_instance();

		if($ci->session->userdata('logged') != TRUE):
			Set_msg(alert_red('Acesso restrito! Faça login para continuar'));
			redirect($redirect, 'refresh');
		endif;
	}
endif;
