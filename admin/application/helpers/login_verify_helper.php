<?php

if(!function_exists('login_verify')):
	// Verifica se o usuario esta logado
	function login_verify($redirect = 'login')
	{
		$ci = & get_instance();

		if($ci->session->userdata('logged') != TRUE):
			set_message_cookie(alert_red('Acesso restrito! Faça login para continuar'));
			redirect('http://localhost/erp/login', 'refresh');
		endif;
	}
endif;
