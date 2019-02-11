<div id="loading-modal">

	<?php echo form_open(null, array('autocomplete'=>'off')) ?>
	<?php echo form_input('valor', set_value('valor'), array('class'=>'form-control add-despesa-valor', 'placeholder'=>'R$0,00', 'required'=>'')) ?>	    

		<button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
		    <span aria-hidden="true" class="la la-close"></span>
		</button>
	<div class="form-modal">

		<div class="modal-body">
			<input type="hidden" name="tipo" value="Despesa">

			<div class="form-group">
				<label><strong>Descrição</strong></label>
				<?php echo form_input('descricao', set_value('descricao'), array('class'=>'form-control', 'required'=>'')) ?>	
			</div>
			<div class="form-group">
				<label><strong>Data</strong></label>
				<div class="form-group row">
			        <div class="col-lg-4">
			            <input name="data" class="form-control flatpickr flatpickr-input active" readonly="readonly" value="<?php echo date('Y-m-d') ?>">
			        </div>
		    	</div>
			</div>
		</div>

		<div class="modal-footer">
	        <button type="button" class="btn btn-primary-outline ks-light" data-dismiss="modal">Fechar</button>
	        <input type="submit" class="btn btn-danger" value="Adicionar">
	    </div>
	    

	    <script src="<?php echo str_replace('admin/', '', base_url()) ?>libs/jquery/jquery.min.js"></script>
		<script src="<?php echo str_replace('admin/', '', base_url()) ?>libs/flatpickr/flatpickr.min.js"></script>
		<script src="<?php echo str_replace('admin/', '', base_url()) ?>libs/prism/prism.js"></script>

		<script type="text/javascript">
			$(".flatpickr").flatpickr();
		</script>
		
	    <script type="text/javascript">
	        $(".form-modal form").submit(function(){
	          	var dados = $(this).serialize();
			
				$('.modal-footer input').attr('disabled', true);
				$('.modal-footer input').attr('value', 'Adicionando');
				$('.form-control').attr('disabled', true);

	         	$.ajax({
			        url: '<?php echo base_url('fluxo/addreceita') ?>',
			        type: "POST",
			        data: dados,
			        success: function (data) {
			        	setTimeout(function(){
			        		noty(data);
							$('.modal-footer input').attr('disabled', false);
							$('.modal-footer input').attr('value', 'Adicionar');
							$('.form-modal input').attr('disabled', false);
							$('#loading-modal input[type=text]').val('');
							$('.form-group .flatpickr').val('<?php echo date('Y-m-d') ?>');
							atualizaFluxo();
						}, 800);
			        },
			        error: function (jqXHR, textStatus, errorThrown) {
			            onError(jqXHR, textStatus, errorThrown);
			        }
			    });
	          return false;
	        });
	    </script>
	    
	</div>
	<?php echo form_close() ?>
</div>
