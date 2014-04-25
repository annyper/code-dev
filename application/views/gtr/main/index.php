<div class="container">
	<div class="row">
		<div class="col-md-7 col-sm-7" style="padding-right: 1px;padding-left: 2px;">
			<div class="row">
				
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="input-group col-md-12" style="margin-bottom:1%;">
							<div class="input-group-btn">
								<a href="<?php echo site_url('gtr/tiendasEspera'); ?>" id="uriPais" class="btn btn-default">País</a>
							</div>
							<input id="busquedaCDE" type="text" class="search-query form-control" placeholder="Buscar Centros de Experiencia">
							<input type="hidden" id="hiddenURI" value="<?php echo site_url('gtr/tiendaBusqueda'); ?>">
							<span class="input-group-btn">
								<button class="btn btn-success" disabled="disabled" type="button">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
				
						<div class="row">
							<div class="btn-group btn-group-justified col-md-12" data-toggle="buttons" id="busquedaCDEregional">
							  <label class="btn btn-default">
							    <input type="radio" name="options" value="Centro" id="EsperaOption1"> Centro
							  </label>
							  <label class="btn btn-default">
							    <input type="radio" name="options" value="Costa" id="EsperaOption2"> Costa
							  </label>
							  <label class="btn btn-default">
							    <input type="radio" name="options" value="Noroccidente" id="EsperaOption3"> Noroccidente
							  </label>
							  <label class="btn btn-default">
							    <input type="radio" name="options" value="Oriente" id="EsperaOption4"> Oriente
							  </label>
							  <label class="btn btn-default">
							    <input type="radio" name="options" value="Suroccidente" id="EsperaOption5"> Suroccidente
							  </label>
							</div>
						</div>

						<div id="listaCDEs" style="overflow:auto; overflow-x:hidden; max-height:650px;"></div>
						<?php //$this->load->view('gtr/main/tiendasEspera.php') ?>

					</div>
				</div>
			</div>
			

		</div>

		<div class="col-md-5 col-sm-5" style="padding-right: 1px;padding-left: 2px;">
			<div class="row desaparecer" id="panelInfoCDE">

				<div class="col-md-12">
					<div class="panel panel-tigo-verde panel-extra">
						<div class="panel-heading">
							<h3 class="panel-title" id="mainEstadoRacs-titulo">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			         				 Estado de los asesores <span class="fontSize1_5 nombreTienda"></span>
			        			</a>
			        			<a href="<?php echo site_url('gtr/renderRacsTiempoReal'); ?>"></a>
		        			</h3>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in">
							<div class="panel-body" id="">

								<div id="estadoAsesoresChart" style="min-width: 45%; height: 110px; margin: 0 auto">
								</div>

								<div id="mainEstadoRacs"></div>
								
							</div>
						</div>

					</div>
				</div>
				
				<div class="col-md-12">
					<div class="panel panel-tigo-verde panel-extra">
						<div class="panel-heading">
							<h3 class="panel-title" id="mainClientesEspera-titulo">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseClientes">
			         				 Clientes en espera <span class="fontSize0 nombreTienda"></span>
			        			</a>
			        			<a href="<?php echo site_url('gtr/renderClientesEsperaTiempoReal/Tigo-Centro-Medellin'); ?>"></a>
			        			<a href="<?php echo site_url('gtr/chartCientesEspera/Tigo-Centro-Medellin'); ?>"></a>
		        			</h3>
						</div>
						<div id="collapseClientes" class="panel-collapse collapse in">
							<div class="panel-body" id="">
								<div id="loquesea"></div>
								<div id="mainClientesEspera"></div>
				
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>
</div>