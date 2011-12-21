$(document).ready(function(){

	$("input:text:visible:first").focus();

	var cache = {},	lastXhr;

	$("#ProductSearch").autocomplete({
		delay: 400,
		minLength: 2,
		source: function( request, response ) {
			var term = request.term;
			if ( term in cache ) {
				response( cache[ term ] );
				return;
			}

			lastXhr = $.getJSON( "/products/searchjson.json", request, function( data, status, xhr ) {
				cache[ term ] = data;
				if ( xhr === lastXhr ) {
					response( data );
				}
			});
		}
	});

	var timeout;
	var delay = 500;

	function reloadSearch() {

		var name = $('#ProductSearch').val();

		// $('#loading').show();

		timeout = setTimeout(function() {
			$('#all').load('/products/search', {name: name}, function() {
				// $('#loading').hide();
			});
			setTimeout(function() {}, 500);
		}, delay);

	}

	$('#ProductSearch').keyup(function() {

		var name = $('#ProductSearch').val();

		if (name.length > 3 && name.length < 40) {
			if (timeout) {
	             clearTimeout(timeout);
	        }
			reloadSearch();
		}

	});


});
