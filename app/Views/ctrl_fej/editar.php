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
use App\Libraries\PrintForm;
$w = 0;
$b = isset($dtreg);


?>


<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-12">
      <!-- Encabezado -->
      <div class="card">
        <form class="needs-validation" id="fedit" novalidate method="post">
          <div class="card-body"> 
            <?php PrintForm::printFormCard($inp1,$dtreg)
            ?>
          </div>
          <div class="card-footer">
            <div class="text-center">
              <a class="btn btn-success ajaxctrl-save" style=" color: white; display: <?= ($b2 ? "none" : "true")  ?>;">Actualizar</a>
              <a onclick="window.history.back()" class="btn btn-danger" style="color: white;">Volver</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
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