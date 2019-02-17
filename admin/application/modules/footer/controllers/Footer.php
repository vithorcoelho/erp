<?php

class Footer extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$dados['footerjs'] = array(
			str_replace('admin/', '', base_url('libs/jquery/jquery.min.js')),
			"https://ned.im/noty/v2/vendor/noty-2.4.1/js/noty/packaged/jquery.noty.packaged.js",
			str_replace('admin/', '', base_url('libs/tether/js/tether.min.js')),
			str_replace('admin/', '', base_url('libs/bootstrap/js/bootstrap.min.js')),
			str_replace('admin/', '', base_url('libs/loading-overlay/loadingoverlay.js')),
			str_replace('admin/', '', base_url('libs/responsejs/response.min.js')),
			str_replace('admin/', '', base_url('libs/tether/js/tether.min.js')),
			str_replace('admin/', '', base_url('libs/jscrollpane/jquery.jscrollpane.min.js')),
			str_replace('admin/', '', base_url('libs/jscrollpane/jquery.mousewheel.js')),
			str_replace('admin/', '', base_url('libs/flexibility/flexibility.js')),
			str_replace('admin/', '', base_url('assets/scripts/common.min.js'))
		);

		$this->load->view('footer', $dados);
	}
}