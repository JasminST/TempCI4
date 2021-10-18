<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $titl; ?></h4>
                </div>
                <div class="card-content">
                    <form method="post" action="" id="formreg">
                        <h4 class="card-title"> <legend>Encabezado</legend> </h4>
                        <div class="row">
                            <div class="col-md-4 col-xs-6">
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input type="text" name="fecha" id="idfecha" class="form-control border-input" value="<?= date('Y-m-d'); ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-6 ">
                                <div class="form-group">
                                    <label>Hora</label>
                                    <input type="time" name="semana" id="idsemana" class="form-control border-input" value="<?= date('H:i'); ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Responsable</label>
                                    <input type="text" name="responsable" class="form-control border-input" value="<?= $this->session->userdata("ususuario") ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- c3 - c6 -->
                        <div class="row">
                            <div class="col-md-3 col-xs-6 ">
                                <div class="form-group">
                                    <label>Peso Inicial (Salida Tambor)</label>
                                    <input type="number" id="c5" name="c4" class="form-control border-input" onchange="updc8()" value="">
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6 ">
                                <div class="form-group">
                                    <label>Peso Final (Salida Marinado)</label>
                                    <input type="number" id="c6" name="c5" class="form-control border-input" onchange="updc8()" value="">
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-6 ">
                                <div class="form-group">
                                    <label>% Injección</label>
                                    <input type="number" id="c7" name="c6" class="form-control border-input icon-success" value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-6">
                                <div class="form-group">
                                    <label>Tipo Pollo</label>
                                    <?php
                                    $options = [
                                        "MEJORADO" => "MEJORADO",
                                        "TROZADO" => "TROZADO",
                                        "BRASA" => "BRASA",
                                        "GALLINA" => "GALLINA",
                                    ];
                                    echo form_dropdown('c3', $options, 'brasa', 'id="cGranKilla" class="form-control"');
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- Legends -->
                        <div class="row">
                            <legend class="col-md-6">Detalle</legend>
                            <legend class="col-md-4">Regulación inyección</legend>
                            <legend class="col-md-2">Temp Salmuera</legend>
                        </div>
                        <div class="row">
                            <!-- c7- c10 -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3 col-xs-6">
                                        <div class="form-group">
                                            <label>Presión Máquina</label>
                                            <input type="number" name="c7" class="form-control border-input" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <div class="form-group">
                                            <label>Ciclo de Inyección</label>
                                            <input type="number" name="c8" class="form-control border-input" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <div class="form-group">
                                            <label>Velocidad Faja</label>
                                            <input type="number" name="c9" class="form-control border-input" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <div class="form-group">
                                            <label>Altura del Pisador</label>
                                            <input type="number" name="c10" class="form-control border-input" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- c11 - c13 -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4 col-xs-6 ">
                                        <div class="form-group">
                                            <label>Abajo</label>
                                            <input type="number" name="c11" class="form-control border-input"  value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-6 ">
                                        <div class="form-group">
                                            <label>Arriba</label>
                                            <input type="number" name="c12" class="form-control border-input"  value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-6 ">
                                        <div class="form-group">
                                            <label>Punto Medio Tanque</label>
                                            <input type="number" name="c13" class="form-control border-input"  value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Observaciones -->
                        <div class="row">
                            <fieldset>
                                <div class="col-md-12">
                                    <legend>Otros</legend>
                                    <div class="form-group">
                                        <label>Observaciones</label>
                                        <textarea name="c14" maxlength="120" class="form-control border-input"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Acciones Correctivas</label>
                                        <textarea name="c15" maxlength="120" class="form-control border-input"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info btn-fill btn-sm">Guardar Cambios</button>
                            <a href="<?= base_url() . $ctrl ?>" class="btn btn-danger btn-fill btn-sm">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>