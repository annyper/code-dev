	<div class="container containerIP" id="<?php echo $ipCifrada; ?>">
		
		<div class="col-sm-6" id="gtr">
			<div class="panel panel-tigo-verde panel-extra">
				<div class="panel-heading">
					<h3 class="panel-title" id="estadoAsesores-titulo">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
	         				 Estado de los asesores <span></span>
	        			</a>
	        			<a href="<?php echo site_url('test/renderRacsTiempoReal/' . $oficina); ?>"></a>
        			</h3>
				</div>
				<div id="collapseOne" class="panel-collapse collapse">
					<div class="panel-body" id="estadoAsesores">
						
						<script>
							var ipCifrada = $('.containerIP').attr('id');
							var enlaceLoad1 = $('#estadoAsesores-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
							 console.log(enlaceLoad1)
							$('#estadoAsesores').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x text-success"></i></p>');
							$('#estadoAsesores').load(enlaceLoad1, function( response, status, xhr ) {
							  if ( status == "error" ) {
							    var msg = "Error 404: Karen Garcia NOT found ";
							    $( "#estadoAsesores" ).html( msg + xhr.status + " " + xhr.statusText );
							  }
							});
						</script>
					</div>
				</div>

			</div>

			<div class="panel panel-tigo-verde panel-extra">
				<div class="panel-heading">
					<h3 class="panel-title" id="clientesEspera-titulo">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseClientes">
	         				 Clientes en espera <span></span>
	        			</a>
	        			<a href="<?php echo site_url('test/renderClientesEsperaTiempoReal'); ?>"></a>
        			</h3>
				</div>
				<div id="collapseClientes" class="panel-collapse collapse in">
					<div class="panel-body" id="clientesEspera">
						
						<script>
							var ipCifrada = $('.containerIP').attr('id');
							var enlaceLoad1 = $('#clientesEspera-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
							 console.log(enlaceLoad1)
							$('#clientesEspera').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x text-success"></i></p>');
							$('#clientesEspera').load(enlaceLoad1, function( response, status, xhr ) {
							  if ( status == "error" ) {
							    var msg = "Error 404: Karen Garcia NOT found ";
							    $( "#clientesEspera" ).html( msg + xhr.status + " " + xhr.statusText );
							  }
							});
						</script>
					</div>
				</div>

			</div>

			
		</div>

		<div class="col-sm-6 col-md-3" id="sinTurno">
			<?php $this->load->view('test/paneles/panelSinTurno') ?>
		</div>

		<div class="col-xs-12 col-sm-11 col-md-3" id="estadisticas">
			<div class="panel panel-tigo-azul panel-extra">
				<div class="panel-heading">
				    <h3 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
	         				 Indicadores de rendimiento <span></span>
	        			</a>
				    </h3>
				</div>
				<div id="collapseFour" class="panel-collapse collapse in">
				<div class="panel-body">
					<div id="container1" style="margin: 0 auto">
						<script>
							$(function () {
							    var chart;
							    
							    $(document).ready(function () {
							    	
							    	// Build the chart
							        $('#container1').highcharts({
							            chart: {
							                plotBackgroundColor: null,
							                plotBorderWidth: null,
							                plotShadow: false
							            },
							            title: {
							                text: 'Estado de la sala'
							            },
							            tooltip: {
							        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
							            },
							            plotOptions: {
							                pie: {
							                    allowPointSelect: true,
							                    cursor: 'pointer',
							                    dataLabels: {
							                        enabled: false
							                    },
							                    showInLegend: true
							                }
							            },
							            series: [{
							                type: 'pie',
							                name: 'Browser share',
							                data: [
							                    ['Siendo Atendidos',   45.0],
							                    ['[0,15)',     6.2],
							                    ['[15,30)',       26.8],
							                    {
							                        name: 'Chrome',
							                        y: 12.8,
							                        sliced: true,
							                        selected: true
							                    },
							                    ['[45,60)',    8.5],
							                    ['Mas de 60',   0.7]
							                ]
							            }]
							        });
							    });
							    
							});
						</script>
					</div>
					
					<div id="container2" style="margin: 0 auto">
						<script>
							$(function () {
						        $('#container2').highcharts({
						            chart: {
						                type: 'bar'
						            },
						            title: {
						                text: 'Nivel y Percepción de servicio'
						            },
						            subtitle: {
						                text: 'Source: Wikipedia.org'
						            },
						            xAxis: {
						                categories: ['9:00', '9:30', '10:00', '10:30', '11:00'],
						                title: {
						                    text: null
						                }
						            },
						            yAxis: {
						                min: 0,
						                title: {
						                    text: 'Population (millions)',
						                    align: 'high'
						                },
						                labels: {
						                    overflow: 'justify'
						                }
						            },
						            tooltip: {
						                valueSuffix: ' millions'
						            },
						            plotOptions: {
						                bar: {
						                    dataLabels: {
						                        enabled: true
						                    }
						                }
						            },
						            legend: {
						                layout: 'vertical',
						                align: 'right',
						                verticalAlign: 'top',
						                x: -40,
						                y: 100,
						                floating: true,
						                borderWidth: 1,
						                backgroundColor: '#FFFFFF',
						                shadow: true
						            },
						            credits: {
						                enabled: false
						            },
						            series: [{
						                name: 'NS',
						                data: [90, 83, 35, 28, 29]
						            }, {
						                name: 'PS',
						                data: [92, 86, 45, 38, 6]
						            }]
						        });
						    });
						</script>
					</div>


				</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- <pre class="fontSize1"><?php //print_r($row) ?></pre> -->

    <?php echo $this->benchmark->elapsed_time();?>seg
    
    <?php echo $this->benchmark->memory_usage();?>
<br>

<!-- Modal -->


<div class="modal cuerpoModalDelForo" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div><!-- /.modal -->