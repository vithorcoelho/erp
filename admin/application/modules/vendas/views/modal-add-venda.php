<div id="loading-modal">

<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>libs/select2/css/select2.min.css"> <!-- Original -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/styles/libs/select2/select2.min.css"> <!-- Customization -->

	<?php echo form_open('vendas/addvenda', array('autocomplete'=>'off')) ?>

	<div class="form-modal">
		<div class="modal-body">
			<div class="form-group">
				<label><strong>Cliente</strong></label>
				<div class="form-group">
	                <select  class="form-control ks-select" tabindex="-1" aria-hidden="true" name="cliente" required>
	                <option value="">Selecione um cliente</option>
	                <?php foreach ($clientes as $v): ?>
	                <option value="<?php echo $v->id ?>"><?php echo $v->nome ?></option>
	                <?php endforeach; ?>
	                </select>
	            </div>
			</div>

			<div class="form-group row">
				<div class="form-group produtos col-11">
						<div class="row produto">
							<div class="col-4">
								<label><strong>Produto*</strong></label>
								<select class="form-control" name="produto1" required>
								<option value="">Selecione um produto</option>
				                <?php foreach ($produtos as $v): ?>
				                <option class="option" value="<?php echo $v->nome ?>"><?php echo $v->nome ?></option>
				                <?php endforeach; ?>
				                </select>
							</div>
							
							<div class="col-4">
								<label><strong>Preço*</strong></label>
								<input class="form-control preco" type="text" name="preco1" required>
							</div>

							<div class="col-3">
								<label><strong>Quantidade*</strong></label>
								<input class="form-control quantidade" type="text" name="quantidade1" required>
							</div>

							<div class="col-1">
			            		<div class="form-group">
			            			<label style="color: #FFF">.</label>
									<button class="btn btn-success btn-produto ks-no-text">
						                <span class="la la-plus ks-icon"></span>
						            </button>
			            		</div>
							</div>
						</div>

						<div class="row produto-adicional">
							<div class="col-4">
								<select class="form-control" name="produto2" required>
								<option value="">Selecione um produto</option>
				                <?php foreach ($produtos as $v): ?>
				                <option class="option" value="<?php echo $v->nome ?>"><?php echo $v->nome ?></option>
				                <?php endforeach; ?>
				                </select>
							</div>
							
							<div class="col-4">
								<input class="form-control preco" type="text" name="preco2" required>
							</div>

							<div class="col-3">
								<input class="form-control quantidade" type="text" name="quantidade2" required>
							</div>

							<div class="col-1">
			            		<div class="form-group">
									<button class="btn btn-danger ks-no-text buttonclose" id="produto-adicional2">
						                <span class="la la-close ks-icon"></span>
						            </button>
			            		</div>
							</div>
						</div>
				</div>

	            	
			</div>

			<div class="form-group">
				<label><strong>Observações</strong></label>
				<textarea name="obs" class="form-control"></textarea>
			</div>

			<div class="form-group">
				<label><strong>Status</strong></label>
				<select class="form-control" name="status">
					<option value="Em andamento">Em andamento</option>
					<option value="Atendido">Atendido</option>
					<option value="Entregue">Entregue</option>
					<option value="Concluido">Concluido</option>
				</select>
			</div>
			
		<div class="modal-footer">
	        <button type="button" class="btn btn-primary-outline ks-light" data-dismiss="modal">Fechar</button>
	        <input type="submit" class="btn btn-success" value="Adicionar">
	    </div>

	    <script type="text/javascript">
	        $("form").submit(function(){
	          	var dados = $(this).serialize();
			
				$('.modal-footer input').attr('disabled', true);
				$('.modal-footer input').attr('value', 'Adicionando');
				$('.form-control').attr('disabled', true);

	         	$.ajax({
			        url: '<?php echo base_url('vendas/addvenda') ?>',
			        type: "POST",
			        data: dados,
			        success: function (data) {
			        	setTimeout(function(){
			        		noty(data);
			        		$('.modal-footer input').attr('disabled', false);
							$('.modal-footer input').attr('value', 'Adicionar');
							$('.form-control').attr('disabled', false);
							$('.form-modal select').attr('disabled', false);
							$('#loading-modal input[type=text]').val('');
							atualizaVendas();
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

<?php $this->load->view('script') ?>
<?php echo form_close() ?>
</div>
