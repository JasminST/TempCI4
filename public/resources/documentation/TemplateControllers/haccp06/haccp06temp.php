<div class="container-fluid">
	<!-- 
	Documentación:
		Se utiliza una función por cada Gráfico con la notación:
			[codreg][ngraf]
		En esta vista tenemos los siguientes gráficos:
			HACCP08: (CONTROL DE TEMPERATURA DE SALMUERA)
				tlper - TReal Porcentaje de Injección(líneas - Promedio Porcentaje)
				tltsa - TReal Temperatura salm (líneas - Promedio T < 4)
				dltsa - Diario (lineas - Promedio T < 4)
				sltsa - Semanal (lineas - Promedio T < 4)
	-->
	<!-- Título -->
	<div class="row">
		<div class="card card-plain">
			<div class="card-header text-center">
				<h2 class="card-title"><?= $titl ?></h2>
			</div>
		</div>
	</div>

	<!-- tlper - TReal Porcentaje de Injección (Recargable) -->
	<div class="row">
		<div class="col-lg-12 col-sm-12">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-10 card-title">
							<div class="numbers pull-left">
								% Injección Vs Tipo de Pollo (Tiempo Real)
							</div>
						</div>
						<div class="col-xs-2 card-title">
							<div class="pull-left">
								<span class="label label-success">
									5 Secs
								</span>
								<a onclick="loadHaccp06tlper()" class="btn btn-info btn-fill btn-icon btn-sm">
									<i id="icorel" class="fa fa-refresh"></i>
								</a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<div class="chart-legend">
								<h5 class="big-title"> MEJORADO <span class="label label-warning">%</span></h5>
							</div>
							<canvas id="tlper1" class="col"></canvas>
						</div>
						<div class="col-sm-6 col-xs-12">
							<div class="chart-legend">
								<h5 class="big-title"> TROZADO <span class="label label-warning">%</span></h5>
							</div>
							<canvas id="tlper2" class="col"></canvas>
						</div>
						<div class="col-sm-6 col-xs-12">
							<div class="chart-legend">
								<h5 class="big-title"> BRASA <span class="label label-warning">%</span></h5>
							</div>
							<canvas id="tlper3" class="col"></canvas>
						</div>
						<div class="col-sm-6 col-xs-12">
							<div class="chart-legend">
								<h5 class="big-title"> GALLINA <span class="label label-warning">%</span></h5>
							</div>
							<canvas id="tlper4" class="col"></canvas>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<hr>
					<div class="footer-title">Gráfico Recargable</div>
				</div>
			</div>
		</div>
	</div>
	<!-- tltsa - TReal Temperatura salm (Recargable)-->
	<div class="row">
		<div class="col-lg-12 col-sm-12">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-10 col-sm-10">
							<div class="numbers pull-left">
								Temperatura de Salmuera (Tiempo Real)
							</div>
						</div>
						<div class="col-xs-2 col-sm-2">
							<div class="pull-right">
								<span class="label label-warning">
									C°
								</span>
								<span class="label label-success">
									5 Secs
								</span>
								<a onclick="loadHaccp06tlper()" class="btn btn-info btn-fill btn-icon btn-sm">
									<i id="icorel" class="fa fa-refresh"></i>
								</a>
							</div>
						</div>
					</div>
					<div class="row category">
						<div class="col-xs-12">
							Punto Medio Tanque de Injección
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<canvas id="tltsa" class="col" width="100" height="23"></canvas>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<hr>
					<div class="footer-title">Gráfico Recargable</div>
				</div>
			</div>
		</div>
	</div>

	<!-- dltsa - Diario -->
	<div class="row">
		<div class="col-lg-12 col-sm-12">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-10 col-sm-10">
							<div class="numbers pull-left">
								Temperatura de Salmuera (Diario)
							</div>
						</div>
						<div class="col-xs-2 col-sm-2">
							<div class="pull-right">
								<span class="label label-warning">
									C°
								</span>
							</div>
						</div>
					</div>
					<div class="row category">
						<div class="col-xs-12">
							Punto Medio Tanque de Injección
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<canvas id="dltsa" class="col" width="100" height="23"></canvas>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<hr>
					<div class="footer-title">Tendencia diaria</div>
				</div>
			</div>
		</div>
	</div>
	<!-- sltsa - Semanal -->
	<div class="row">
		<div class="col-lg-12 col-sm-12">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-10 col-sm-10">
							<div class="numbers pull-left">
								Temperatura de Salmuera (Semanal)
							</div>
						</div>
						<div class="col-xs-2 col-sm-2">
							<div class="pull-right">
								<span class="label label-warning">
									C°
								</span>
							</div>
						</div>
					</div>
					<div class="row category">
						<div class="col-xs-12">
							Punto Medio Tanque de Injección
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<canvas id="sltsa" class="col" width="100" height="23"></canvas>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<hr>
					<div class="footer-title">Tendencia semanal</div>
				</div>
			</div>
		</div>
	</div>
</div>