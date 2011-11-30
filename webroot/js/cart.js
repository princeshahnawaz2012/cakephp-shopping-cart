$(document).ready(function(){

	$('.numeric').keypress(function(event) {
		return /\d/.test(String.fromCharCode(event.keyCode));
	});
	
	$(".remove").each(function() {
	  	var text = $(this).attr('id').split('_');
		$(this).replaceWith('<a class="remove" href="/stores/remove/' + text[0] +  '">remove</a>');
	});
	
});