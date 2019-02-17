function loadPage(href, content){
    $.ajax({
      url: href,
      success: function( response ){
        //forçando o parser
        var data = $( '<div>'+response+'</div>' ).find('#main').html();
        //apenas atrasando a troca, para mostrarmos o loading
        window.setTimeout( function(){
          content.hide(1, function(){
            content.html( data ).show();
          });
        }, 600 );
      }
    });
}

function loadmodal(content, href)
{
      //e.preventDefault();
      var content = $(content);
      $(content).html( '<div class="loader loader-sm"></div>' );
      $.ajax({
          url: href,
          success: function( response ){
            //forçando o parser
            var data = $( '<div>'+response+'</div>' ).find('#loading-modal').html();
            window.setTimeout( function(){
              content.hide(1, function(){
                content.html( data ).show();
              });
            }, 800 );
          }
      });
}
function msg_flutuante(texto, tipo, posicao = 'topCenter', tema = 'relax')
{
                noty({
                text: '<strong>'+texto+'</strong>',
                layout: posicao,
                theme: tema, // or relax metroui
                type: tipo,
                  animation: {
                      open: 'animated fadeInDown', // Animate.css class names
                      close: 'animated fadeOutUp', // Animate.css class names
                      easing: 'swing',
                  },
                  timeout: 1000
              });
}



//    $('##link-load').live('click', function( e )
//    {
//        var content = $('#main');
//        var href = $( this ).attr('href');
//    	   history.pushState({page: 1}, '', href);
//        $('.ks-navbar-menu a').removeClass('ks-active');      
//        $(this).addClass('ks-active');
//        e.preventDefault();
//        content.html( '<div class="loader loader-lg"></div>' );
//          
//        //history.pushState('<?php echo base_url(); ?>','', href);
//        urlatual = '<?php echo base_url(); ?>'+href;
//       	loadPage(href, content)
//    });