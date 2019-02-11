<div id="loading-modal">

	<?php echo form_open_multipart('produtos/addproduto', array('autocomplete'=>'off')) ?>

	<button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
	    <span aria-hidden="true" class="la la-close"></span>
	</button>

	<div class="form-modal">
		<div class="modal-body">
			<div class="form-group">
				<label><strong>Nome*</strong></label>
				<?php echo form_input('nome', set_value('nome'), array('class'=>'form-control', 'required'=>'')) ?>	
			</div>

			<div class="form-group">
				<label><strong>Preço Unitário*</strong></label>
				<?php echo form_input('preco', set_value('preco'), array('class'=>'form-control', 'required'=>'')) ?>
			</div>

			<div class="form-group">
				<label><strong>Cógido de Referência</strong></label>
				<?php echo form_input('ref', set_value('ref'), array('class'=>'form-control')) ?>
			</div>
		</div>

		<div class="modal-footer">
	        <button type="button" class="btn btn-primary-outline ks-light" data-dismiss="modal">Fechar</button>
	        <input type="submit" class="btn btn-success" value="Cadastrar">
	    </div>
	</div>
	<?php echo form_close() ?>
</div>
