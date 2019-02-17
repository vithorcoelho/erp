<?php

class Head extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$dados['headcss'] = array(
			str_replace('admin/', '', base_url('libs/bootstrap/css/bootstrap.min.css')),
			str_replace('admin/', '', base_url('assets/fonts/line-awesome/css/line-awesome.min.css')),
			str_replace('admin/', '', base_url('assets/fonts/montserrat/styles.css')),
			str_replace('admin/', '', base_url('libs/tether/css/tether.min.css')),
			str_replace('admin/', '', base_url('libs/jscrollpane/jquery.jscrollpane.css')),
			str_replace('admin/', '', base_url('libs/flag-icon-css/css/flag-icon.min.css')),
			str_replace('admin/', '', base_url('assets/styles/common.min.css')),
			str_replace('admin/', '', base_url('assets/styles/themes/primary.min.css')),
			str_replace('admin/', '', base_url('assets/fonts/kosmo/styles.css')),
			str_replace('admin/', '', base_url('assets/fonts/weather/css/weather-icons.min.css')),
			str_replace('admin/', '', base_url('libs/prism/prism.css')),
			str_replace('admin/', '', base_url('libs/flatpickr/flatpickr.min.css')),
			str_replace('admin/', '', base_url('assets/styles/animate.css')),
			base_url('assets/theme.css'));

		$this->load->view('head', $dados);		
	}
}