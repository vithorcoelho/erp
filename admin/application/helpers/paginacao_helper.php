<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	function createPaginate( $_modulo, $_total, $per_page, $rota)
	{	
		$ci = &get_instance();
		$ci->load->library('pagination');

		$config['base_url']    = base_url($_modulo);
		$config['total_rows']  = $_total;
		$config['per_page']    =  $per_page;
		$config["uri_segment"] = $rota;

		// Bootstrap 4, work very fine.
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = ['class' => 'page-link'];
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$ci->pagination->initialize($config);
		return $ci->pagination->create_links();
	}