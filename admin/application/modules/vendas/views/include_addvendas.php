<div id="loading-modal">

	<?php echo form_open('', array('autocomplete'=>'off')) ?>

	<div class="form-modal">
		<div ><h4 class="modal-header">Dados do pedido</h4></div>
		<div class="modal-body scroll">

			<div class="form-group">
				<h4>Cliente</h4>
	                <select  class="form-control ks-select" tabindex="-1" aria-hidden="true" name="cliente" required>
	                <option value="">Selecione um cliente</option>
	                <?php foreach ($clientes as $v): ?>
	                <option value="<?php echo $v->id ?>"><?php echo $v->nome ?></option>
	                <?php endforeach; ?>
	                </select>
			</div>
			<br>

			<div class="form-group">
				<h4>Produtos</h4>

				<form action="" method="post" enctype="multipart/form-data" id="form_busca">
					<input type="text" id="busca" class="form-control" placeholder="Buscar produtos...">
				</form>

				<div id="resultado_busca" class="listaprodutosvendas scroll"></div>
				<br>
				
				<table border="0" cellpadding="0" cellspacing="0" width="80%" class="table table-bordered table-striped stacktable large-only">
					<tbody id="content_retorno"></tbody>
				</table>
			</div>

			<h4>Detalhes</h4>

			<div class="form-group">
				<label><strong>Observações</strong></label>
				<textarea name="obs" class="form-control"></textarea>
			</div>

			<div class="form-group">
				<label><strong>Situação</strong></label>
				<select class="form-control" name="status">
					<option value="Em andamento">Em andamento</option>
					<option value="Atendido">Atendido</option>
					<option value="Entregue">Entregue</option>
					<option value="Concluido">Concluido</option>
				</select>
			</div>
	</div>

	<div class="modal-footer">
	    <button type="button" class="btn btn-primary-outline ks-light" data-dismiss="modal">Fechar</button>
	    <input type="submit" class="btn btn-success" value="Salvar">
	</div>
	
	<?php $this->load->view('include_scriptjs') ?>
	<?php echo form_close() ?>
</div>

