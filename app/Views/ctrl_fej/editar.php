<?= $this->extend('layouts/layout_trab') ?>

<?= $this->section('css') ?>

<style>
  .dz-image-preview {
    background-color: black;
  }
</style>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
function printForm($input, $b, $dtreg)
{
  $d = $b && isset($input["data"]["name"]);
  switch ($input["type"]) {
    case 'select':
      echo "<label> " . $input["label"] . " </label>";
      if (array_key_exists("disabled", $input) && $input["disabled"]) $input["data"]["disabled"] = true;
      echo form_dropdown($input["data"]["name"], $input["options"], ($d ? $dtreg[$input["data"]["name"]] : ''), $input["data"]);
      if (array_key_exists("valid-feed", $input)) echo '<div class="valid-feedback"> ' . $input["data"]["valid-feed"] . '</div>';
      if (array_key_exists("invalid-feed", $input)) echo '<div class="invalid-feedback"> ' . $input["data"]["invalid-feed"] . '</div>';
      break;
    case 'input':
      if (array_key_exists("label", $input)) echo "<label> " . $input["label"] . " </label>";
      if (array_key_exists("disabled", $input) && $input["disabled"]) $input["data"]["disabled"] = true;
      $input["data"]["value"] = ($d ? $dtreg[$input["data"]["name"]] : (isset($input["data"]["value"]) ? $input["data"]["value"] : ''));
      echo '<div class="input-group">';
        if (array_key_exists("preigtext", $input)) echo "<span class='input-group-text'>" . $input["preigtext"] . "</span>";
        echo form_input($input["data"]);
        if (array_key_exists("posigtext", $input)) echo "<span class='input-group-text'>" . $input["posigtext"] . "</span>";
        if (array_key_exists("valid-feed", $input)) echo '<div class="valid-feedback"> ' . $input["valid-feed"] . '</div>';
        if (array_key_exists("invalid-feed", $input)) echo '<div class="invalid-feedback"> ' . $input["invalid-feed"] . '</div>';
      echo '</div>';
      break;
    case 'textarea':
      if (array_key_exists("label", $input)) echo "<label> " . $input["label"] . " </label>";
      if (array_key_exists("disabled", $input) && $input["disabled"]) $input["data"]["disabled"] = true;
      $input["data"]["value"] = ($d ? $dtreg[$input["data"]["name"]] : (isset($input["data"]["value"]) ? $input["data"]["value"] : ''));
      echo form_textarea($input["data"]);
      if (array_key_exists("valid-feed", $input)) echo '<div class="valid-feedback"> ' . $input["data"]["valid-feed"] . '</div>';
      if (array_key_exists("invalid-feed", $input)) echo '<div class="invalid-feedback"> ' . $input["data"]["invalid-feed"] . '</div>';
      break;
    case 'check':
      if ($d && $dtreg[$input["data"]["name"]]) $input["data"]["checked"] = "true";
      if (array_key_exists("disabled", $input) && $input["disabled"]) $input["data"]["disabled"] = true;
      echo "<div class='checkbox'>" . form_input($input["data"]);
      echo "<label for='" . $input["data"]["id"] . "'> " . $input["label"] . " </label></div>";
      break;
    case 'legend':
      echo "<legend> " . $input["label"] . " </legend>";
      break;
    case 'button':
      $dis = (array_key_exists("disabled", $input) && $input["disabled"] ? "disabled" : "");
      $lab = $input["label"];
      $ic = $input["icon"];
      $attrs = '';
      foreach ($input["data"] as $k => $v)
        $attrs .= " $k = '$v'";
      echo "<a $attrs $dis> $lab <span class='btn-label'><i class='$ic'></i></span> </a>";
      break;
    case 'text':
      echo $input["text"];
      break;
  }
}
$w = 0;
$b = isset($dtreg);
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-12">
      <!-- Encabezado -->
      <div class="card">
        <form class="needs-validation" id="fliq" novalidate method="post">
          <div class="card-body">
            <div class="form-row">
              <?php foreach ($inp1 as $input) : ?>
                <?php if (($w + $input["wdth"]) > 12) : //Si se sobrepasan los 12 md o si es el inicio 
                ?>
            </div>
            <div class="form-row">
            <?php endif;
                $w = (($w + $input["wdth"]) > 12 ? $input["wdth"] : $w + $input["wdth"]); ?>
            <div class="<?= $input["class"] ?>">
              <?php printForm($input, $b, ($b ? $dtreg : null)); ?>
            </div>
          <?php endforeach ?>
            </div>
          </div>
          <div class="card-footer">
            <div class="text-center">
              <button class="btn btn-success" type="submit" style="display: <?= ($b2 ? "none" : "true") ?>;">Guardar</button>
              <a onclick="window.history.back()" class="btn btn-danger" style="color: white;">Volver</a>
            </div>
          </div>
        </form>
      </div>
      <!-- Lista Items -->
      <div class="card">
        <div class="card-body">
          <div class="form-row">
            <?php foreach ($inp2 as $input) : ?>
              <?php if (($w + $input["wdth"]) > 12) : //Si se sobrepasan los 12 md o si es el inicio 
              ?>
          </div>
          <div class="form-row">
          <?php endif;
              $w = (($w + $input["wdth"]) > 12 ? $input["wdth"] : $w + $input["wdth"]); ?>
          <div class="<?= $input["class"] ?>">
            <?php printForm($input, $b, ($b ? $dtreg : null)); ?>
          </div>
        <?php endforeach ?>
          </div>
        </div>
      </div>
      <!-- Lista Pagos -->
      <div class="card">
        <div class="card-body">
          <div class="form-row">
            <?php foreach ($inp3 as $input) : ?>
              <?php if (($w + $input["wdth"]) > 12) : //Si se sobrepasan los 12 md o si es el inicio 
              ?>
          </div>
          <div class="form-row">
          <?php endif;
              $w = (($w + $input["wdth"]) > 12 ? $input["wdth"] : $w + $input["wdth"]); ?>
          <div class="<?= $input["class"] ?>">
            <?php printForm($input, $b, ($b ? $dtreg : null)); ?>
          </div>
        <?php endforeach ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modals -->
  <div id="mitems" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="milabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center" novalidate>
          <h3 class="modal-title" id="milabel">Item</h3>
          <button type="button" class="close ml-auto" data-dismiss="modal">x</button>
        </div>
        <div class="modal-body">
          <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
              <a href="#tab1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                <span class="d-none d-lg-block">Datos</span>
              </a>
            </li>
            <li class="nav-item" id="nigimg">
              <a href="#tab2" data-toggle="tab" aria-expanded="true" class="nav-link">
                <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                <span class="d-none d-lg-block">Imágenes</span>
              </a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane show active" id="tab1">
              <form id="fitems" class="needs-validation form-horizontal">
                <div class="form-row">
                  <?php foreach ($inpit as $input) : ?>
                    <?php if (($w + $input["wdth"]) > 12) : //Si se sobrepasan los 12 md o si es el inicio 
                    ?>
                </div>
                <div class="form-row">
                <?php endif;
                    $w = (($w + $input["wdth"]) > 12 ? $input["wdth"] : $w + $input["wdth"]); ?>
                <div class="<?= $input["class"] ?>">
                  <?php printForm($input, false, null); ?>
                  <div class="valid-feedback"> Correcto.</div>
                  <div class="invalid-feedback"> Error. </div>
                </div>
              <?php endforeach ?>
              </form>
            </div>
          </div>
          <div class="tab-pane" id="tab2" style="overflow: scroll;">
            <div class="row">
              <div class="col-12">
                <div id="iddrop" disabled class="dropzone"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="display: <?= ($b2 ? "none" : "true") ?>;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="fitems" id="sitems" class="btn btn-success">Guardar</button>
        <button type="button" id="btgimg" class="btn btn-warning">Guardar Imágenes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<div id="mpagos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
        <h3 class="modal-title" id="milabel">Item</h3>
        <button type="button" class="close ml-auto" data-dismiss="modal" aria-hidden="true">x</button>
      </div>
      <form id="fpagos" class="needs-validation modal-content form-horizontal">
        <div class="modal-body">
          <div class="form-row">
            <?php foreach ($inppg as $input) : ?>
              <?php if (($w + $input["wdth"]) > 12) : //Si se sobrepasan los 12 md o si es el inicio 
              ?>
          </div>
          <div class="form-row">
          <?php endif;
              $w = (($w + $input["wdth"]) > 12 ? $input["wdth"] : $w + $input["wdth"]); ?>
          <div class="<?= $input["class"] ?>">
            <?php printForm($input, false, null); ?>
            <div class="valid-feedback"> Correcto.</div>
            <div class="invalid-feedback"> Error. </div>
          </div>
        <?php endforeach ?>
          </div>
        </div>
        <div class="modal-footer" style="display: <?= ($b2 ? "none" : "true") ?>;">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>

