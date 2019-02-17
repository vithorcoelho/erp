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
        		$('#resultado_busca').show();

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
	              }
	            });
	        }
	        else
	        {
	        	$('#resultado_busca').hide();
	        }
        });

		$(document).on('click', '.excluirproduto', function(){
			var idprodutodelete = $(this).attr('href').split('#');

			 $('#content_retorno').find('.' + idprodutodelete[1]).remove();
		});

        $('#resultado_busca').delegate("a", "click", function (){
			
			var dadosProduto = $(this).attr('id');
			var splitDados = dadosProduto.split(':');
			var produtosadicionados = [];
		    
		    $("#content_retorno tr").each(function(index,tr){
		        produtosadicionados.push({ 
		            id_product: $(tr).attr("class"),
		            qtd:  $(tr).find("#qtdproduto").val(),
		        });
		    });

		    var existe = 0;

			$(produtosadicionados).each(function(index, id){
		       if(id.id_product == splitDados[0])
		       {
		       	 existe = 1;

		       	 var idclicado = '.'+splitDados[0];
		       	 var pr = $('#content_retorno').find(idclicado + ' .qtdproduto').val();

		       	 var pr =+ pr + 1;

		       	 $('#content_retorno').find(idclicado + ' .qtdproduto').val(pr);
		       }
		    });

			if(existe == 0)
			{
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
			}
        });

</script>
