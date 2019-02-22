<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('set_message_cookie')):
	// Seta uma mensagem via session para ser lida posteriosmente
	function set_message_cookie($msg = NULL)
	{
		if($msg)
		{
			set_cookie('message_cookie', ($msg), 100);
		}
	}
endif;

if(!function_exists('get_message_cookie')):
	// Retorna uma mensagem definida pela função set_msg
	function get_message_cookie($destroy = TRUE)
	{
		$msg = (get_cookie('message_cookie'));

		delete_cookie('message_cookie');

		return $msg;
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