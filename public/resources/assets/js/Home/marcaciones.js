//el documento carga primera vez
pathArray = location.href.split('/');
cadenaurl = pathArray[0] + "//" + pathArray[2] + "/";

$(document).ready(function() {

    
    var tablamarc=$('#tblmarcaciones').DataTable( {
        "pagingType": "full_numbers",
        "searching": false,
        "ajax": cadenaurl+'/home/ultIngresos',
        "paging": false,
        "ordering":false,
        "bInfo" : false,
        "scrollX": true,
        "pagingType": "full_numbers",
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        responsive: true,
        language: {
            url: cadenaurl+"recursos/assets/js/Home/es_es.json"
        },
        "columnDefs": [
            {
                "targets": [ 5 ],
                "visible": false
            }
        ]
        ,
        "order": [[ 5, "asc" ]]
    } );
    $('#ihora').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',    //use this format if you want the 12hours timpiecker with AM/PM toggle
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

    $("#marcacion").keyup(function() {
        if($(this).val().length >= 6) {
            var codigo=$(this).val();
            // enviamos ayjax para registrar asistencia
            request = $.ajax({
                url: cadenaurl + "home/setMarcacion",
                type: "post",
                data: "codigo="+codigo+"&hora="+$("#ihora").val()
                // data: {codigo: codigo, hora: $("#ihora").val()}
            });

            request.done(function (response, textStatus, jqXHR) {
                // Log a message to the console
                jr = JSON.parse(response);
                    if (jr.rpta){
                        muestraNotificacion('bottom','center',jr.msg);
                        tablamarc.ajax.reload( null, false );
                    }
                    else 
                    {
                        muestraNotificacionError('bottom','center',jr.msg);
                    }

                });
                // Callback handler that will be called on failure
                request.fail(function (jqXHR, textStatus, errorThrown) {
                    //window.location = cadenaurl+"cp_pba_02_01_pla?tab=L"; 
                    $.notify({
                        icon: "ti-close",
                        message: "Error general consulte con su administrador del sistema"
                
                    },{
                        type: type[4],
                        delay: 2000,
                        placement: {
                            from: 'bottom',
                            align: 'center'
                        }
                    });
                });

                $(this).val("");


            
        } else {
           
        }
    });


 

} );

function muestraNotificacion(from, align,msg){
    color = Math.floor((Math.random() * 4) + 1);

    $.notify({
        icon: "ti-check-box",
        message: msg

    },{
        type: type[2],
        delay: 10000,
        placement: {
            from: from,
            align: align
        }
    });
  }
  function muestraNotificacionError(from, align,msg){
    color = Math.floor((Math.random() * 4) + 1);

    $.notify({
        icon: "ti-close",
        message: msg

    },{
        type: type[4],
        delay: 10000,
        placement: {
            from: from,
            align: align
        }
    });
  }