<script>
  // DROPZONE
  Dropzone.autoDiscover = false;
  var ref, ref2; //global para eliminar archivo
  var dpz = new Dropzone("div#iddrop", {
    url: cadenaurl + ctrl + "/upload",
    maxFiles: 3,
    maxFilesize: 8,
    dictDefaultMessage: "Subir archivos",
    dictRemoveFile: "Quitar",
    dictCancelUpload: "Cancelar",
    acceptedFiles: ".png,.jpg,.pdf",
    addRemoveLinks: true, //Links para remover archivo añadido
    autoProcessQueue: false, //No subir archivos automáticamente
    clickable: true,
    method: "POST",
    template: function(options) {
      return `
        <div class="dz-preview dz-file-preview">
          <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
          <div class="dz-error-message"><span data-dz-errormessage></span></div>
          <div class="dz-success-mark">${options.doneIcon}</div>
          <div class="dz-error-mark">${options.errorIcon}</div>
          <div class="dz-image">
            <div data-dz-thumbnail-bg></div>
          </div>
          <div class="dz-details">
            <div class="dz-size"><span data-dz-size></span></div>
            <div class="dz-url"><span data-dz-url></span></div>
            <div class="dz-filename"><span data-dz-name></span></div>
          </div>
        </div>
      `;
    },
    init: function() {
      this.on("sending", function(file, xhr, formData) {
        id = $("#mitems").find("#IdItem").val()
        formData.append("id", id);
        file.id = id
      });
    },
    removedfile: function(file) { //DESACTIVADO, se puede usar cuando se puedan colocar botones personalizados
      var name = file.url;
      // console.log(name,file.id);
      if (file.id != null) { //Si no ha sido subido solo quitar de la vista
        ref = file.previewElement;
        ref2 = file.previewElement;
        cfajax("delfile", {
            name: file.url,
            id: file.id
          },
          (res) => {
            return (ref) != null ? ref.parentNode.removeChild(ref2) : void 0; //Eliminar Elemento
          }, "Eliminar?", "Se eliminará permanentemente el archivo")
        return;
      }
      var _ref = file.previewElement;
      return _ref.parentNode.removeChild(file.previewElement);
    },
    success: function(file, response) {
      if (response != 0) {
        // Download link
        var anchorEl = document.createElement('a');
        anchorEl.setAttribute('href', cadenaurl + response);
        anchorEl.setAttribute('download', 'true');
        anchorEl.setAttribute('class', 'dz-remove');
        anchorEl.innerHTML = " Descargar";
        file.previewTemplate.appendChild(anchorEl);
      }
    },
  });
  $("#btgimg").on("click", () => {
    dpz.processQueue();
  });

  // Mostrar toast
  var fd = <?php echo (session()->getFlashdata() ? json_encode(session()->getFlashdata()) : json_encode("")) ?>;
  var b2 = parseInt("<?php echo (isset($b2) ? (int)$b2 : false) ?>") == 1;
  if (fd != "") {
    //Mostrar toast
    if (fd.r) toastr.success(fd.msg, 'Éxito');
    else toastr.error(fd.msg, 'Error');
  }
  // Otras funciones 
  function setopt(id, dt) { //Colocar las opciones a un select
    sel = $(document).find("#" + id)
    sel.empty();
    for (k in dt) {
      // console.log(k, dt[k])
      opt = document.createElement('option')
      opt.innerHTML = dt[k]
      opt.value = k
      if (dt[k] == "") opt.selected = "selected"
      sel[0].appendChild(opt)
    }
  }

  //Submit form 
  //  Validacion
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
  //   Items
  $("#fitems").on('submit', function(e) {
    if (this.checkValidity && !this.checkValidity()) return;
    e.preventDefault();
    f = $(document).find("#fitems")
    if (!f.valid()) return; //Si no es valida no hacer nada
    dser = f.serializeArray();
    sd = {}
    dser.forEach(v => {
      sd[v.name] = v.value
    });
    sajax("ajaxieditar", sd, false, true) //recargar para mostrar datos totales
  });
  $("#btitems").on("click", () => { //Nuevo item
    f = $("#fitems") //reset form
    f[0].reset()
    $("#CostItem").val(0)
    $("#CostdItem").val(0)
    $("#btgimg").toggle(false); //Ocultar boton de guardar imagenes
    $("#nigimg").toggle(false); //Ocultar tab con dropzone
    $("#mitems").modal()
  })

  function edititem(id) {
    f = $("#fitems") //Reload form with data
    fajax("ajaxiver", {
      id: id
    }, (dt) => {
      d = dt.data
      setopt("IdPres", dt.pdt) //Actualizar las opciones del select
      // console.log(dt.lf); //Lista Files
      for (i in d) { //Por cada dato
        // console.log("El", i, d[i]);
        f.find("#" + i).val(d[i])
      }
      dpz.url = cadenaurl + ctrl + "/upload/" + id

      //Mostrar archivos cargados
      console.log(dpz.files, dpz.options.maxFiles);
      dpz.files = []; //Limpiar lista de archivos
      // rs = dpz.removeAllFiles(false)
      // document.getElementById("iddrop").innerHTML = "" //Limpiar
      $(".dz-preview").remove();
      dt.lf.forEach((file, k) => {
        var mockFile = {
          name: file.NameItemf,
          size: 0,
          url: file.UrlItemf,
          id: file.IdItemf,
          accepted: true,
        };
        console.log(mockFile);
        dpz.emit("addedfile", mockFile);
        // console.log("MF",mockFile,"URL",cadenaurl+file.UrlItemf);
        // dpz.createThumbnailFromUrl(mockFile,file.UrlItemf);
        dpz.emit("thumbnail", mockFile, cadenaurl + file.UrlItemf);
        dpz.emit("success", mockFile, file.UrlItemf);
        dpz.emit("complete", mockFile);
        dpz.files.push(mockFile);
        // dpz.options.thumbnail.call(dpz, mockFile, cadenaurl+file.UrlItemf);
        // dpz.options.addedfile.call(dpz, mockFile);
      });

      $("#btgimg").toggle(true); //Mostrar boton de guardar imagenes
      $("#nigimg").toggle(true); //Mostrar tab con dropzone
      $("#mitems").modal()
    })
  }

  function delitem(id) { //Eliminar item
    cajax("ajaxieli", {
      id: id
    }, "¿Eliminar?", "Esta Acción será permanente", false) //No Recargar la página
  }

  //   Pagos
  $("#fpagos").on('submit', function(e) {
    if (this.checkValidity && !this.checkValidity()) return;
    e.preventDefault();
    f = $(document).find("#fpagos")
    dser = f.serializeArray();
    sd = {}
    dser.forEach(v => {
      sd[v.name] = v.value
    });
    sajax("ajaxpeditar", sd, false, true) //Recargar datos
  });
  $("#btpagos").on("click", () => {
    f = $("#fpagos") //reset form
    f[0].reset()
    $("#mpagos").modal()
  })

  function editpago(id) {
    f = $("#fpagos") //Reload form with data
    fajax("ajaxpver", {
      id: id
    }, (dt) => {
      d = dt.data
      // console.log("Edit Pago", d)
      for (i in d) { //Por cada dato
        // console.log("Ep", i, d[i]);
        f.find("#" + i).val(d[i])
      }
      $("#mpagos").modal()
    })
  }

  function delpago(id) { //Eliminar Pago
    cajax("ajaxpeli", {
      id: id
    }, "¿Eliminar Pago?", "La acción será permanente", false) //Recargar la página
  }

  var id = "<?= (isset($id)?$id:"") ?>";
  $(document).ready(function() {
    // DATATABLES
    titems = $("#titems").DataTable({
      ajax: {
        url: cadenaurl + '/' + ctrl + "/ajaxitems",
        type: "POST",
        data: {
          id: id
        }
      },
      order: [
        [2, 'asc']
      ],
      columns: [{
          data: 'FechItem',
          title: "Fecha"
        }, //Fecha
        {
          data: 'NomPres',
          title: "Presupuesto"
        }, //Nombre del Presupuesto
        {
          data: 'DescItem',
          title: "Descripción"
        }, //Descripción
        {
          data: 'CostItem',
          title: "Valor S/."
        }, //Costo soles
        {
          data: 'CostdItem',
          title: "Valor $"
        }, //Costo dolares
        {
          data: null,
          defaultContent: "",
          title: "Acciones"
        }, //Acciones
      ],
      columnDefs: [{ //Acciones
        render: function(data, type, row) {
          // console.log("ROW>",data,type,row);
          return '<a onclick="edititem(' + row.IdItem + ')" title="Editar Item" class="btn btn-icon btn-success waves-effect btn-circle waves-light"><i class="ti-pencil-alt" style="color: white;"></i></a>' +
            (b2?'':'<a onclick="delitem(' + row.IdItem + ')" title="Eliminar Item" class="btn btn-icon btn-danger waves-effect btn-circle waves-light"><i class="ti-close" style="color: white;"></i></a>');
        },
        targets: 5 //Column Acciones
      }, ],
      // Atributos comprimidos
      "scrollX": true,
      "autoWidth": true,
      "scrollCollapse": true,
      "pagingType": "full_numbers",
      "lengthMenu": [
        [15, 25, 50, -1],
        [15, 25, 50, "All"]
      ],
      language: {
        paginate: {
          previous: "<",
          next: ">"
        }
      },
      "paging": true,
      "processing": true,
      "searching": true,
      "lengthChange": true,
      "ordering": false,
      "info": false,
      "bProcessing": true,
      "pageLength": 15,
      "oLanguage": {
        "sUrl": cadenaurl + "resources/spanish.json"
      },
      pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
      "fnInitComplete": function() {
        const ps = new PerfectScrollbar('.dataTables_scrollBody');
        $(".selectAll").on("click", function(e) {
          if ($(this).is(":checked")) {
            tabasis.rows().select();
          } else {
            tabasis.rows().deselect();
          }
        })
      },
      "fnDrawCallback": function(oSettings) {
        const ps = new PerfectScrollbar('.dataTables_scrollBody');
      },
    })
    tpagos = $("#tpagos").DataTable({
      ajax: {
        url: cadenaurl + '/' + ctrl + "/ajaxpagos",
        type: "POST",
        data: {
          id: id
        }
      },
      order: [
        [2, 'asc']
      ],
      columns: [{
          data: 'FechPago',
          title: "Fecha"
        }, //Fecha
        {
          data: 'NoperPago',
          title: "N Operación"
        }, //Total
        {
          data: 'DescPago',
          title: "Descripción"
        }, //Saldo
        {
          data: 'ImpPago',
          title: "Valor S/."
        }, //
        {
          data: 'ImpdPago',
          title: "Valor $"
        }, //
        {
          data: null,
          defaultContent: "",
          title: "ACCIONES"
        }, //Acciones
      ],
      columnDefs: [
        { //Estado
          render: function(data, type, row) {
            l = {
              "0": "Ingreso",
              "1": "Salida Completa",
              "2": "Salida Sin Entrada",
              "3": "Entrada sin Salida"
            }
            return l[row.EstAsis];
          },
          targets: "ce" //Column Estado
        },
        { //Acciones
          render: function(data, type, row) {
            // console.log("ROW>",data,type,row);
            return '<a onclick="editpago(' + row.IdPago + ')" title="Editar Pago" class="btn btn-icon btn-success waves-effect btn-circle waves-light"><i class="ti-pencil-alt" style="color: white;"></i></a>' +
              (b2?'':'<a onclick="delpago(' + row.IdPago + ')" title="Eliminar Pago" class="btn btn-icon btn-danger waves-effect btn-circle waves-light"><i class="ti-close" style="color: white;"></i></a>');
          },
          targets: 5 //Column Acciones
        },
      ],
      // Atributos comprimidos
      "scrollX": true,
      "autoWidth": true,
      "scrollCollapse": true,
      "pagingType": "full_numbers",
      "lengthMenu": [
        [15, 25, 50, -1],
        [15, 25, 50, "All"]
      ],
      language: {
        paginate: {
          previous: "<",
          next: ">"
        }
      },
      "paging": true,
      "processing": true,
      "searching": true,
      "lengthChange": true,
      "ordering": false,
      "info": false,
      "bProcessing": true,
      "pageLength": 15,
      "oLanguage": {
        "sUrl": cadenaurl + "resources/spanish.json"
      },
      pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
      "fnInitComplete": function() {
        const ps = new PerfectScrollbar('.dataTables_scrollBody');
        $(".selectAll").on("click", function(e) {
          if ($(this).is(":checked")) {
            tabasis.rows().select();
          } else {
            tabasis.rows().deselect();
          }
        })
      },
      "fnDrawCallback": function(oSettings) {
        const ps = new PerfectScrollbar('.dataTables_scrollBody');
      },
    })
    // Validar form liquidacion
    $("#fliq").validate({
      rules: {},
      messages: {},
      submitHandler: function() {
        dser = $("#fliq").serializeArray();
        sd = {}
        dser.forEach(v => {
          sd[v.name] = v.value
        });
        // console.log(sd)
        sajax("ajaxeditar", sd, true)
      }
    });

    // Seleccionar grupo presupuesto y colocar opciones
    $(document).find("#IdGpres").on("change", () => {
      v = $(document).find("#IdGpres").val() //Id grupo
      fajax("ajaxpresup", {
          id: v
        },
        (no) => {
          setopt("IdPres", no.data)
        }
      );
    })
  })
</script>

<?= $this->endSection() ?>