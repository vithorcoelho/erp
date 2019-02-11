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
				$alert = '<div class="alert alert-danger ks-solid" role="alert">'. $string . '</div>';
				
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

	function open_modal($class, $titulo, $tamanho = '5')
	{
	echo '<div class="modal fade '.$class.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		    <div class="modal-dialog modal-sm-'.$tamanho.'">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title">'.$titulo.'</h5>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                    <span aria-hidden="true" class="la la-close"></span>
		                </button>
		            </div>
		            <div class="modal-body">';
	}
	function close_modal()
	{
		echo '</div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-primary-outline ks-light" data-dismiss="modal">Fechar</button>
		                <button id="submit" class="btn btn-success">Salvar</button>
		            </div>
		        </div>
		    </div>
		</div>';
	}

	function body_open($titulo = null)
	{
	echo '<main id="main">
			<div class="ks-page-container">
			    <div class="ks-column ks-page">
			        <div class="ks-header">
			            <section class="ks-title">
			                <h3>'.$titulo.'</h3>
			            </section>
			        </div>
			        <div class="ks-content">
			            <div class="ks-body">
			                <div class="ks-nav-body-wrapper">
			                	<div class="container-fluid ks-rows-section">
			                    	<div class="row justify-content-center">';
	}
	function body_close()
	{
		echo '						</div>
								</div>	
							</div>
						</div>
					</div>
			     </div>
			</div>
		</main>';
	}