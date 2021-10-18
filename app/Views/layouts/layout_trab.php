<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, material admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, material design, material dashboard bootstrap 4 dashboard template">
    <meta name="description" content="MaterialPro is powerful and clean admin dashboard template, inpired from Google's Material Design">
    <meta name="robots" content="noindex,nofollow">
    <title><?= $title?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url("theme/src/assets/images/favicon.png") ?>">
    <link href="<?= base_url('theme/dist/css/style.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('theme/src/assets/libs/sweetalert2/dist/sweetalert2.min.css')?>" rel="stylesheet">
    <!-- CSS -->
    <?php foreach ($css as $v) : ?>
        <link href="<?= $v ?>" rel="stylesheet"></script>
    <?php endforeach ?>
    <?= $this->renderSection('header') ?>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-lg navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="home">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src=<?=base_url("theme/src/assets/images/logo-icon.png")?> alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src=<?=base_url("theme/src/assets/images/logo-light-icon.png")?> alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src=<?=base_url("theme/src/assets/images/logo-text.png")?> alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src=<?=base_url("theme/src/assets/images/logo-light-text.png")?> class="light-logo" alt="homepage" />
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto"></ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav">
                        <?php $s = session(); ?>
                        <div>
                            <h3 style="color: white;"><?= $s->get('NomTUsuario') ?></h3>
                        </div>
                    </ul>
                    <ul class="navbar-nav">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="border-bottom rounded-top py-3 px-4">
                                            <h5 class="mb-0 font-weight-medium">Notifications</h5>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center notifications position-relative" style="height:250px;">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-danger rounded-circle btn-circle"><i class="fa fa-link"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Luanch Admin</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my new admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:30 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-success rounded-circle btn-circle"><i class="ti-calendar"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Event today</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just a reminder that you have event</span> <span class="font-12 text-nowrap d-block text-muted">9:10 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-info rounded-circle btn-circle"><i class="ti-settings"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Settings</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">You can customize this template as you want</span> <span class="font-12 text-nowrap d-block text-muted">9:08 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-primary rounded-circle btn-circle"><i class="ti-user"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Pavan kumar</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link border-top text-center text-dark pt-3" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src=<?=base_url("theme/src/assets/images/users/1.jpg")?> alt="user" width="30" class="profile-pic rounded-circle" />
                            </a>
                            <div class="dropdown-menu mailbox dropdown-menu-right scale-up">
                                <ul class="dropdown-user list-style-none">
                                    <li>
                                        <div class="dw-user-box p-3 d-flex">
                                            <div class="u-img"><img src=<?=base_url("theme/src/assets/images/users/1.jpg")?> alt="user" class="rounded" width="80"></div>
                                            <div class="u-text ml-2">
                                                <h4 class="mb-0"><?= $s->get('NomUsuario') ?></h4>
                                                <p class="text-muted mb-1 font-14"><?= $s->get('CorrUsuario') ?></p>
                                                <a href="<?=base_url("usuarios")?>" class="btn btn-rounded btn-danger btn-sm text-white d-inline-block">Ver Perfil</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="user-list"><a class="px-3 py-2" href="<?=base_url("login/logout")?>"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <?php
                            $model = model('UsuariosModel');
                            $menus = $model->getMenus()->getResultArray();
                            // echo print_r($menus);
                            // echo "<div style='color: white;'>".uri_string()."</div> ";
                            foreach ($menus as $v) {
                                $ma = $v['PadMenu'];
                                if($ma == 0){ //Raiz, buscar hijos
                                    $ma = $v['IdMenu'];
                                    $b = false;
                                    $s = "";
                                    foreach ($menus as $v2){ //Terminar todo lo que es la barra de navegación
                                        if($v2['PadMenu'] == $ma){
                                            if($v2['UrlMenu'] == uri_string()) $b = true;
                                            $s .= '
                                                <li class="sidebar-item '.($v2['UrlMenu'] == uri_string()?"active":"").'">
                                                    <a href="'.base_url($v2["UrlMenu"]).'" class="sidebar-link">
                                                        <i class="mdi mdi-adjust">'.$v2["SubMenu"].'</i>
                                                        <span class="hide-menu"> '.$v2["NomMenu"].' </span>
                                                    </a>
                                                </li>
                                            ';
                                        }
                                    }
                                    echo '
                                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu"></span></li>
                                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark '.($b?"active":"").'" href="javascript:void(0)" aria-expanded="false">
                                            <i class="mdi '.$v["IconMenu"].'"></i><span class="hide-menu">'.$v["NomMenu"].'</span></a>
                                            <ul aria-expanded="false" class="collapse  first-level">
                                    ';
                                    echo $s;
                                    echo '
                                        </ul>
                                    </li>
                                    ';
                                }
                            }
                        ?>
                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu"></span></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <div class="page-wrapper" style="max-width: 95%;" id="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-12 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0"><?= $title?></h3>
                </div>
            </div>
            <div class="container-fluid" id="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
            <footer class="footer">
                © 2021 SDISE - BACKUS
            </footer>
        </div>
    </div>
    <aside class="customizer">
        <a href="javascript:void(0)" class="service-panel-toggle"><i class="fa fa-cog"></i></a>
        <div class="customizer-body">
            <ul class="nav customizer-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true"><i class="mdi mdi-wrench font-20"></i></a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Tab 1 -->
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="p-3 border-bottom">
                        <!-- Sidebar -->
                        <h5 class="font-medium mb-2 mt-2">Layout Settings</h5>
                        <div class="checkbox checkbox-info mt-3">
                            <input type="checkbox" name="theme-view" class="material-inputs" id="theme-view">
                            <label for="theme-view"> <span>Dark Theme</span> </label>
                        </div>
                        <div class="checkbox checkbox-info mt-2">
                            <input type="checkbox" name="sidebar-position" class="material-inputs" id="sidebar-position">
                            <label for="sidebar-position"> <span>Fixed Sidebar</span> </label>
                        </div>
                        <div class="checkbox checkbox-info mt-2">
                            <input type="checkbox" name="header-position" class="material-inputs" id="header-position">
                            <label for="header-position"> <span>Fixed Header</span> </label>
                        </div>
                        <div class="checkbox checkbox-info mt-2">
                            <input type="checkbox" name="boxed-layout" class="material-inputs" id="boxed-layout">
                            <label for="boxed-layout"> <span>Boxed Layout</span> </label>
                        </div> 
                    </div>
                    <div class="p-3 border-bottom">
                        <!-- Logo BG -->
                        <h5 class="font-medium mb-2 mt-2">Logo Backgrounds</h5>
                        <ul class="theme-color m-0 p-0">
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-logobg="skin1"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-logobg="skin2"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-logobg="skin3"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-logobg="skin4"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-logobg="skin5"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-logobg="skin6"></a></li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                    <div class="p-3 border-bottom">
                        <!-- Navbar BG -->
                        <h5 class="font-medium mb-2 mt-2">Navbar Backgrounds</h5>
                        <ul class="theme-color m-0 p-0">
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-navbarbg="skin1"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-navbarbg="skin2"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-navbarbg="skin3"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-navbarbg="skin4"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-navbarbg="skin5"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-navbarbg="skin6"></a></li>
                        </ul>
                        <!-- Navbar BG -->
                    </div>
                    <div class="p-3 border-bottom">
                        <!-- Logo BG -->
                        <h5 class="font-medium mb-2 mt-2">Sidebar Backgrounds</h5>
                        <ul class="theme-color m-0 p-0">
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-sidebarbg="skin1"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-sidebarbg="skin2"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-sidebarbg="skin3"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-sidebarbg="skin4"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-sidebarbg="skin5"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-sidebarbg="skin6"></a></li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                </div>
                <!-- End Tab 1 -->
            </div>
        </div>
    </aside>

    <!-- JS -->
    <?php foreach ($js as $v) : ?>
        <script src="<?= $v ?>"></script>
    <?php endforeach ?>

    <script type="text/javascript">
        var ctrl = "<?= (isset($this->data["ctrl"]) ? $this->data["ctrl"] : "") ?>";
        pathArray = location.href.split('/');
        cadenaurl = pathArray[0] + "//" + pathArray[2] + "/";
        $(document).ready(function() {
            $(".nav-toggler").on('click', function () {
                $("#main-wrapper").toggleClass("show-sidebar");
                $(".nav-toggler i").toggleClass("ti-menu");
            });
        })
    </script>
    <?= $this->renderSection('js') ?>

</body>

<script type="text/javascript">
    var ctrl = "<?= (isset($this->data["ctrl"]) ? $this->data["ctrl"] : "") ?>";
    var fd = <?php echo (session()->getFlashdata() ? json_encode(session()->getFlashdata()) : json_encode("")) ?>;
</script>

</html>