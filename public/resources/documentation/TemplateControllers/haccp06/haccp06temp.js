pathArray = location.href.split('/');
cadenaurl = pathArray[0] + "//" + pathArray[2] + "/";
var backColors = ["rgba(255,0,0,1)", "rgba(255,255,0,1)", "rgba(0,204,0,1)"]; //Rojo, Amarillo, Verde
var lineColors = ["rgba(255,51,51,0.7)", "rgba(102,204,102,0.7)", "rgba(102,102,255,0.7)", "rgba(102,51,204,0.7)"]; //t1, t2, t3, t4

var irel;
var d; //Para manipular la data global
var chh1;var chh2;var chh3;
var chc;
var bg = ["black", "orange", "darkgreen", "darkblue"];
var labs = ["MEJORADO","TROZADO","BRASA","GALLINA"]
var maxth = 60;
function fillArray(value, len) {
    var arr = [];
    for (var i = 0; i < len; i++)
        arr.push(value);
    return arr;
}
var chartPluginLineaHorizontal = {
    beforeDraw: function(chartobj) {
        if (chartobj.options.lineaHorizontal) {
            s = chartobj.options.lineaHorizontal.d;
            for(i in s){
                var lineAt = s[i];
                var ctxPlugin = chartobj.chart.ctx;
                var xAxe = chartobj.scales[chartobj.config.options.scales.xAxes[0].id];
                var yAxe = chartobj.scales[chartobj.config.options.scales.yAxes[0].id];
                ctxPlugin.strokeStyle = "red";
                ctxPlugin.beginPath();
                lineAt = yAxe.height * (1.05 - (lineAt - yAxe.min)/(yAxe.max - yAxe.min));
                ctxPlugin.moveTo(xAxe.left, lineAt);
                ctxPlugin.lineTo(xAxe.right, lineAt);
                ctxPlugin.stroke();
            }
        }
    }
}
// Chart.pluginService.register(chartPluginLineaHorizontal);
// Chart.pluginService.register(chartPluginLineaHorizontal);
// EJ> conf.lineaHorizontal = {d: [2.0]};

/*
Documentación:
    Se utiliza una función por cada Gráfico con la notación:
        [codreg][ngraf]
    En esta vista tenemos los siguientes gráficos:
        HACCP08: (CONTROL DE TEMPERATURA DE SALMUERA)
            tlper - TReal Porcentaje de Injección(líneas - Promedio Porcentaje)
            tltsa - TReal Temperatura salm (líneas - Promedio T < 4)
            dltsa - Diario (lineas - Promedio T < 4)
            sltsa - Semanal (lineas - Promedio T < 4)
*/

