// Este es un recurso que tienen todos los forms para más comodidad
pathArray = location.href.split('/');
cadenaurl = pathArray[0] + "//" + pathArray[2] + "/";

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

$('.datepicker').datetimepicker({
    format: 'YYYY-MM-DD',    //use this format if you want the 12hours timpiecker with AM/PM toggle
    maxDate: "now",
    icons: {
        time: "fa fa-clock-o",
        use24hours: true,
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
    },
});
$('.datehourpicker').datetimepicker({
    format: 'YYYY-MM-DD HH:mm',    //use this format if you want the 12hours timpiecker with AM/PM toggle
    maxDate: "now",
    icons: {
        time: "fa fa-clock-o",
        use24hours: true,
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
    },
});

//Enviar ajax al controlador actual con la funcion fun y mandando data, ret define si se vuelve a la pagina del controlador(true) o se recarga la actual(false)
function sajax(fun,data,ret=true){
    request = $.ajax({
        type: "post",
        url: cadenaurl + ctrl + "/"+fun,
        data: data
    });

    // Callback handler that will be called on success
    request.done(function(response, textStatus, jqXHR) {
        // Log a message to the console
        jr = response;
        if (jr.r)
            Swal.fire({
                title: "Operación Exitosa",
                text: jr.m,
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success btn-fill",
                type: "success"
            }).then((result) => {
                if(ret)
                    window.history.back();
                    // window.location = cadenaurl + ctrl
                else
                    location.reload()
            });
        else
            Swal.fire({
                title: "Error",
                text: jr.m,
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger btn-fill",
                type: "error"
            }).then((result) => {
                // window.location = window.location;
            });
    });
    request.fail(function(jqXHR, textStatus, errorThrown) {
        Swal.fire({
            title: "Error en el Servidor",
            text: "Puede haber un error en el programa o no haber conexión a internet.",
            buttonsStyling: false,
            confirmButtonClass: "btn btn-danger btn-fill",
            type: "error"
        }).then((result) => {});
    });
}

//Enviar ajax al controlador actual con la funcion fun y mandando data, mostrar mensaje de confirmacion
function cajax(fun,data,text="",sub="",ret=true){
    confirm(()=>{
        request = $.ajax({
            type: "post",
            url: cadenaurl + ctrl + "/"+fun,
            data: data
        });
    
        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            // Log a message to the console
            jr = response;
            if (jr.r)
                Swal.fire({
                    title: "Operación Exitosa",
                    text: jr.m,
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-success btn-fill",
                    type: "success"
                }).then((result) => {
                    if(ret)
                        window.history.back();
                        // window.location = cadenaurl + ctrl
                    else
                        location.reload()
                });
            else
                Swal.fire({
                    title: "Error",
                    text: jr.m,
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-danger btn-fill",
                    type: "error"
                }).then((result) => {
                    // window.location = window.location;
                });
        });
        request.fail(function(jqXHR, textStatus, errorThrown) {
            Swal.fire({
                title: "Error en el Servidor",
                text: "Puede haber un error en el programa o no haber conexión a internet.",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger btn-fill",
                type: "error"
            }).then((result) => {});
        });
    },data,text,sub)
}

//Al confirmar se ejecuta la funcion fun usando data como parametro
function confirm(fun, data, text = "¿Seguro de que quiere eliminar el registro?", sub="La eliminación será permanente") {
    Swal.fire({
        title: text,
        text: sub,
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value)
            fun(data)
    })
}

var formurl;
$("#formreg").validate({
    rules: {
        CodPers: {
            pattern: "^[0-9]{6}"
        }
    },
    messages: {
        CodPers: "El código tiene una longitud de 6 caracteres y solo números"
    },
    submitHandler: function() {
        var serializedData = $("#formreg").find('input, select, textarea, :button').serialize();
        // console.log(serializedData);
        // inputs.prop("disabled", true);
        request = $.ajax({
            type: "post",
            url: cadenaurl + ctrl + "/" + formurl,
            data: serializedData
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            // Log a message to the console
            jr = response;
            if (jr.r)
                Swal.fire({
                    title: "Datos Editados",
                    text: jr.m,
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-success btn-fill",
                    type: "success"
                }).then((result) => {
                    // window.location = cadenaurl + ctrl;
                    window.location = window.location;
                    // inputs.prop( "disabled", false );
                });
            else
                Swal.fire({
                    title: "Error",
                    text: jr.m,
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-danger btn-fill",
                    type: "error"
                }).then((result) => {
                    // window.location = window.location;
                    // inputs.prop("disabled", false);
                });
        });
        // Callback handler that will be called on failure
        request.fail(function(jqXHR, textStatus, errorThrown) {
            Swal.fire({
                title: "Error al guardar los datos!!",
                text: "Puede haber un error en el programa o no haber conexión a internet.",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger btn-fill",
                type: "error"
            }).then((result) => {
                // inputs.prop("disabled", false);
            });
        });
    }
});