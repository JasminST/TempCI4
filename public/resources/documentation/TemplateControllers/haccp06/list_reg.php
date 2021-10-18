<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-sm-12">
      <div class="card">
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="nav-tabs-navigation">
                  <div class="nav-tabs">
                    <ul id="tabs" class="nav nav-tabs text-left" data-tabs="tabs">
                      <li class="<?= ($this->input->get('tab') != 'R') ? 'active' : '' ?>"><a href="#formulario" data-toggle="tab">Listado de registros </a></li>
                      <li class="<?= ($this->input->get('tab') == 'R') ? 'active' : '' ?>"><a href="#formulario1" data-toggle="tab">Reporte por dia </a></li>
                    </ul>
                  </div>
                </div>
                <div id="my-tab-content" class="tab-content text-left">
                  <div class="tab-pane <?= ($this->input->get('tab') != 'R') ? 'active' : '' ?>" id="formulario">
                    <div class="row" style="padding-left: 25px;">
                      <a href="<?= base_url().$ctrl ?>/nuevo" class="btn btn-xs btn-fill" role="button">Nuevo Registro</a>
                    </div>
                    <br><br>
                    <div class="fresh-datatables">
                      <table id="LstRegistros" class="table table-striped table-bordered nowrap" cellspacing="0" style="width:100%; ">
                        <thead>
                          <tr>
                            <th rowspan=2>Acciones</th>
                            <th rowspan=2>ID</th>
                            <th rowspan=2>Fecha</th>
                            <th rowspan=2>Tipo Pollo</th>
                            <th rowspan=2>Peso Inicial (Tambor)</th>
                            <th rowspan=2>Peso Final (Marinado)</th>
                            <th rowspan=2>% De Inyección</th>
                            <th rowspan=2>Presión de máquina</th>
                            <th rowspan=2>Ciclo de Inyección</th>
                            <th rowspan=2>Velocidad Faja</th>
                            <th rowspan=2>Altura del Pisador</th>
                            <th colspan=2>Regulación Inyección</th>
                            <th colspan=1>Temp. Salmuera</th>
                          </tr>
                          <tr>
                            <th>Abajo</th>
                            <th>Arriba</th>
                            <th>Punto Medio</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($list->result_array() as $row) { ?>
                            <tr>
                              <td>
                                <a href="<?= $ctrl ?>/editar/<?= $row[$this->codi] ?>" title="Editar" class="btn btn-simple btn-success btn-icon "><i class="ti-pencil" style="fill: #228B22;"></i></a>
                                <a onClick="delregistro(<?= $row[$this->codi] ?>)" title="Eliminar" class="btn btn-simple btn-danger btn-icon "><i class="ti-close" style="fill: #228B22;"></i></a>
                              </td>
                              <?php
                              // Mostrar todos los datos de cada row
                              foreach ($lcamp as $c) {
                                echo "<td>" . $row[$c] . "</td>";
                              }
                              ?>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane <?= ($this->input->get('tab') == 'R') ? 'active' : '' ?>" id="formulario1">
                    <form action="<?= BASE_URL().$ctrl ?>?tab=R" method="POST">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="pull-left">
                            <label style="padding-top: 5px;">Dia de reporte&nbsp;&nbsp;</label>
                          </div>
                          <div class="pull-left">
                            <input type="text" name="fechaconsulta" id="idfechaconsulta" class="form-control input-xs" id="datetimepicker" style="height: 30px;" size="10" value='<?=(!is_null($dlist)?$dia:date('Y-m-d'))?>'>
                          </div>
                          <div class="pull-left">
                            &nbsp;&nbsp;
                            <button type="submit" class="btn btn-info btn-fill btn-icon btn-sm" id="btnConsulta">BUSCAR</button>
                            <?php
                            if (!is_null($dlist))
                              if ($dlist->num_rows() != 0) {
                            ?>
                              <a href="<?= base_url().$ctrl ?>/pdf/<?= $dia ?>" target="_blank" class="btn btn-danger btn-fill btn-icon btn-sm"> <i class="ti-printer"></i></a>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </form>
                    <br>
                    <?= (!is_null($dlist)) ? "La tabla muestra el resultado del dia : " . $dia : "" ?>
                    <br>
                    <div class="fresh-datatables">
                      <table id="ListaConsulta" class="table table-striped table-bordered nowrap" cellspacing="2" style="width:100%; ">
                        <thead>
                        <tr>
                            <th rowspan=2>ID</th>
                            <th rowspan=2>Fecha</th>
                            <th rowspan=2>Tipo Pollo</th>
                            <th rowspan=2>Peso Inicial (Tambor)</th>
                            <th rowspan=2>Peso Final (Marinado)</th>
                            <th rowspan=2>% De Inyección</th>
                            <th rowspan=2>Presión de máquina</th>
                            <th rowspan=2>Ciclo de Inyección</th>
                            <th rowspan=2>Velocidad Faja</th>
                            <th rowspan=2>Altura del Pisador</th>
                            <th colspan=2>Regulación Inyección</th>
                            <th colspan=1>Temp. Salmuera</th>
                          </tr>
                          <tr>
                            <th>Abajo</th>
                            <th>Arriba</th>
                            <th>Punto Medio</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (!is_null($dlist))
                            foreach ($dlist->result_array() as $row) { ?>
                            <tr>
                              <?php
                              foreach ($lcamp as $c)
                                echo "<td>" . $row[$c] . "</td>";
                              ?>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div> <!-- end col-md-12 -->
            </div> <!-- end row -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>