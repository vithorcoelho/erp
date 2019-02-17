<?php

class Footer extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->view('footer');

		$this->output->cache(30);
		
	}
}