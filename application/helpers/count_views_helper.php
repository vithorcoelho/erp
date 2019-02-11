<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('count_views')):
	// Seta uma mensagem via session para ser lida posteriosmente
	function count_views()
	{
		$file = __DIR__ . '\application\\files\\views.txt';
		echo $file;
		$handle = fopen('../files/views.php', 'r+');
		$read = fread($handle, 512);
	}
endif;