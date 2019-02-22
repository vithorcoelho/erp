<div id="loading-modal">
	<?php echo form_open('', array('autocomplete'=>'off', 'class'=>'modaladdproduto')) ?>

	<div class="form-modal">
		<h4 class="modal-header">Dados produto</h4>
		<div class="modal-body">
			<div class="form-group">
				<div class="row">
					<div class="col-md-8 form-group">
						<label><strong>Nome do produto*</strong></label>
						<?php echo form_input('nome', set_value('nome'), array('class'=>'form-control')) ?>	
					</div>
						
					<div class="col-md-4 form-group">
						<label><strong>Tipo de produto*</strong></label>
						<?php echo form_input('', set_value('nome'), array('class'=>'form-control')) ?>	
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-md form-group">
						<label><strong>Custo Unitário</strong></label>
						<?php echo form_input('', set_value('preco'), array('class'=>'form-control')) ?>
					</div>

					<div class="col-md form-group">
						<label><strong>Preço Unitário*</strong></label>
						<?php echo form_input('preco', set_value('preco'), array('class'=>'form-control')) ?>
					</div>

					<div class="col-md form-group">
						<label><strong>Preço de Atacado</strong></label>
						<?php echo form_input('', set_value('preco'), array('class'=>'form-control')) ?>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-md form-group">
						<label><strong>SKU</strong></label>
						<?php echo form_input('ref', set_value('ref'), array('class'=>'form-control')) ?>	
					</div>

					<div class="col-md form-group">
						<label><strong>Estoque inicial</strong></label>
						<?php echo form_input('', set_value('ref'), array('class'=>'form-control')) ?>
					</div>

					<div class="col-md form-group">
						<label><strong>Estoque minimo</strong></label>
						<?php echo form_input('', set_value('ref'), array('class'=>'form-control')) ?>
					</div>
				</div>
			</div>
		</div>

		<div class="modal-footer">
	        <button type="button" class="btn btn-primary-outline ks-light" data-dismiss="modal">Fechar</button>
	        <input type="submit" class="btn btn-success" value="Cadastrar">
	    </div>
	</div>
	<?php echo form_close() ?>
</div>