// tlper - TReal Porcentaje de Injección
function loadHaccp06tlper() {
    // AJAX
    request = $.ajax({
        type: "post",
        url: cadenaurl + "haccp06/ajaxHaccp06tlper/" //Solicitar la data del día agrupada cada 5 segundos
    });
    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {
        jr = JSON.parse(response);
        if (jr.r) {
            // Procesar data
            d = JSON.parse(jr.d);
            data = [];
            data["1"] = [];
            data["2"] = [];
            data["3"] = [];
            data["4"] = [];

            $.each(d, function (i, v) {
                $.each(v, function (k, sv) {
                    if(data[v.tp][k] == null) data[v.tp][k] = [];
                    data[v.tp][k].push(sv);
                });
            });

            // console.log(data);
            // Conf estable
            conf = {
                hover: {mode: null},
                animation: false,
                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: false,
                            },
                            ticks: {
                                beginAtZero: false,
                                suggestedMax: 6,
                                suggestedMin: 0,
                                gridlines: {
                                    display: false
                                }
                            }
                        }
                    ]
                },
                legend: {
                    labels: {
                        filter: function(item, chart) {
                            // Logic to remove a particular legend item goes here
                            return (item.text=='');
                        }
                    }
                }
            };
            // Insertar data en gráficos
            bor = "black";
            for (i in lineColors) {
                ib = parseInt(i) + 1;
                dt = {
                    labels: data[ib]["hora"],
                    datasets: [
                        {
                            type: "line",
                            label: labs[i],
                            data: data[ib]["p"],
                            backgroundColor: lineColors[i],
                            fill: false,
                            borderColor: lineColors[i],
                            borderWidth: 1
                        }
                        ,
                    ]
                };
                // console.log('#tlmed'+ib);
                ch1 = new Chart($('#tlper' + ib), { type: "line", data: dt, options: conf });
            }
        }
        else {
            swal({
                title: "Error al cargar los datos!!",
                text: "Error en la consulta.",
                buttonsStyling: false,
                timer: 1000,
                confirmButtonClass: "btn btn-danger btn-fill",
                type: "error"
            });
        }
    });
    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown) {
        swal({
            title: "Error al cargar los datos!!",
            text: "Puede haber un error en el programa o no haber conexión a internet.",
            buttonsStyling: false,
            timer: 1000,
            confirmButtonClass: "btn btn-danger btn-fill",
            type: "error"
        });
    });
    // AJAX
}
// tltsa - TReal Temperatura salm
function loadHaccp06tltsa() {
    // AJAX
    request = $.ajax({
        type: "post",
        url: cadenaurl + "haccp06/ajaxHaccp06tltsa/" //Solicitar la data del día agrupada cada 5 segundos
    });
    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {
        jr = JSON.parse(response);
        if (jr.r) {
            // Procesar data
            d = JSON.parse(jr.d);
            data = [];
            data["hora"] = [];

            $.each(d, function (i, v) {
                $.each(v, function (k, sv) {
                    if(data[k] == null) data[k] = [];
                    data[k].push(sv);
                });
            });

            l = data["hora"].length;
            data["l1"] = fillArray(4, l+2);
            console.log(data);
            // Conf estable
            conf = {
                hover: {mode: null},
                animation: false,
                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: false,
                            },
                            ticks: {
                                suggestedMax: 6,
                                suggestedMin: 0,
                                beginAtZero: false,
                                gridlines: {
                                    display: false
                                }
                            }
                        }
                    ]
                },
                legend: {
                    labels: {
                        filter: function(item, chart) {
                            // Logic to remove a particular legend item goes here
                            return (item.text=='');
                        }
                    }
                }
            };
            // Insertar data en gráficos
            bor = "white";
            dt = {
                labels: data["hora"],
                datasets: [
                    {
                        type: "line",
                        label: "Temperatura (C°)",
                        data: data["t"],
                        backgroundColor: lineColors[2],
                        fill: false,
                        borderColor: bor,
                        borderWidth: 2,
                    }
                    ,
                    // LIM Aceptable
                    {
                        label: "Aceptable si es menor que",
                        data: data["l1"],
                        backgroundColor: backColors[2],
                        fill: "origin",
                        borderColor: backColors[2],
                        borderWidth: 1,
                        pointRadius: 0,
                        borderDash: [10, 5]
                    }
                    ,
                    // LIM Error
                    {
                        label: "Error a partir de",
                        data: data["l1"],
                        backgroundColor: backColors[0],
                        fill: "end",
                        borderColor: backColors[0],
                        borderWidth: 1,
                        pointRadius: 0,
                        borderDash: [10, 5]
                    }
                    ,
                ]
            };
            ch1 = new Chart($('#tltsa'), { type: "line", data: dt, options: conf });
        }
        else {
            swal({
                title: "Error al cargar los datos!!",
                text: "Error en la consulta.",
                buttonsStyling: false,
                timer: 1000,
                confirmButtonClass: "btn btn-danger btn-fill",
                type: "error"
            });
        }
    });
    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown) {
        swal({
            title: "Error al cargar los datos!!",
            text: "Puede haber un error en el programa o no haber conexión a internet.",
            buttonsStyling: false,
            timer: 1000,
            confirmButtonClass: "btn btn-danger btn-fill",
            type: "error"
        });
    });
    // AJAX
}
// dltsa - Diario
function loadHaccp06dltsa() {
    // AJAX
    request = $.ajax({
        type: "post",
        url: cadenaurl + "haccp06/ajaxHaccp06dltsa/" //Solicitar la data del día agrupada cada 5 segundos
    });
    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {
        jr = JSON.parse(response);
        if (jr.r) {
            // Procesar data
            d = JSON.parse(jr.d);
            data = [];
            data["fecha"] = [];

            $.each(d, function (i, v) {
                $.each(v, function (k, sv) {
                    if(data[k] == null) data[k] = [];
                    data[k].push(sv);
                });
            });

            l = data["fecha"].length;
            console.log(data);
            // Conf estable
            conf = {
                hover: {mode: null},
                animation: false,
                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: false,
                            },
                            ticks: {
                                suggestedMax: 4.5,
                                suggestedMin: 0,
                                beginAtZero: false,
                                gridlines: {
                                    display: false
                                }
                            }
                        }
                    ]
                },
                legend: {
                    labels: {
                        filter: function(item, chart) {
                            // Logic to remove a particular legend item goes here
                            return (item.text=='');
                        }
                    }
                }
            };
            // Insertar data en gráficos
            bor = "white";
            conf.lineaHorizontal = {d: [4.0]};
            dt = {
                labels: data["fecha"],
                datasets: [
                    {
                        type: "bar",
                        label: "Temperatura",
                        data: data["t"],
                        backgroundColor: lineColors[2],
                        fill: false,
                        borderColor: bor,
                        borderWidth: 2,
                        maxBarThickness: maxth,
                    }
                    ,
                ]
            };
            ch1 = new Chart($('#dltsa'), { type: "bar", data: dt, options: conf });
        }
        else {
            swal({
                title: "Error al cargar los datos!!",
                text: "Error en la consulta.",
                buttonsStyling: false,
                timer: 1000,
                confirmButtonClass: "btn btn-danger btn-fill",
                type: "error"
            });
        }
    });
    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown) {
        swal({
            title: "Error al cargar los datos!!",
            text: "Puede haber un error en el programa o no haber conexión a internet.",
            buttonsStyling: false,
            timer: 1000,
            confirmButtonClass: "btn btn-danger btn-fill",
            type: "error"
        });
    });
    // AJAX
}

