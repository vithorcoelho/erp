<script type="text/javascript">

	$('#busca').click(function()
	{
		if($(this).val() != '')
		{
			$('#resultado_busca').show();
		}
	});

	$('#busca').keyup(function()
	{
		var campo = $(this).val();

		if(campo.length >= 1)
		{
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

	$(document).on('click', '.excluirproduto', function()
	{
		var idprodutodelete = $(this).attr('href').split('#');
		
		$('#content_retorno').find('.' + idprodutodelete[1]).remove();
	});

    $('#resultado_busca').delegate("a", "click", function ()
    {
		var dadosProduto = $(this).attr('id');
		var splitDados = dadosProduto.split(':');
		var produtosadicionados = [];
		    
		$("#content_retorno tr").each(function(index, tr)
		{
		    produtosadicionados.push({
		        id_product: $(tr).attr("class"),
		        qtd:  $(tr).find("#qtdproduto").val(),
		    });
		});

		var existe = 0;

		$(produtosadicionados).each(function(index, id)
		{
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

	function atualizaTabela()
	{
	  $('.table tbody').html('').append('<div class="loader-center"><div class="loader loader-sm"></div><div>');
	  $.ajax({
	    url: '<?php echo base_url('vendas') ?>',
	    success: function(response)
	    {
			var data = $( '<div>'+response+'</div>' ).find('.table tbody').html();

			window.setTimeout(function(){
			  $('.table tbody').hide().html(data).fadeIn(600);
			},250);
	    }
	  });
	}

    $("form").submit(function(){
    	var dados = $(this).serialize();

    	$('html').css('cursor', 'wait');
		$('.modal-footer input').attr('disabled', true).attr('value', 'Salvando');
		$('.form-control').attr('disabled', true);
      	
      	$.ajax({
	       url: '<?php echo base_url('vendas/ajax_cadastrarvenda') ?>',
	       type: "POST",
	       data: dados,
	       dataType: 'json',
	       success: function (data)
	       {
		       	setTimeout(function()
		       	{
		       		$('html').css('cursor', 'auto');
		       		$('.modal-footer input').attr('disabled', false).attr('value', 'Salvar');
					$('.form-control').attr('disabled', false);

					$('#loading-modal input[type=text]').val('');
					$('.modal').modal('hide');

					atualizaTabela();
					msg_flutuante(data, 'success', 'bottomCenter');
				},800);
	       }
   		});
       return false;
     });
 </script>