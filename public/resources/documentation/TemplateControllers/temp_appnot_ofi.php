<!--
  =========================================================
  * Paper Dashboard PRO - V1.3.1
  =========================================================
  * Product Page: https://www.creative-tim.com/product/paper-dashboard-pro
  * Available with purchase of license from https://www.creative-tim.com/product/paper-dashboard-pro
  * Copyright 2017 Creative Tim https://www.creative-tim.com
  * License Creative Tim https://www.creative-tim.com/license
  =========================================================
-->

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>public/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>public/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title><?php echo $this->layout->title; ?></title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />
  <?php echo $this->layout->css; ?>
</head>

<body class="sidebar-mini">
  <div class="wrapper">
    <div class="sidebar" data-background-color="brown" data-active-color="danger">
      <!--
      Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
      Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          GP
        </a>
        <a href="#" class="simple-text logo-normal">RICO POLLO</a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="info">
            <div class="photo">
              <img src="<?= base_url() ?>public/assets/img/faces/worker.png" />
            </div>
            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
              <span>
                <?= $this->session->userdata("ususuario") ?>
                <b class="caret"></b>
              </span>
            </a>
            <div class="clearfix"></div>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class=''>
                  <a href="<?= base_url() . 'appperf_' . $this->session->userdata("nmsufijo") ?>">
                    <span class="sidebar-mini">I</span>
                    <span class="sidebar-normal">INFORMACION</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <?php
          $menu1 = $this->session->userdata("menus");
          foreach ($menu1 as &$value) {
            if ($value['nivel'] == 1) {
          ?>
              <li <?= ($value['codigo'] == $idmenu) ? "class='active'" : "" ?>>
                <a data-toggle="collapse" href="#<?= $value['nombre'] ?>" aria-expanded="true">
                  <i class="<?= $value['icono'] ?>"></i>
                  <p><?= $value['nombre'] ?>
                    <b class="caret"></b>
                  </p>
                </a>
                <div class="collapse <?= ($value['codigo'] == $idmenu) ? "in" : "" ?>" id="<?= $value['nombre'] ?>">
                  <ul class="nav">
                    <?php
                    foreach ($menu1 as $value2) {
                      if ($value2['padre'] == $value['codigo']) {
                    ?>
                        <li <?= ($value2['codigo'] == $idsubmenu) ? "class='active'" : "" ?>>
                          <a href="<?= base_url() . $value2['url'] ?>">
                            <span class="sidebar-mini"><?= $value2['abrev'] ?></span>
                            <span class="sidebar-normal"><?= $value2['nombre'] ?></span>
                          </a>
                        </li>
                    <?php
                      }
                    }
                    ?>
                  </ul>
                </div>
              </li>
          <?php
            }
          }
          ?>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
          </div>
          <div class="navbar-header">
            <button type="button" class="navbar-toggle">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar bar1"></span>
              <span class="icon-bar bar2"></span>
              <span class="icon-bar bar3"></span>
            </button>
            <a class="navbar-brand" href="#Dashboard">
              <?= $this->session->userdata("nmperfil"); ?>
            </a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#notifications" class="dropdown-toggle btn-rotate" data-toggle="dropdown">
                  <i class="ti-bell <?= $nnotifs > 0 ? "icon-danger" : "" ?>" id="notbell"></i>
                  <span class="notification <?= $nnotifs > 0 ? "text-danger" : "" ?>" id="notnum"><?= $nnotifs ?></span>
                  <p class="hidden-md hidden-lg <?= $nnotifs > 0 ? "text-danger" : "" ?>" id="nottex">
                    Notificaciones
                    <b class="caret"></b>
                  </p>
                </a>
                <ul class="dropdown-menu">
                  <li id="notmenu">
                    <?php
                    foreach ($notifs as $row) {
                      print_r('<a href="' . base_url() . 'appover_ofi/notificaciones"> <span class="ti-new-window icon-info"></span> ' . (strlen($row["cTtlNoti"]) > 20 ? substr($row["cTtlNoti"], 0, 20) . "..." : $row["cTtlNoti"]) . '</a>');
                    }
                    ?>
                  </li>
                  <li><a href="<?= base_url() ?>appover_ofi/notificaciones">Ver Notificaciones &nbsp;<span class="ti-angle-double-right icon-info"></span></a></li>
                </ul>
              </li>
              <li>
                <a href="<?= base_url() ?>login/cerrar_sesion" class="dropdown-toggle btn-magnify">
                  <i class="ti-shift-right"></i>
                  <p>Salir</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="content">
        <?php echo $content_for_layout; ?>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="pull-left">
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Tiempo de Carga -> {elapsed_time} mseg
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright pull-right">
            &copy; <script>
              document.write(new Date().getFullYear())
            </script>, hecho by <a href="#">SDISE S.A.C.</a>
          </div>
        </div>
      </footer>
    </div>
  </div>
</body>

<?php echo $this->layout->js; ?>
<script type="text/javascript">
  var ctrl = "<?= (isset($this->data["ctrl"])?$this->data["ctrl"]:"") ?>";
</script>
</html>