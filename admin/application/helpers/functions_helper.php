<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('set_msg')):
	// Seta uma mensagem via session para ser lida posteriosmente
	function Set_msg($msg = NULL)
	{
		$ci = & get_instance();
		$ci->session->set_userdata('aviso', $msg);
	}
endif;

if(!function_exists('get_msg')):
	// Retorna uma mensagem definida pela função set_msg
	function Get_msg($destroy = TRUE)
	{
		$ci = & get_instance();
		$retorno  = $ci->session->userdata('aviso');
		if($destroy) $ci->session->unset_userdata('aviso');

		return $retorno;
	}
endif;

if(!function_exists('config_upload')):
	function config_upload($path = 'upload', $nome = null, $type = 'png|jpg|jpeg|gif', $size = 2048)
	{
		$config['file_name'] 			= $nome;
		$config['upload_path']          = $path;
        $config['allowed_types']        = $type;
        $config['max_size']             = $size;
        $config['overwrite']			= TRUE;

        return $config;
	}
endif;