// Este es un recurso que tienen todas las listas, incluidos sus filtros
pathArray = location.href.split('/');
cadenaurl = pathArray[0] + "//" + pathArray[2] + "/";
var tabs = []

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

//Enviar ajax al controlador actual con la funcion fun y mandando data, ret define si se vuelve a la pagina del controlador(true) o se recarga la actual(false)
function sajax(fun,data,ret=true){
    request = $.ajax({
        type: "post",
        url: cadenaurl + ctrl + "/"+fun+"/",
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

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust();
});