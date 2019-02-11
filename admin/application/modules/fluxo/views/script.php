<script type="text/javascript">
	function atualizaFluxo()
	{
	  $.ajax({
	  url: '<?php echo base_url('fluxo') ?>',
	  type: 'POST',
	  success: function(res) {
	    var data = $( '<div>'+res+'</div>' ).find('.stacktable').html();
	      $(".small-only").html(data);
	    var data2 = $( '<div>'+res+'</div>' ).find('.card-footer').html();
	      $(".card-footer").html(data2);
	    }
	  });
	}

  $('.btn-receita').click(function(){ 
      loadmodal('#loading-modal', '<?php echo base_url('fluxo/addreceita') ?>');
  });
  $('.btn-despesa').click(function(){ 
      loadmodal('#loading-modal', '<?php echo base_url('fluxo/adddespesa') ?>');
  });
</script>