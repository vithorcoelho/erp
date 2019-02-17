<script type="text/javascript">   
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

<script type="text/javascript">
     $("form").submit(function(){
        var dados = $(this).serialize();
        $('.modal-footer input').attr('disabled', true);
        $('.modal-footer input').attr('value', 'Adicionando');
        $('.form-control').attr('disabled', true);
        
        $.ajax({
         url: '<?php echo base_url('produtos/addproduto') ?>',
         type: "POST",
         data: dados,
         success: function (data) {
          setTimeout(function(){
            $('.modal-footer input').attr('disabled', false);
            $('.modal-footer input').attr('value', 'Cadastrar');
            $('.form-control').attr('disabled', false);
            $('#loading-modal input[type=text]').val('');
            $('.modal').modal('hide');
      }, 800);
         },
         error: function (jqXHR, textStatus, errorThrown) {
             onError(jqXHR, textStatus, errorThrown);
         }
      });
       return false;
     });
</script>