<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, material admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, material design, material dashboard bootstrap 4 dashboard template">
    <meta name="description" content="MaterialPro is powerful and clean admin dashboard template, inpired from Google's Material Design">
    <meta name="robots" content="noindex,nofollow">
    <title><?=$title?></title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro/"/>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('theme/src/assets/images/logo-icon.png')?>">
    <!-- Custom CSS -->
    <link href="<?= base_url('theme/dist/css/style.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('theme/src/assets/libs/sweetalert2/dist/sweetalert2.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('theme/src/assets/extra-libs/toastr/dist/build/toastr.min.css')?>" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <!-- Preloader - style you can find in spinners.css -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- Preloader - style you can find in spinners.css -->
        <!-- Login box.scss -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?= base_url('resources/imagenes/background-5.png')?>) no-repeat center center; background-size: cover;">
            <div class="auth-box p-4 bg-white rounded">
                <div id="loginform">
                    <div class="logo text-center">
                        <span class="db"><img src="<?= base_url('theme/src/assets/images/logo-icon.png')?>" alt="logo" /><br/>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
							<h2 class="text-center">Cambiar Contraseña</h2>
                            <form action="<?=base_url('usuarios/submitchcon')?>" method="post" class="form-horizontal mt-3 form-material" id="formreg">
								<input type="hidden" name="IdUsu" value="<?= $id ?>">
                                <div class="form-group mb-3">
                                    <div class="col-xs-12">
										<input class="form-control" name="pas1" type="password" minlength="6" maxlength="16" placeholder="Contraseña" value="" required>
										<div class="valid-feedback">
											Correcto.
										</div>
										<div class="invalid-feedback">
											Campo obligatorio.
										</div>
									</div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="col-xs-12">
                                        <input class="form-control" name="pas2" equalto="pas1" type="password" minlength="6" maxlength="16" placeholder="Repetir Contraseña" value="" required>
										<div class="valid-feedback">
											Correcto.
										</div>
										<div class="invalid-feedback">
											Campo obligatorio y debe ser igual al otro.
										</div>
									</div>
                                </div>
                                <div class="form-group text-center mt-3">
                                    <div class="col-xs-12">
                                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login box.scss -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- Right Sidebar -->
        <!-- Right Sidebar -->
    </div>
    <script src="<?= base_url('theme/src/assets/libs/jquery/dist/jquery.min.js')?>"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url('theme/src/assets/libs/popper.js/dist/umd/popper.min.js')?>"></script>
    <script src="<?= base_url('theme/src/assets/libs/bootstrap/dist/js/bootstrap.min.js')?>"></script>
    <!-- apps -->
    <script src="<?= base_url('theme/dist/js/app.min.js')?>"></script>
    <script src="<?= base_url('theme/dist/js/app.init.horizontal.js')?>"></script>
    <script src="<?= base_url('theme/dist/js/app-style-switcher.horizontal.js')?>"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= base_url('theme/src/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')?>"></script>
    <script src="<?= base_url('theme/src/assets/extra-libs/sparkline/sparkline.js')?>"></script>
    <!--Wave Effects -->
    <script src="<?= base_url('theme/dist/js/waves.js')?>"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url('theme/dist/js/custom.min.js')?>"></script>
    <script src="<?= base_url('theme/src/assets/libs/sweetalert2/dist/sweetalert2.all.min.js')?>"></script>
    <script src="<?= base_url('theme/src/assets/extra-libs/sweetalert2/sweet-alert.init.js')?>"></script>
    <script src="<?= base_url('theme/src/assets/extra-libs/toastr/dist/build/toastr.min.js')?>"></script>
    <!-- <script src="views/Login/index.js"></script> -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
	<script type="text/javascript">
		var ctrl = "<?= (isset($this->data["ctrl"]) ? $this->data["ctrl"] : "") ?>";
		var fd = <?php echo (session()->getFlashdata() ? json_encode(session()->getFlashdata()) : json_encode("")) ?>;
		if(fd != ""){
			//Mostrar toast
			if(fd.r) toastr.success(fd.msg,'Éxito' );
			else toastr.error(fd.msg,'Error');
		}
	</script>
</body>
</html>