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