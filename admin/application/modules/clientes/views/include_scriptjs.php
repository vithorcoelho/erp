<script type="text/javascript">

$('.arquivo').click(function(){
  $('.boxarquivo').toggle();
});

$('.filtercliente').click(function(){
  $('.filter-options').toggle();
});

$(document).mouseup(function(e) 
{
    var container = $(".filter-options");
    var boxarquivo = $('.boxarquivo');
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
    }
    if (!boxarquivo.is(e.target) && boxarquivo.has(e.target).length === 0) 
    {
        boxarquivo.hide();
    }
});

// Busca cliente
$(document).ready(function()
{
    $('.busca-cliente').keyup(function()
    {
      $('.loader-busca').addClass('loader').addClass('loader-sm');
      $('.pagination').hide();

        $.ajax({
          type: 'POST',
          url:  '<?php echo base_url('clientes/ajax_buscarclientes') ?>',
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
            
           if($(".busca-cliente").val() == '')
           {
             $('.listaclientes').show();
             $('.pagination').show();
           }
          }
        });
    });
});

function atualizaTabela()
{
  $('.table tbody').html('').append('<div class="loader-center"><div class="loader loader-sm"></div><div>');
  $.ajax({
    url: '<?php echo base_url(uri_string()) ?>',
    success: function(response){
      //forçando o parser
      var data = $( '<div>'+response+'</div>' ).find('.table tbody').html();
      //apenas atrasando a troca, para mostrarmos o loading
      window.setTimeout( function(){
        $('.table tbody').hide();
        $('.table tbody').html(data);
        $('.table tbody').fadeIn(600);
      }, 250 );
    }
  });
}

$(".modaladdcliente").submit(function(){
   var dados = $(this).serialize();

   $('html').css('cursor', 'wait');

   $('.modal-footer input').attr('disabled', true);
   $('.modal-footer input').attr('value', 'Cadastrando');
   $('.form-control').attr('disabled', true);
   
   $.ajax(
   {
      url: '<?php echo base_url('clientes/ajax_cadastrarcliente') ?>',
      type: "POST",
      data: dados,
      dataType: 'json',
      success: function (response)
      {
        setTimeout(function()
        {
           $('.modal-footer input').attr('disabled', false);
           $('.modal-footer input').attr('value', 'Cadastrar');
           $('.form-control').attr('disabled', false);
           $('html').css('cursor', 'auto');
          
           if(response.error)
           {
             msg_flutuante(response.error, 'danger');
           }
           if(response.success)
           {
             atualizaTabela();
             $('#loading-modal input[type=text]').val('');
             $('.modal').modal('hide');
             window.setTimeout( function(){ msg_flutuante(response.success, 'success', 'topCenter')},500);
           }
        },350);
      }
  });
  return false;
});       
</script>