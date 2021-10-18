// Este es un recurso que tienen todos los forms para más comodidad
pathArray = location.href.split('/');
cadenaurl = pathArray[0] + "//" + pathArray[2] + "/";

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

function getDat(idform) { //Obtener los datos de un Form
    form = $("#"+idform);
    dser = form.serializeArray();
    dat = {}
    dser.forEach(v => { dat[v.name] = v.value });
    return dat
}

//Enviar ajax al controlador actual con la funcion fun y mandando data, ret define si se vuelve a la pagina del controlador(true) o se recarga la actual(false)
function fajax(fun,data,fn){
    // console.log("Send Data",data,"fun>",(cadenaurl + ctrl + "/"+fun));
    request = $.ajax({
        url: cadenaurl + ctrl + "/"+fun,
        type: "post",
        data: data
        // data: "codigo=1&hora=12:30"
    });

    // Callback handler that will be called on success
    request.done(function(response, textStatus, jqXHR) {
        // Log a message to the console
        jr = response;
        if (jr.r)
            fn(jr)
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

//Enviar ajax al controlador actual con la funcion fun y mandando data, ret define si se vuelve a la pagina del controlador(true) o se recarga la actual(false)
function dajax(fun,data,fn){ //se envía la data directamente a la función, sin verificar si hay error
    // console.log("Send Data",data,"fun>",(cadenaurl + ctrl + "/"+fun));
    request = $.ajax({
        url: cadenaurl + ctrl + "/"+fun,
        type: "post",
        data: data
        // data: "codigo=1&hora=12:30"
    });

    // Callback handler that will be called on success
    request.done(function(response, textStatus, jqXHR) {
        // Log a message to the console
        jr = response;
        fn(jr)
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

$('.weekpicker').datetimepicker({
    format: 'W - YYYY-MM-DD',    //use this format if you want the 12hours timpiecker with AM/PM toggle
    locale: 'es',
    maxDate: (new Date().toISOString().slice(0, 10)),
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
	}
});
$('.weekpicker').on('dp.change', function (e) {
    var value = $(this).val();
    format = 'W - YYYY-MM-DD'
    var firstDate = moment(value, format).day(0).format(format);
    $(this).val(firstDate);
});
$('.monthpicker').datetimepicker({
    format: 'MM - YYYY-MM-DD',    //use this format if you want the 12hours timpiecker with AM/PM toggle
    locale: 'es',
    maxDate: (new Date().toISOString().slice(0, 10)),
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
	}
});
$('.monthpicker').on('dp.change', function (e) {
    var value = $(this).val();
    format = 'MM - YYYY-MM-DD'
    var firstDate = moment(value, format).date(1).format(format);
    $(this).val(firstDate);
});