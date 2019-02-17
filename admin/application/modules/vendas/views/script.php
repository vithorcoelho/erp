<script type="text/javascript">

	var contador = 3;

	$('.btn-produto').click(function(){
		
		var produto = $('.produtos').find('.produto-adicional').html();
		$('.produtos').append('<div class="row produto-adicional'+contador+'">'+produto+'</div>');

		$('.produto-adicional'+contador+' select').attr('name', 'produto'+contador);
		$('.produto-adicional'+contador+' .preco').attr('name', 'preco'+contador);
		$('.produto-adicional'+contador+' .quantidade').attr('name', 'quantidade'+contador);
		$('.produto-adicional'+contador+' .buttonclose').attr('id', 'produto-adicional'+contador);

		contador = contador + 1;
		
		return false;
	});
</script>

<script type="text/javascript">

		$('#busca').click(function(){
			if($(this).val() != '')
			{
				$('#resultado_busca').show();
			}
		});

        $('#busca').keyup(function()
        {
        	var campo = $(this).val();

        	if(campo.length >= 1){
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
	              	console.log(retorno);
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

				$('#resultado_busca').hide();
			}
        });
</script>

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
				$('.modal').modal('hide');
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