<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>
<?php echo body_open('Venda'); ?>

<div class="col-lg-8">

<div class="row">
					<div class="col-lg-6">
						<h4><?php echo $cliente[0]->nome ?></h4>
						<strong>Data da venda: <span><?php echo $venda[0]->data ?></span> </strong>
					</div>

					<div class="col-6">
						<button class="btn btn-danger" data-toggle="modal" data-target=".btn-excluir">
		                <span class="la la-close ks-icon"></span>
		                <span class="ks-text">Exluir</span>
		            	</button>

		            	<button class="btn btn-primary">
			                <span class="la la-pencil ks-icon"></span>
			                <span class="ks-text">Editar</span>
		            	</button>	
					
						<button class="btn btn-primary-outline">
			                <span class="la la-file ks-icon"></span>
			                <span class="ks-text">Imprimir</span>
		            	</button>
					</div>
</div>
	<div class="row">
		<div class="col-lg-8">
			<div class="card panel">
	<h5 class="card-header">Pedido</h5>
		<?php echo form_open(null, array('autocomplete'=>'off', 'class'=>'form-pedido')) ?>

		<div class="card-block">
			<div class="card-body">
				 <?php foreach ($produtos as $v): ?>
				<div class="row produto-adicional">
							<div class="col-4">
				               	<input type="text" disabled="" value="<?php echo $v->produto ?>" class="form-control">
							</div>
							
							<div class="col-4">
								<input class="form-control preco" type="text" value="<?php echo $v->preco ?>" disabled="">
							</div>

							<div class="col-4">
								<input class="form-control quantidade" type="text" value="<?php echo $v->preco ?>" disabled="">
							</div>
				</div><?php endforeach; ?>
				<br>

				<div class="form-group">
					<textarea class="form-control" disabled="">
						<?php echo $venda[0]->obs ?>
					</textarea>
				</div>	
			</div>
		</div>
		<?php echo form_close() ?>

		<div class="modal fade btn-excluir form-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		   	<div class="modal-dialog modal-sm">
						<div class="alert alert-danger ks-solid" role="alert">
                            <h5 class="alert-heading">Tem certeza?</h5>
                            <p>Excluir uma venda pode as alterar todas as informações de relatório</p>
                            <div class="ks-actions">
                                 <button type="button" class="btn btn-danger-outline" data-dismiss="modal">Cancelar</button>
                                <a href="<?php echo base_url('vendas/deletarvenda/'.$venda[0]->chave) ?>" class="btn btn-danger ks-approve">Sim</a>
                            </div>
                        </div>
			</div>	
		</div>
		
</div>
		</div>
	
<div class="col-lg-4">
	<div class="card panel">
		<h5 class="card-header">Dados Cliente</h5>

			<div class="card-block">
				<div class="card-body">
					<table class="table">
						<tbody>
							<li>
								<strong>Nome:</strong> <?php echo $cliente[0]->nome ?>
							</li>

							<li>
								<strong>CPF:</strong> <?php echo $cliente[0]->cpf ?>
							</li>

							<li>
								<strong>Email:</strong> <?php echo $cliente[0]->email ?>
							</li>

							<li>
								<strong>Telefone:</strong> <?php echo $cliente[0]->telefone ?>
							</li>

							<li>
								<strong>Celular:</strong> <?php echo $cliente[0]->celular ?>
							</li>

							<li>
								<strong>Cidade:</strong> <?php echo $cliente[0]->cidade ?>
							</li>

							<li>
								<strong>Endereço:</strong> <?php echo $cliente[0]->endereco ?>
							</li>
						</tbody>
					</table>

					
				</div>
			</div>
	</div>		
</div>

	</div>



<?php echo body_close(); ?>
<?php echo modules::run('footer'); ?>

</html>
<script type="text/javascript">
     $(".form-cliente").submit(function(){
       	var dados = $(this).serialize();
		$('.card-footer input').attr('disabled', true);
		$('.card-footer input').attr('value', 'Salvando');
		$('.form-control').attr('disabled', true);
      	$.ajax({
       url: '<?php echo base_url('clientes/atualizacliente') ?>',
       type: "POST",
       data: dados,
       success: function (data) {
       	setTimeout(function(){
       		noty(data);
			$('.card-footer input').attr('disabled', false);
			$('.card-footer input').attr('value', 'Salvar');
			$('form input').attr('disabled', false);
			$('#loading-modal input[type=text]').val('');
		}, 800);
       },
       error: function (jqXHR, textStatus, errorThrown) {
           onError(jqXHR, textStatus, errorThrown);
       }
   });
       return false;
     });
</script>