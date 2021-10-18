pathArray = location.href.split( '/' );
cadenaurl=pathArray[0]+"//"+pathArray[2]+"/";


function updc8() {
	// alert("ch");
	v1 = parseFloat($("#c5").val()); //inicial
	v2 = parseFloat($("#c6").val()); //salida
	if(v1 != NaN && v2 != NaN ){
	  v3 = ((v2-v1)/v2 * 100).toFixed(3);
	  $('#c7').val(v3);
	}
}
$(document).ready(function(){
    var rs = {
        required: true,
		number: true,
		min: 0,
		max: 150
    };

	$("#formreg").validate({
		rules: {
			c3: {required: true},
			c4: rs,
			c5: rs,
			c6: rs,
			c7: rs,
			c8: rs,
			c9: rs,
			c10: rs,
			c11: {required: false,number: true,min: 0,max: 150},
			c12: {required: false,number: true,min: 0,max: 150},
			c13: rs,
		},
		submitHandler: function() {
			// setup some local variables
			var form = $("#formreg");
			// Let's select and cache all the fields
            var inputs = form.find('input, select, textarea, :button');
			// Serialize the data in the form
			var serializedData = form.serialize();
			// console.log(serializedData);
            inputs.prop( "disabled", true);
			request = $.ajax({
				type: "post",
				url: cadenaurl+ctrl+"/ajaxeditregistro/"+$('#c0').val(),
				data: serializedData
			});
	
			// Callback handler that will be called on success
			request.done(function (response, textStatus, jqXHR){
				// Log a message to the console
				jr = JSON.parse(response);
				if(jr.r)
					swal({
						title: "Datos Editados",
						text: jr.des,
						buttonsStyling: false,
						confirmButtonClass: "btn btn-success btn-fill",
						type: "success"
					}).then((result) => {
						window.location = cadenaurl+ctrl;
						// window.location = window.location;
						// inputs.prop( "disabled", false );
					});
				else
					swal({
						title: "Error",
						text: jr.des,
						buttonsStyling: false,
						confirmButtonClass: "btn btn-danger btn-fill",
						type: "error"
					}).then((result) => {
						// window.location = window.location;
						inputs.prop( "disabled", false );
					});
			});
			// Callback handler that will be called on failure
			request.fail(function (jqXHR, textStatus, errorThrown){
				//window.location = cadenaurl+"cp_pba_02_01_pla?tab=L"; 
				swal({
					title: "Error al guardar los datos!!",
					text: "Puede haber un error en el programa o no haber conexión a internet.",
					buttonsStyling: false,
					confirmButtonClass: "btn btn-danger btn-fill",
					type: "error"
				}).then((result) => {
					inputs.prop( "disabled", false );
				});
			});
		}
	});
	jQuery.extend(jQuery.validator.messages, {
        required: "Este campo es obligatorio.",
        remote: "Por favor, rellena este campo.",
        email: "Por favor, escribe una direccion de correo valida",
        url: "Por favor, escribe una URL valida.",
        date: "Por favor, escribe una fecha valida.",
        dateISO: "Por favor, escribe una fecha (ISO) valida.",
        number: "Por favor, escribe un nÃºmero entero valido.",
        digits: "Por favor, escribe solo di­gitos.",
        creditcard: "Por favor, escribe un numero de tarjeta valido.",
        equalTo: "Por favor, escribe el mismo valor de nuevo.",
        accept: "Por favor, escribe un valor con una extension aceptada.",
        maxlength: jQuery.validator.format("Por favor, no escribas mas de {0} caracteres."),
        minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
        rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
        range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
        max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
        min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
	});
});

/*
* Problemas:
$("input[type='number']").each(function(){
  $(this).val((Math.random()*50).toFixed(2));
})
*/