s<div class="container containerIP" id="<?php echo $ipCifrada; ?>" style="width: 95%;">
	
	<div class="row">
		<div class="col-md-4 col-md-offset-4" style="margin: 10px;">
			<?php $this->load->view('templates/datalist'); ?>
		</div>
	</div>

	<div class="row" id="NSyPSpanel">
		<div class="col-dmd-12">
			<div class="panel panel-tigo-azul panel-extra">
				<div class="panel-heading">
					<div class="row">
						<div class="panel-title col-md-3" id="NSyPS-titulo">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseNSPS">
								Indicadores de rendimiento
							</a>	
						</div>
						<div class="col-md-6 panel-body-nsps">
							<div class="input-group col-md-10 col-sm-12 col-xs-12" style="margin-bottom:1%;">
							
								<input id="fechasAnalisisNSPS" type="text" class="form-control" placeholder="Seleccione las fechas... ">							

								<span class="input-group-btn">
									<button class="btn btn-default" type="button"  data-url="<?php echo site_url('gtr/getNSyPS'); ?>" data-url2="<?php echo site_url('gtr/getPS'); ?>">
										<span class="glyphicon glyphicon-search"></span>
									</button>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div id="collapseNSPS" class="panel-collapse collapse in">
					<div class="panel-body" id="">
							
							<div id="NSyPS" class="text-center">
								<div id="spinner"><i class="fa fa-bar-chart-o fa-5x text-muted" style="font-size: 9em; "></i></div>
								<div class="graficos col-md-clear col-md-6"></div>
								<div class="graficosPS col-md-clear col-md-6"></div>
							</div>
							
					</div>
				</div>
			</div>
		</div>
	</div>

		<div class="row" id="actividadAsesores">
			<div class="col-md-rty12">
				<div class="panel panel-tigo-verde panel-extra">
					<div class="panel-heading">
						<div class="row">
							<div class="panel-title col-md-3" id="actividadAsesoresAnalytics-titulo">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									 Actividad de los asesores <span></span>
								</a>
								<a href="<?php echo site_url('gtr/chartActividadAsesores'); ?>"></a>	
							</div>
							
							<div class="col-md-3">
								<?php echo form_open('gtr/chartActividadAsesoresForm', array('class' => 'formAjaxClic form-inline')) ?>
									<div class="form-group">
										<div class="input-group">
											<input type="text" name="fechaActividadAsesor" id="datepickerActividadAsesor" placeholder="Ingrese la fecha" required class="form-control">
											<span class="input-group-btn">
												<button class="btn btn-default" id="" type="submit">Generar</button>
											</span>
										</div>
									</div>
								</form>	   
							</div>	        				
							
						</div>

					</div>
					<div id="collapseOne" class="panel-collapse collapse in">

						
						<div class="panel-body" id="">
							
							<div id="actividadAsesoresAnalytics" class="text-center">
								<div class=""><i class="fa fa-bar-chart-o fa-5x text-muted" style="font-size: 9em; "></i></div>

							</div>
							
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="row" id="checkListAperturaPanel">
			<div class="col-mdui-12">
				<div class="panel panel-tigo-azul panel-extra">
					<div class="panel-heading">
						<div class="row">
							<div class="panel-title col-md-2" id="checkListApertura-titulo">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseChecklist">
									 Check list de apertura <span></span>
								</a>
								<a href="<?php echo site_url('gtr/chartActividadAsesores'); ?>"></a>	
							</div>
							
							<div class="col-md-9">
								<?php echo form_open('cocinfo/checkListDeApertura', array('class' => 'formAjaxClicCheck form-inline')) ?>
						
									<div class="form-group">	
										<input type="text" name="fechaInicioCheck1" id="datepickerCheckList1" placeholder="Fecha de  inicio" required class="form-control">
									</div>
									<div class="form-group">
											<input type="text" name="fechaInicioCheck2" id="datepickerCheckList2" placeholder="Fecha fin" required class="form-control">
									</div>

									<div class="checkbox">
										<label>
										  <input type="checkbox" name="checkCosta" value="Costa"> Costa
										</label>
										<label>
										  <input type="checkbox" name="checkCentro" value="Centro"> Centro
										</label>
										<label>
										  <input type="checkbox" name="checkNoroccidente" value="Noroccidente"> Noroccidente
										</label>
										<label>
										  <input type="checkbox" name="checkSuroccidente" value="Suroccidente"> Suroccidente
										</label>
										<label>
										  <input type="checkbox" name="checkOriente" value="Oriente"> Oriente
										</label>
									  </div>
										   
										<button class="btn btn-default" id="" type="submit">Generar</button>
										  
							   
								</form>	   
							</div>	        				
							
						</div>

					</div>
					<div id="collapseChecklist" class="panel-collapse collapse in">

						
						<div class="panel-body" id="">
							
							<div id="checkListApertura" class="text-center">
								<div class=""><i class="fa fa-bar-chart-o fa-5x text-muted" style="font-size: 9em; "></i></div>

							</div>
							
						</div>
					</div>

				</div>
			</div>
		</div>
