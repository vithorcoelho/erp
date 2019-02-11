<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>
<?php echo body_open('PDV') ?>

	<link href="<?php echo base_url('assets') ?>/pdv.css" type="text/css" rel="stylesheet" />

		<form action="" method="post" enctype="multipart/form-data" id="form_busca">
			<label>
				<span>Buscar Produto</span>
				<input type="text" name="buscar" id="busca" />
			</label>
		</form>

		<div id="resultado_busca"></div>

		<form action="" method="post" enctype="multipart/form-data">
			<table border="0" cellpadding="0" cellspacing="0" width="80%">
				<thead>
					<tr>
						<td>Produto</td>
						<td>Valor</td>
						<td>Qtd</td>
						<td>Subtotal</td>
					</tr>
				</thead>

				<tbody id="content_retorno">

				</tbody>
			</table>
			<input type="submit" value="Concluir compra" class="botao" />
		</form>

<?php echo modules::run('footer'); ?>

<script type="text/javascript">

        $('#busca').keyup(function()
        {
        	var campo = $(this).val();

        	if(campo.length >= 2){
	            $.ajax({
	              type: 'POST',
	              url:  '<?php echo base_url('pdv/buscaprodutos') ?>',
	              dataType: 'json',
	              data: {
	                  texto: $("#busca").val()
	              },
	              success: function(retorno) 
	              {
	              		$('#resultado_busca').html(retorno.dados);

					alert(retorno.qtd);
	              }
	            });
	        }
        });

        $('#resultado_busca').delegate("a", "click", function (){
			
			var dadosProduto = $(this).attr('id');
			var splitDados = dadosProduto.split(':');

			$.ajax({
				method: 'post',
				url: '<?php echo base_url('pdv/addproduto') ?>',
				data: {
					idproduto: splitDados[0]
				},
				dataType: 'json',
				success: function(retorno){
					$('tbody#content_retorno').append(retorno.dados);
				}
				});
        });

</script>
