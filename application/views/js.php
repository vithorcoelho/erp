<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url(''); ?>libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(''); ?>libs/responsejs/response.min.js"></script>
<script src="<?php echo base_url(''); ?>libs/tether/js/tether.min.js"></script>
<script src="<?php echo base_url(''); ?>libs/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(''); ?>libs/jscrollpane/jquery.jscrollpane.min.js"></script>
<script src="<?php echo base_url(''); ?>libs/jscrollpane/jquery.mousewheel.js"></script>
<script src="<?php echo base_url(''); ?>libs/flexibility/flexibility.js"></script>
<script src="<?php echo base_url(''); ?>libs/noty/noty.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url('assets/admin/'); ?>scripts/common.min.js"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<script src="<?php echo base_url(''); ?>libs/d3/d3.min.js"></script>
<script src="<?php echo base_url(''); ?>libs/c3js/c3.min.js"></script>
<script src="<?php echo base_url(''); ?>libs/noty/noty.min.js"></script>
<script src="<?php echo base_url(''); ?>libs/maplace/maplace.min.js"></script>
<script src="<?php echo base_url(''); ?>libs/select-multi/multi.min.js"></script>

<script type="text/javascript">
    setTimeout(function() {
        $('#msgflutuante').fadeIn(1000);
    }, 500);
    setTimeout(function() {
        $('#msgflutuante').fadeOut(2000);
    }, 3000);
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js" type="text/javascript"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    var content = $('#main');

    //pre carregando o gif
    loading = new Image(); loading.src = '<?php echo base_url('assets/images/loader.gif') ?>';
    $('#link-load').live('click', function( e ){

      e.preventDefault();
      content.html( '<img class="loader" src="<?php echo base_url('assets/images/loader.gif') ?>" />' );
      var href = $( this ).attr('href');

      history.pushState('<?php echo base_url(); ?>','', href);

      $.ajax({
        url: href,

        success: function( response ){
          //forçando o parser
          var data = $( '<div>'+response+'</div>' ).find('#main').html();

          //apenas atrasando a troca, para mostrarmos o loading
          window.setTimeout( function(){
            content.fadeOut('slow', function(){
              content.html( data ).fadeIn('slow');
            });
          }, 1500 );
        }
      });
    });

    $('#form-load').submit(function(){

      var dados = $(this).serialize();

      $.ajax({
        type: "POST",
        data: dados,
        success: function( data )
        {
          setTimeout(function() {
        $('#msgflutuante').fadeIn(1000);
        }, 500);
        setTimeout(function() {
            $('#msgflutuante').fadeOut(2000);
        }, 3000);
            }
      });
      
      return false;

    });
  });
  </script>