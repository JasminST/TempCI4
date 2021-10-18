
pathArray = location.href.split('/');
cadenaurl = pathArray[0] + "//" + pathArray[2] + "/";
var $validator = $("#FormEliRequerimiento").validate({
    rules: {

        Motivo: {
            required: true
        }
    },
    submitHandler: function (form) {

        event.preventDefault();
    }
});
var table = $('#LstRegistros').DataTable({
    "scrollX": true,
    "autoWidth": true,
    "scrollCollapse": true,
    "pagingType": "full_numbers",
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

    "paging": true,
    "processing": true,
    language: {
        paginate: {
            previous: "<",
            next: ">"
        }
    },
    "searching": true,
    "lengthChange": true,
    "ordering": false,
    "info": false,
    "pageLength": 10,
    "bProcessing": true,

    "order": [[5, 'desc']],
    "oLanguage": {
        "sUrl": cadenaurl + "public/assets/js/cp_pba_02_01_pla/spanish.json"
    }
    ,
    "createdRow": function ( row, data, index ) {
        console.log(data[2]);
        if ( data[2] == '34306' ) {
            $('td', row).eq(8).text('TARDE');
            $('td', row).eq(8).addClass('text-danger');
        }
    },
    pagingType: $(window).width() < 768 ? "simple" : "simple_numbers"

});
var tablec = $('#ListaConsulta').DataTable( {
    "scrollX": true,
    "autoWidth":true,
    "scrollCollapse": true,
    "pagingType": "full_numbers",
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

     paging: true,
    "processing": true,
    language: {
        paginate: {
            previous: "<",
            next: ">"
        }
    },
    "searching": true,
    "lengthChange": false,
    "ordering": false,
    "info":     false,
    "pageLength": 10,
    "bProcessing": true,

      "order": [[ 5, 'desc' ] ],
      "oLanguage": {
      "sUrl":cadenaurl+"public/assets/js/cp_pba_02_01_pla/spanish.json"
    }
    ,
    pagingType: $(window).width() < 768 ? "simple" : "simple_numbers"
           
});


$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
var target = $(e.target).attr("href") // activated tab
if(target==='#formulario'){
table.columns.adjust().draw();
}
else if(target==='#formulario1'){
tablec.columns.adjust().draw();
}
else{
table.columns.adjust().draw();
}
});

$('#idfechaconsulta').datetimepicker({
    format: 'YYYY-MM-DD',    //use this format if you want the 12hours timpiecker with AM/PM toggle
    icons: {
      time: "fa fa-clock-o",
      use24hours: true,
      setDate: new Date(),
      date: "fa fa-calendar",
      up: "fa fa-chevron-up",
      down: "fa fa-chevron-down",
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-screenshot',
      clear: 'fa fa-trash',
      close: 'fa fa-remove'
    },
    maxDate: moment()
  });



function delregistro(id) {
    Swal.fire({
        title: '¿Seguro de que quiere eliminar el registro?',
        text: "La eliminación será permanente",
        type: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value)
            sajax('cp_pba_02_01_pla/ajaxeliregistro/' + id + '', "{id:" + id + "}", "Registro eliminado", "Error al eliminar");
    })
}




function sajax(cfunc, data, rsuccess = "Datos editados", rfail = "Error al editar") {
    request = $.ajax({
        type: "post",
        url: cadenaurl + cfunc,
        data: data
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {
        // Log a message to the console
        jr = JSON.parse(response);
        if (jr.r)
            swal({
                title: rsuccess,
                text: jr.des,
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success btn-fill",
                type: "success"
            }).then((result) => {
                window.location = window.location;
                // inputs.prop( "disabled", false );
            });
        else
            swal({
                title: rfail,
                text: jr.des,
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger btn-fill",
                type: "error"
            }).then((result) => {
                // window.location = window.location;
                // inputs.prop( "disabled", false );
            });
    });
    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown) {
        //window.location = cadenaurl+"cp_pba_02_01_pla?tab=L"; 
        swal({
            title: "Error al guardar los datos!!",
            text: "Puede haber un error en el programa o no haber conexión a internet.",
            buttonsStyling: false,
            confirmButtonClass: "btn btn-danger btn-fill",
            type: "error"
        }).then((result) => {
            inputs.prop("disabled", false);
        });
    });
}