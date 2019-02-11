<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	$route['default_controller'] = 'index';
	$route['404_override'] = '';
	$route['translate_uri_dashes'] = FALSE;

	####### ROTAS WILDCARDS #########
	$route['admin'] = "admin/estatisticas";
	$route['admin/cliente/editar/(:num)'] = "admin/cliente/editar/$1";
	$route['admin/vendedores/delete/(:num)']['get'] = "admin/vendedores/delete/$1";