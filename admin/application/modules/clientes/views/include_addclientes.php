<div id="loading-modal">

	<?php echo form_open('', array('autocomplete'=>'off', 'class'=>'modaladdcliente')) ?>

	<div class="form-modal">
		<h4 class="modal-header">Dados cliente</h4>
		<div class="modal-body">
			<div class="form-group">
				<label><strong>Nome*</strong></label>
				<?php echo form_input('nome', set_value('nome'), array('class'=>'form-control')) ?>	
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-md-8">
						<label><strong>Email</strong></label>
						<?php echo form_input('email', set_value('email'), array('class'=>'form-control')) ?>
					</div>
					<div class="col-md-4">
						<label><strong>CPF</strong></label>
						<?php echo form_input('cpf', set_value('cpf'), array('class'=>'form-control')) ?>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-md-4">
						<label><strong>Cidade</strong></label>
						<?php echo form_input('cidade', set_value('cidade'), array('class'=>'form-control')) ?>
					</div>
					<div class="col-md-8">
						<label><strong>Endereço</strong></label>
						<?php echo form_input('endereco', set_value('endereco'), array('class'=>'form-control')) ?>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<label><strong>Telefone</strong></label>
						<?php echo form_input('telefone', set_value('telefone'), array('class'=>'form-control')) ?>
					</div>
					<div class="col-md-6">
						<label><strong>Celular</strong></label>
						<?php echo form_input('celular', set_value('celular'), array('class'=>'form-control')) ?>
					</div>
				</div>
			</div>
		</div>

		<div class="modal-footer">
	        <button type="button" class="btn btn-primary-outline ks-light" data-dismiss="modal">Fechar</button>
	        <input type="submit" class="btn btn-success disabled-click" value="Cadastrar">
	    </div>

	</div>
	<?php echo form_close() ?>
</div>