</div>

<script>

	var indicadores = {

		datosNS: [],
		datosPS: [],
		fechas: [],

		NS: function(){
			var puntero = this;
			$('.panel-body-nsps').on('click', 'button' ,function(){
				puntero.datosNS = [];
				var boton = $(this);
				var fechas = boton.closest('div').find('input').val();

				var fechasArray = fechas.split(";");
				puntero.fechas = fechasArray;

				var ipCifrada = $('.containerIP').attr('id');
				var url = [];
				var url2 = [];

				$('#NSyPS').find('.graficos').html('');
				$('#NSyPS').find('.graficosPS').html('');

				if (fechas == "") {return};

				for (var i = 0; i < fechasArray.length; i++) {
					url.push(boton.data('url') + '/' + fechasArray[i] + '/' + ipCifrada);
					url2.push(boton.data('url2') + '/' + fechasArray[i] + '/' + ipCifrada);

					puntero.getNS(url[i]);
					puntero.getPS(url2[i]);
				};
			});


		},

		getNS: function(url){
			var puntero = this;
			var fechas = this.fechas;

			$('#NSyPS').find('#spinner').html('<i class="text-muted fa fa-spinner fa-spin" style="font-size: 4em"></i>');
			
			$.getJSON(url, function( data ) {
				puntero.datosNS.push(data);

				var j = puntero.datosNS.length - 1;
				for (var i = 0; i < puntero.datosNS[j].length; i++) {

					if (i == 0) {
						puntero.datosNS[j][i]["puntualAcu"] = puntero.datosNS[j][i]["puntual"];
						puntero.datosNS[j][i]["inpuntualAcu"] = puntero.datosNS[j][i]["IMPUNTUAL"];
					}else{
						puntero.datosNS[j][i]["puntualAcu"] =  puntero.datosNS[j][i]["puntual"] +  puntero.datosNS[j][i-1]["puntualAcu"];
						puntero.datosNS[j][i]["inpuntualAcu"] =  puntero.datosNS[j][i]["IMPUNTUAL"] +  puntero.datosNS[j][i-1]["inpuntualAcu"];
					}
					puntero.datosNS[j][i]["NS"] = 100*puntero.datosNS[j][i]["puntual"]/(puntero.datosNS[j][i]["puntual"] + puntero.datosNS[j][i]["IMPUNTUAL"]);
					puntero.datosNS[j][i]["NS_Acu"] = 100*puntero.datosNS[j][i]["puntualAcu"]/(puntero.datosNS[j][i]["puntualAcu"] + puntero.datosNS[j][i]["inpuntualAcu"]);
				};

				if (puntero.datosNS.length == fechas.length) {$('#NSyPS').find('#spinner').html('');}
				
				puntero.highcharts(puntero.datosNS[j], 'graficos', 'Nivel de servicio ');
				
				console.log("done!");
			});
		},

		getPS: function(url){
			var puntero = this;

			$.getJSON(url, function( data ) {
				puntero.datosPS.push(data);
				var j = puntero.datosPS.length - 1;

				for (var i = 0; i < puntero.datosPS[j].length; i++) {
					if (i == 0) {
						puntero.datosPS[j][i]["0-15Acu"] = puntero.datosPS[j][i]["0-15"];
						puntero.datosPS[j][i]["15-30Acu"] = puntero.datosPS[j][i]["15-30"];
						puntero.datosPS[j][i]["30-45Acu"] = puntero.datosPS[j][i]["30-45"];
						puntero.datosPS[j][i]["45-60Acu"] = puntero.datosPS[j][i]["45-60"];
						puntero.datosPS[j][i]["MAS-60Acu"] = puntero.datosPS[j][i]["MAS-60"];
						puntero.datosPS[j][i]["ATENDIDOSAcu"] = puntero.datosPS[j][i]["ATENDIDOS"];
					}else{
						puntero.datosPS[j][i]["0-15Acu"] =  puntero.datosPS[j][i]["0-15"] +  puntero.datosPS[j][i-1]["0-15Acu"];
						puntero.datosPS[j][i]["15-30Acu"] =  puntero.datosPS[j][i]["15-30"] +  puntero.datosPS[j][i-1]["15-30Acu"];
						puntero.datosPS[j][i]["30-45Acu"] =  puntero.datosPS[j][i]["30-45"] +  puntero.datosPS[j][i-1]["30-45Acu"];
						puntero.datosPS[j][i]["45-60Acu"] =  puntero.datosPS[j][i]["45-60"] +  puntero.datosPS[j][i-1]["45-60Acu"];
						puntero.datosPS[j][i]["MAS-60Acu"] =  puntero.datosPS[j][i]["MAS-60"] +  puntero.datosPS[j][i-1]["MAS-60Acu"];
						puntero.datosPS[j][i]["ATENDIDOSAcu"] =  puntero.datosPS[j][i]["ATENDIDOS"] +  puntero.datosPS[j][i-1]["ATENDIDOSAcu"];
					}
					var numeradorAcu = puntero.datosPS[j][i]["ATENDIDOSAcu"] - 0.6*(puntero.datosPS[j][i]["15-30Acu"]) - 1.2*(puntero.datosPS[j][i]["30-45Acu"]) - 2.4*(puntero.datosPS[j][i]["45-60Acu"]) - 4.8*(puntero.datosPS[j][i]["MAS-60Acu"]);
					puntero.datosPS[j][i]["PS_Acu"] = 100*numeradorAcu/puntero.datosPS[j][i]["ATENDIDOSAcu"];

					var numerador = puntero.datosPS[j][i]["ATENDIDOS"] - 0.6*(puntero.datosPS[j][i]["15-30"]) - 1.2*(puntero.datosPS[j][i]["30-45"]) - 2.4*(puntero.datosPS[j][i]["45-60"]) - 4.8*(puntero.datosPS[j][i]["MAS-60"]);
					puntero.datosPS[j][i]["PS"] = 100*numerador/puntero.datosPS[j][i]["ATENDIDOS"];

					//puntero.datosNS[j][i]["PS"] = 100*puntero.datosNS[j][i]["puntual"]/(puntero.datosNS[j][i]["puntual"] + puntero.datosNS[j][i]["IMPUNTUAL"]);
				}
				puntero.highcharts(puntero.datosPS[j], 'graficosPS', 'Percepción de servicio ');


				console.log("done PS!");
			});

		},

		filtToArray: function(lista, key){
			var listaFiltrada = [];
			var recorteNeg;
			for (var i = 0; i < lista.length; i++) {
				recorteNeg = lista[i][key] >= 0 ?  lista[i][key] : null;

				listaFiltrada.push(recorteNeg);
			};
			return listaFiltrada;
		},

		highcharts: function(datos, dom, titulo){
			var puntero = this;
			$('#NSyPS').find('.' + dom).append('<div id="' + datos[0]['FECHA']+ dom + '"></div>');
			
			$('#NSyPS').find('#' + datos[0]['FECHA'] + dom).highcharts({
			chart: {
				height: 250
			},
			credits: {
				enabled: false
			},
			title: {
				text: titulo + datos[0]['FECHA']
			},
			xAxis: {
				categories: puntero.filtToArray(datos, 'HORA'),
				title: {
					text: 'HORA'
				},
			},
			yAxis: {
				max: 100,
				title: {
					text: ''
				},
				labels: {
					formatter: function() {
						return this.value +'%'
					}
				}
			},
			tooltip: {
				crosshairs: true,
				shared: true,
				style: {
					padding: 10,
					fontSize: '16px'
				},
				backgroundColor: 'rgba(255, 255, 255, 0.95)'
			},
			plotOptions: {
				series: {
					lineWidth: 4
				}
			},
			series: [{
				type: 'column',
				name: 'NS_HORA',
				data: puntero.filtToArray(datos, 'NS'),
				color: 'RGB(89, 195, 114)'
			}, {
				type: 'column',
				name: 'PS_HORA',
				data: puntero.filtToArray(datos, 'PS'),
				color: 'RGB(132, 149, 208)'
			}, {
				type: 'spline',
				name: 'NS',
				data: puntero.filtToArray(datos, 'NS_Acu'),
				marker: {
					symbol: 'circle',
					radius: 4,
					lineWidth: 4,
					lineColor: null,
					fillColor: 'white'
				},
				color: 'RGB(50, 137, 72)'
			}, {
				type: 'spline',
				name: 'PS',
				data: puntero.filtToArray(datos, 'PS_Acu'),
				marker: {
					symbol: 'circle',
					radius: 4,
					lineWidth: 4,
					lineColor: null,
					fillColor: 'white'
				},
				color: 'RGB(62, 86, 166)'
			}]
		});
		}



	};


	$(function(){

		$('#fechasAnalisisNSPS').datepicker({
			format: "yyyy-mm-dd",
			language: "es",
			multidateSeparator: ";",
			multidate: true
		});

		indicadores.NS();



	});



</script>