// sltsa - Semanal
function loadHaccp06sltsa() {
    // AJAX
    request = $.ajax({
        type: "post",
        url: cadenaurl + "haccp06/ajaxHaccp06sltsa/" //Solicitar la data del día agrupada cada 5 segundos
    });
    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {
        jr = JSON.parse(response);
        if (jr.r) {
            // Procesar data
            d = JSON.parse(jr.d);
            data = [];
            data["semana"] = [];

            $.each(d, function (i, v) {
                $.each(v, function (k, sv) {
                    if(data[k] == null) data[k] = [];
                    data[k].push(sv);
                });
            });

            // Conf estable
            conf = {
                hover: {mode: null},
                animation: false,
                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: false,
                            },
                            ticks: {
                                suggestedMax: 4.5,
                                suggestedMin: 0,
                                beginAtZero: false,
                                gridlines: {
                                    display: false
                                }
                            }
                        }
                    ]
                },
                legend: {
                    labels: {
                        filter: function(item, chart) {
                            // Logic to remove a particular legend item goes here
                            return (item.text=='');
                        }
                    }
                }
            };
            // Insertar data en gráficos
            conf.lineaHorizontal = {d: [4.0]};
            bor = "white";
            dt = {
                labels: data["semana"],
                datasets: [
                    {
                        type: "bar",
                        label: "Temperatura",
                        data: data["t"],
                        backgroundColor: lineColors[2],
                        fill: false,
                        borderColor: bor,
                        borderWidth: 2,
                        maxBarThickness: maxth,
                    }
                    ,
                ]
            };
            ch1 = new Chart($('#sltsa'), { type: "bar", data: dt, options: conf });
        }
        else {
            swal({
                title: "Error al cargar los datos!!",
                text: "Error en la consulta.",
                buttonsStyling: false,
                timer: 1000,
                confirmButtonClass: "btn btn-danger btn-fill",
                type: "error"
            });
        }
    });
    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown) {
        swal({
            title: "Error al cargar los datos!!",
            text: "Puede haber un error en el programa o no haber conexión a internet.",
            buttonsStyling: false,
            timer: 1000,
            confirmButtonClass: "btn btn-danger btn-fill",
            type: "error"
        });
    });
    // AJAX
}




// Cambiar el intervalo de tiempo
function chint(time) {
    clearInterval(irel);
    irel = setInterval(function () { loadHaccp06Tchi(); }, time); //Intervalo de recarga
}


$(document).ready(function () {
    $.ajaxSetup({ cache: false });
    Chart.pluginService.register(chartPluginLineaHorizontal);
    irel = setInterval(function () { loadHaccp06tlper();loadHaccp06tltsa();}, 5000); //Intervalo de recarga
    loadHaccp06tlper();
    loadHaccp06tltsa();
    loadHaccp06dltsa();
    loadHaccp06sltsa();
});