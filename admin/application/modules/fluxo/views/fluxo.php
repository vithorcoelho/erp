<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>
<?php echo body_open('Movimentação de Caixa'); ?>



	<div class="col-lg-8">
		<div class="modal fade add-receita add-despesa verfluxo form-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		   	<div class="modal-dialog modal-md-5">
		       	<div class="modal-content">
					<div id="loading-modal"></div>
				</div>
			</div>	
		</div>

		<div class="row">
				<div class="col">
					<button class="btn btn-success btn-receita" data-toggle="modal" data-target=".add-receita">
                        <span class="">Receber</span>
                    </button>

					<button class="btn btn-danger btn-despesa" data-toggle="modal" data-target=".add-despesa">
                        <span class="">Pagar</span>
                    </button>
				</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card panel panel-default panel-table">
					<h5 class="card-header">Lançamentos</h5>
	                <div class="card-block ks-browse ks-scrollable jspScrollable"  style="height: 325px; overflow: hidden; padding: 0px" tabindex="0">
	                    <table class="table table-hover stacktable small-only">
	                        <tbody>
	                        	<?php foreach ($fluxo as $v): ?>
	                        	
		                        <tr>
		                        	<td width="130">
		                        		<?php 
		                        			if($v->data == date('Y-m-d')):
		                        				echo 'Hoje';
		                        			elseif($v->data == date('Y-m-d', strtotime("-1 day"))):
		                        				echo 'Ontem';
		                        			else:
		                        				echo date('d/m/Y', strtotime($v->data));
											endif; ?>
		                        	</td>
		                        	<td width="130">
			                        	<a href="<?php echo 'fluxo/verfluxo/' .$v->id ?>">
			                        		<?php if($v->tipo == 'Receita'): ?>
			                        		<span class="badge ks-circle badge-success"><strong style="color: #53b257">Receita</strong></span>
			                        		<?php elseif($v->tipo == 'Despesa'): ?>
			                        		<span class="badge ks-circle badge-danger"><strong style="color: #ef5350">Despesa</strong></span>
			                        		<?php endif; ?>
			                        	</a>
			                        </td>
		                            <td><a href="<?php echo ($v->descricao == 'Venda de mercadoria') ? 'vendas/vervenda/'.$v->SKU : 'fluxo/verfluxo/'.$v->id ?>"><?php echo $v->descricao ?></a></td>
		                            <td><a href="<?php echo base_url('vendas/vervenda/'.$v->SKU) ?>"><?php echo ($v->SKU) ? '<span class="badge badge-default-outline">'.$v->SKU.'</span>' : '' ?></a></td>
		                            <td>
		                            		<?php if($v->tipo == 'Receita'): ?>
		                            		<span class="badge badge-pill badge-success">+R$ <?php echo $v->valor ?></span>
			                        		<?php elseif($v->tipo == 'Despesa'): ?>
			                        		<span class="badge badge-pill badge-danger">+R$ <?php echo $v->valor ?></span>
			                        		<?php endif; ?>
			                        </td>
		                        </tr>
		                    
	                        	<?php endforeach; ?>
	                    	</tbody>
	                	</table>
	                </div>
	                <div class="card-footer">
	                	<ul>
	                		<li >Receita Total Mensal:</li>
	                		<li>Despesa Total Mensal:</li>
	                		<hr>
	                		<li>Saldo Mensal:</li>
	                	</ul>
	                	<ul class="footer-numbers">
	                		<li style="color: #53b257">R$ <?php echo $receitamensal ?></li>
	                		<li style="color: #ef5350">R$ <?php echo $customensal ?></li>
	                		<hr>
	                		<li><?php if(($receitamensal - $customensal) > 0): echo '<span style="color: #53b257">R$ '.($receitamensal - $customensal).'</span>'; else: echo '<span style="color: #ef5350">R$ '.($receitamensal - $customensal).'</span>'; endif; ?></li>
	                	</ul>
	                </div>
	            </div>
			</div>
		</div>
	</div>



<?php echo body_close(); ?>
<?php echo modules::run('footer'); ?>
<?php $this->load->view('script') ?>
</html>