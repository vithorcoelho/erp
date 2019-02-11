<script type="text/javascript">   
	$('.btn-receita').click(function(){ 
      loadmodal('#loading-modal', '<?php echo base_url('produtos/modalproduto') ?>');
  });

   $('.filtercliente').click(function(){
    $('.filter-options').toggle();
  });

  $(document).mouseup(function(e) 
  {
      var container = $(".filter-options");

      if (!container.is(e.target) && container.has(e.target).length === 0) 
      {
          container.hide();
      }
  });

  // Busca cliente automaticamente

  $(document).ready(function()
    {
        $('.busca-produto').keyup(function()
        {
            $.ajax({
              type: 'POST',
              url:  '<?php echo base_url('produtos/buscaprodutos') ?>',
              data: {
                  nome: $(".busca-produto").val()
              },
              success: function(data) 
              {
              $('.listaprodutos').hide();
              $('#resultado').html(data);

                var textobusca = $(".busca-produto").val();
                $('h5').html('Resultados de: ' + textobusca);



                if(textobusca != '' && data == '')
                {
                  $('#resultado').html('<h5 style="text-align:center; margin:20px 0; color: #c2c2c2"><i>Nenhum produto encontrado</i></h5>');
                }
                
               if($(".busca-produto").val() == ''){
                 $('.listaprodutos').show();
               }


              }
            });
        });

    });
</script>