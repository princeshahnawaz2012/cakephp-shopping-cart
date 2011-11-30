$(document).ready(function(){

	$('.numeric').keypress(function(event) {
		return /\d/.test(String.fromCharCode(event.keyCode));
	});
	
	$(".remove").each(function() {
		$(this).replaceWith('<a class="remove" href="/stores/remove/' + $(this).attr('id') + '">remove</a>');
	});
	
});