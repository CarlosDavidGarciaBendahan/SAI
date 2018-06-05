$(document).ready(function(){


	$( '#CB' ).on( 'click', function() {
	    if( $(this).is(':checked') ){
	        // Hacer algo si el#CB ha sido seleccionado
	        $('#clientes_naturales').attr("disabled", false);
	        $('#clientes_naturales').attr("required", true);

	        $('#clientes_juridicos').attr("disabled", true);
	        $('#clientes_juridicos').attr("required", false);

	        alert("Ha elegido para la venta registrar un cliente NATURAL");
	    } else {
	        // Hacer algo si el checkbox ha sido deseleccionado
	        $('#clientes_naturales').attr("disabled", true);
	        $('#clientes_naturales').attr("required", false);
	        
	        $('#clientes_juridicos').attr("disabled", false);
	        $('#clientes_juridicos').attr("required", true);
	        alert("Ha elegido para la venta registrar un cliente JURIDICO");
	    }
	});


	/*$(".checkbox").on( 'change', function() {
	    if( $(this).is(':checked') ) {
	        // Hacer algo si el checkbox ha sido seleccionado
	        alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");
	    } else {
	        // Hacer algo si el checkbox ha sido deseleccionado
	        alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
	    }
	});*/

});