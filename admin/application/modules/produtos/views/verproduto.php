<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>
<?php echo body_open('Produtos'); ?>

<div class="col-lg-5">
	<?php echo @Get_msg(); ?>
	
	<div class="card panel">
	<h5 class="card-header">Dados Produto</h5>
	<?php echo form_open_multipart('produtos/atualizaproduto', array('autocomplete'=>'off')) ?>

	<button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
	    <span aria-hidden="true" class="la la-close"></span>
	</button>

	<div class="form-modal">
		<div class="modal-body">
			<input type="hidden" name="id" value="<?php echo $produto[0]->id ?>">
			<div class="form-group">
				<label><strong>Nome*</strong></label>
				<?php echo form_input('nome', $produto[0]->nome, array('class'=>'form-control', 'required'=>'')) ?>	
			</div>

			<div class="form-group">
				<label><strong>Custo Unitário</strong></label>
				<?php echo form_input('custo', $produto[0]->custo, array('class'=>'form-control')) ?>
			</div>

			<div class="form-group">
				<label><strong>Preço Unitário*</strong></label>
				<?php echo form_input('preco', $produto[0]->preco, array('class'=>'form-control', 'required'=>'')) ?>
			</div>

			<div class="form-group">
				<label><strong>Cógido de Referência</strong></label>
				<?php echo form_input('ref', $produto[0]->ref, array('class'=>'form-control')) ?>
			</div>
		</div>
		<div class="card-footer">
			<a href="<?php echo base_url("produtos/deletandoproduto/" . $produto[0]->id) ?>" class="btn btn-danger">Excluir</a>
	       	<input type="submit" class="btn btn-success" value="Salvar">
	   	</div>
	</div>
	<?php echo form_close() ?>
	</div>
</div>
</html>

<script type="text/javascript">
     $("aform").submit(function(){
       	var dados = $(this).serialize();
		$('.card-footer input').attr('disabled', true);
		$('.card-footer input').attr('value', 'Salvando');
		$('.form-control').attr('disabled', true);
      	$.ajax({
       url: '<?php echo base_url('produtos/atualizaproduto') ?>',
       type: "POST",
       data: dados,
       success: function (data) {
       	setTimeout(function(){
       		noty(data);
			$('.card-footer input').attr('disabled', false);
			$('.card-footer input').attr('value', 'Salvar');
			$('form input').attr('disabled', false);
		}, 800);
       },
       error: function (jqXHR, textStatus, errorThrown) {
           onError(jqXHR, textStatus, errorThrown);
       }
   });
       return false;
     });
</script>