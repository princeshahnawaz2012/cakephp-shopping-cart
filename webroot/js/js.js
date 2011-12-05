$(document).ready(function(){

	$('form').submit(function(){
		$(':submit', this).click(function() {
			return false;
		});
	});
		
});