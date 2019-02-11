<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>
<?php echo body_open('Vendas'); ?>

	<div class="col-lg-9">
		<div class="modal fade add-receita add-despesa verfluxo form-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		   	<div class="modal-dialog modal-lg">
		       	<div class="modal-content">
					<div id="loading-modal"></div>
				</div>
			</div>	
		</div>

		<div class="row">
				<div class="col">
					<button class="btn btn-success btn-receita" data-toggle="modal" data-target=".add-receita">
                        <span class="">Adicionar pedido</span>
                    </button>

					<a href="<?php echo base_url('pdv') ?>">
	                    <button class="btn btn-info">
	                        <span class="">Abrir PDV</span>
	                    </button>
	                </a>
				</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card panel panel-default panel-table">
	                <h5 class="card-header">Vendas e pedidos</h5>
	                <div class="card-block ks-browse ks-scrollable jspScrollable" style="min-height: 400px; overflow: hidden; padding: 0px;" tabindex="0">
	                    <table class="table table-striped stacktable small-only">
	                        <thead>
	                        	<th><strong>Data</strong></th>
	                        	<th><strong>Cliente</strong></th>
	                        	<th><strong>Cod.</strong></th>
	                        	<th><strong>Status</strong></th>
	                        	<th><strong>Total</strong></th>
	                        </thead>
	                        <tbody>
	                        	<?php if(@$vendas): ?>
	                        	<?php foreach ($vendas as $v): ?>
	                        		<tr>
	                        			<td width="20"><span class="badge badge-pill badge-default-outline"><?php echo date('d/m/Y', strtotime($v->data)) ?></span></td>
	                        			<td><a href="<?php echo base_url('vendas/vervenda/'.$v->chave) ?>"><?php echo $v->nome ?></td>
	                        			<td width="150"><span class="badge badge-default-outline"><?php echo $v->chave ?></span></td>
	                        			<td width="150">
	                        				<?php echo ($v->status == 'Atendido') ? '<span class="badge badge-info">Atendido</span>' : ''?></span>
	                        				<?php echo ($v->status == 'Em andamento') ? '<span class="badge badge-primary">Em espera</span>' : ''?></span>
	                        				<?php echo ($v->status == 'Concluido') ? '<span class="badge badge-success">Concluido</span>' : ''?></span>
	                        				<?php echo ($v->status == 'Entregue') ? '<span class="badge badge-success-outline">Entregue</span>' : ''?></span>
	                        			</td>
	                        			<td width="150"><span class="badge badge-pill badge-success">R$ <?php echo $v->total ?></span></td>
	                        		</tr>
	                        	<?php endforeach; ?>
	                        	<?php endif; ?>
	                    	</tbody>
	                	</table>
	                </div>
	            </div>
			</div>
		</div>
	</div>

<script type="text/javascript">   
  $('.btn-receita').click(function(){ 
      loadmodal('#loading-modal', '<?php echo base_url('vendas/modalvenda') ?>');
  });
</script>

<?php echo body_close(); ?>
<?php echo modules::run('footer'); ?>
</html>