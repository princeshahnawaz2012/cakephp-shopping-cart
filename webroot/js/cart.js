$(document).ready(function(){

	$('.numeric').keypress(function(event) {
		if (event.keyCode == 13) {
			return true;
		}
		return /\d/.test(String.fromCharCode(event.keyCode));
	});
	
	$(".remove").each(function() {
		$(this).replaceWith('<a class="remove" href="/shop/remove/' + $(this).attr('id') + '"><img src="/img/trash.png" alt="Remove" /></a>');
	});
	
});