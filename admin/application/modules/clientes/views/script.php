<script type="text/javascript">

  $('.btn-cliente').click(function(){
      loadmodal('#loading-modal', '<?php echo base_url('clientes/modalcliente') ?>');
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
        $('.busca-cliente').keyup(function()
        {
          $('.loader-busca').addClass('loader').addClass('loader-sm');

            $.ajax({
              type: 'POST',
              url:  '<?php echo base_url('clientes/buscaclientes') ?>',
              data: {
                  nome: $(".busca-cliente").val()
              },
              success: function(data) 
              {
              $('.listaclientes').hide();
              $('#resultado').html(data);

                var textobusca = $(".busca-cliente").val();
                $('h5').html('Resultados de: ' + textobusca);

                setTimeout(function() {
                     $('.loader-busca').removeClass('loader').removeClass('loader-sm');
                 }, 400);

                if(textobusca != '' && data == '')
                {
                  $('#resultado').html('<h5 style="text-align:center; margin:20px 0; color: #c2c2c2"><i>Nenhum cliente encontrado</i></h5>');
                }
                
               if($(".busca-cliente").val() == ''){
                 $('.listaclientes').show();
               }


              }
            });
        });

    });
</script>