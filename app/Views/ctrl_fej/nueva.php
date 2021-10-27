<?= $this->extend('layouts/layout_trab') ?>

<?= $this->section('css') ?>

<style>
  .dz-image-preview {
    background-color: black;
  }
</style>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-12">
      <!-- Encabezado -->
      <div class="card">
        <form class="needs-validation" id="fliq" novalidate method="post">
          <div class="card-body">
           <h5 class="card-title">Editar datos:</h5>
            <p class="card-text">
            <!--<form method="post" action="<?=site_url('/ajaxupdate')?>" enctype="multipart/form-data"> -->
              <div class="form-group">
                <label for="my-input">Fecha de creación</label>
                <input id="FcreFej" placeholder="FcreFej" class="form-control FcreFej" type="date" name="FcreFej">
              </div>
              <div class="form-group">
                <label for="my-input">Fecha de modificación</label>
                <input id="FmodiFej" class="form-control FmodiFej" type="date" name="FmodiFej">
              </div>
              <div class="form-group">
                <label for="my-input">Usuario</label>
                <input id="IdUsu" class="form-control IdUsu" type="text" name="IdUsu">
              </div>
            <!--</form>-->
          </div>
          <div class="card-footer">
            <div class="text-center">
              <button class="btn btn-success ajaxctrl-save" type="submit" >Crear</button>
              <a onclick="window.history.back()" class="btn btn-danger" style="color: white;">Volver</a>
            </div>
          </div>
        </form>
      </div>


<?= $this->endSection() ?>



<?= $this->section('js') ?>

<script>
$(document).ready(function() {
  $(document).on('click', '.ajaxctrl-save', function() { 
    var data = {
      'FcreFej': $('.FcreFej').val(),
      'FmodiFej': $('.FmodiFej').val(),
      'IdUsu': $('.IdUsu').val(),
    };
    sajax("ajaxguardar",data)
  });
});
    

  
</script>

<?= $this->endSection() ?>