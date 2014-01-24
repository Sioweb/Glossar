(function($){
var layer = null,
	glossarTimeout = false;
$(function(){
	$('.glossar').mouseenter(function(e){
		var id = $(this).data('glossar'),
			glossar = $(this);
			
		$('body').find('.glossar_layer').remove();
		
		layer = $('body').append('<div class="glossar_layer" />')
			.find('.glossar_layer')
			.css({
				top: (glossar.offset().top - 40),
				left: (glossar.offset().left - 40),
				opacity: 1
			}).mouseenter(function(){
				clearTimeout(glossarTimeout);
			}).mouseleave(function(){
				glossarTimeout = setTimeout(removeLayer, 2000);
			}).append('<div class="ce_glossar_close">X</div>')
				
			$('.glossar_layer').find('.ce_glossar_close')
				.click(function(){
					$(this).parent().remove();
				});
		
		$.ajax({
			type: "POST",
			url:  "ajax.php",
			data: { isAjaxRequest: 1, glossar: 1, id: id},
			success: function(result)
			{
				$(layer).append($($.parseJSON(result).content));
			}
		});
	}).mouseleave(function(e){
		glossarTimeout = setTimeout(removeLayer, 2000);
	});
});})(jQuery);

function removeLayer()
{
	$('body').find('.glossar_layer').remove();
}