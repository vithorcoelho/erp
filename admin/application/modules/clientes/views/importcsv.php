<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>
<?php echo body_open('Importando Planilha de Clientes'); ?>


	<div class="col-lg-7">
	<div class="row">
		<div class="col-lg-12">
			<div class="card panel">
				
					<h3 style="text-align: center; margin-top: 50px;">Como importar sua lista de clientes</h3>
				

				<div class="card-block">
					<div style="max-width: 750px; margin: 0 auto; padding: 20px">
						<p><label class="la la-check ks-icon" style="font-size: 18px; margin-right: 10px; color: #5cb85c"></label>Faça uma planilha usando excel.</p>
						<p><label class="la la-check ks-icon" style="font-size: 18px; margin-right: 10px; color: #5cb85c"></label>Crie um cabecalho com as seguintes colunas: <strong>nome, email, cpf, cidade, endereco, telefone, celular.</strong></p>
						<p><label class="la la-check ks-icon" style="font-size: 18px; margin-right: 10px; color: #5cb85c"></label>Salve a planilha em seu computador no formato <strong>CSV(Separado por virgulas).</strong></p>
						<p><label class="la la-check ks-icon" style="font-size: 18px; margin-right: 10px; color: #5cb85c"></label>Clique no botão logo abaixo e envie o arquivo gerado.</p>
					</div>

					<div style="max-width: 200px; margin: 0 auto">
						<?php echo form_open_multipart('clientes/importplanilha') ?>
							<button class="btn btn-info ks-btn-file">
	                            <span class="la la-cloud-upload ks-icon"></span>
	                            <span class="ks-text">Enviar arquivo CSV</span>
	                            <input type="file" name="file">
	                        </button>

	                        <button class="form-control" name="import">Importar Planilha</button>
                        <?php echo form_close(); ?>
					</div>
				</div>
		</div>
		</div>
	</div>
</div>


<?php echo body_close(); ?>
<?php echo modules::run('footer'); ?>
<?php $this->load->view('script_js'); ?>
</html>
