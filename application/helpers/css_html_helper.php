<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	function alert_red($string, $out = null)
	{
		if($out && $string != '')
		{
			$alert = '<div id="msgflutuante" class="alert alert-danger ks-solid" role="alert">'. $string . '</div>';

			return $alert;
		}
		else
		{
			if($string != '')
			{
				$alert = '<div class="alert alert-danger ks-solid-light" role="alert">'. $string . '</div>';

				return $alert;
			}
			else
			{
				return null;
			}
		}
	}

	function alert_success($string, $out = null)
	{
		if($out && $string != '')
		{
			$alert = '<div id="msgflutuante" class="alert alert-success ks-solid" role="alert">'. $string . '</div>';

			return $alert;
		}
		else
		{
			if($string != '')
			{
				$alert = '<div class="alert alert-success ks-solid" role="alert">'. $string . '</div>';

				return $alert;
			}
			else
			{
				return null;
			}
		}
	}