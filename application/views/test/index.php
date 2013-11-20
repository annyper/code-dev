	<div class="container">
		
		<div class="col-sm-6" id="gtr">
			<div class="panel panel-tigo-verde panel-extra">
				<div class="panel-heading">
					<h3 class="panel-title">Estado de los asesores</h3>
				</div>
				<div class="panel-body">
					<?php foreach ($row as $key => $turnos): ?>

						<div class="row well-white marcador-borde-verde bloque-top">
							<div class="col-sm-2 fontSize1_5">
								<?php echo $turnos['LABOR']; ?>
							</div>
							<div class="col-sm-5">
								<?php $terminal = str_replace(" ", "-", $turnos['TERMINAL']); ?>
								<?php //$CDE = $this->test_model->getServicios($turnos['TER_PKSTRID']); ?>

								<h5 class="media-heading text-primary foroTitulo">	
									<a href="<?php echo site_url('test/cargarModalTurnoAjax/' . $terminal . '/' . $turnos['TER_PKSTRID']); ?>" 
										class="fontSize1_5" data-toggle="modal" data-target="#myModal">
										<?php echo $turnos['NOMBRE']; ?>
									</a>
								</h5>
								

								
							</div>
							<div class="col-sm-2 fontSize1_5">
								<?php echo $turnos['TIEMPO']; ?>
								<span class="pull-right"><?php echo $turnos['TURNO']; ?></span>
							</div>
							<div class="col-sm-3 fontSize1_5">
								<?php echo $turnos['TERMINAL']; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			
		</div>

		<div class="col-sm-6 col-md-3" id="sinTurno">
			<div class="row">
				
				<div class="panel panel-tigo-rojo panel-extra">
				  <div class="panel-heading">
				    <h3 class="panel-title"><i class="fa fa-check fa-3x"></i>Sin turno tiempo real</h3>
				  </div>
				  <div class="panel-body">
				  	<?php $this->load->view('test/sin_turno') ?>
				  </div>
				</div>

				<div class="panel panel-tigo-amarillo panel-extra">
				  <div class="panel-heading">
				    <h3 class="panel-title">Almuerzos no justificados</h3>
				  </div>
				  <div class="panel-body">
				  	<?php $this->load->view('test/almuerzo-no-justificado') ?>
				  </div>
				</div>
			</div>
		</div>

		<div class="col-xs-12 col-sm-11 col-md-3" id="estadisticas">
			<div class="panel panel-tigo-azul panel-extra">
				<div class="panel-heading">
				    <h3 class="panel-title">Indicadores de rendimiento</h3>
				</div>
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
	
	<!-- <pre class="fontSize1"><?php //print_r($row) ?></pre> -->

    <?php echo $this->benchmark->elapsed_time();?>seg
    
    <?php echo $this->benchmark->memory_usage();?>
<br>
	<p>Tiempo de consulta: 
   		<?php echo $this->benchmark->elapsed_time('perro', 'gato');?>
   </p>

<!-- Modal -->


<div class="modal cuerpoModalDelForo" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div><!-- /.modal -->