<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>

<?php $header = ($fluxo[0]->tipo == 'Receita') ? 'Receita' : 'Despesa' ?>

<?php echo body_open($header); ?>

<div class="col-lg-5">
		<form class="form-fluxo" method="post" autocomplete="off">
			<div class="card">
				<div class="form-group">
					<input type="number" name="valor" value="<?php echo $fluxo[0]->valor ?>" class="form-control <?php if($fluxo[0]->tipo == 'Receita'): echo "add-receita-valor"; else: echo "add-despesa-valor"; endif; ?>" placeholder="R$0,00" required>	
				</div>

				<div class="card-body">
					<div class="card-block">
						<input type="hidden" name="id" value="<?php echo $fluxo[0]->id ?>">
						<input type="hidden" name="tipo" value="<?php echo $fluxo[0]->tipo ?>">
						<div class="form-group">
							<label><strong>Descrição</strong></label>
							<?php echo form_input('descricao', $fluxo[0]->descricao, array('class'=>'form-control', 'required'=>'')) ?>	
						</div>
						<div class="form-group">
							<label><strong>Data</strong></label>
							<div class="form-group row">
						        <div class="col-lg-4">
						            <input name="data" class="form-control flatpickr flatpickr-input active" readonly="readonly" value="<?php echo $fluxo[0]->data; ?>">
						        </div>
					    	</div>
						</div>
						
					</div>
				</div>

				<div class="card-footer">
					<a href="<?php echo base_url("fluxo/deletandofluxo") ?>/<?php echo $fluxo[0]->id ?>" class="btn btn-danger">Excluir</a>
				    <input type="submit" class="btn btn-success" value="Salvar">
				</div>
			</div>	
		</form>
</div>
</div>

<?php echo body_close(); ?>
<?php echo modules::run('footer'); ?>
</html>

<script src="<?php echo base_url() ?>libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>libs/flatpickr/flatpickr.min.js"></script>
<script src="<?php echo base_url() ?>libs/prism/prism.js"></script>

<script type="text/javascript">
	$(".flatpickr").flatpickr();
</script>

<script type="text/javascript">
	        $(".form-fluxo").submit(function(){
	          	var dados = $(this).serialize();
			
				$('.card-footer input').attr('disabled', true);
				$('.card-footer input').attr('value', 'Salvando');
				$('.form-control').attr('disabled', true);

	         	$.ajax({
			        url: '<?php echo base_url('fluxo/atualizafluxo') ?>',
			        type: "POST",
			        data: dados,
			        success: function (data) {
			        	setTimeout(function(){
			        		noty('Editado com sucesso!');
							$('.card-footer input').attr('disabled', false);
							$('.card-footer input').attr('value', 'Adicionar');
							$('.form-control').attr('disabled', false);
							
						}, 800);
			        },
			        error: function (jqXHR, textStatus, errorThrown) {
			            onError(jqXHR, textStatus, errorThrown);
			        }
			    });
	          return false;
	        });
	    </script>