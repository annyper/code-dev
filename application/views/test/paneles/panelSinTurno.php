<div class="row">
				
				<div class="panel panel-tigo-rojo panel-extra">
				  <div class="panel-heading">
				    <h3 class="panel-title" id="sinTurnoAcumulado-titulo">
				    	<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
	         				 Sin turno tiempo real <span></span>
	        			</a>
	        			<a href="<?php echo site_url('test/renderSinTurnoTiempoReal/' . $oficina); ?>"></a>
	        			<a href="<?php echo site_url('test/renderSinTurno'); ?>"></a>
	        		</h3>
				  </div>
				  <div id="collapseTwo" class="panel-collapse collapse in">
					  <div class="panel-body" id="sinTurnoAcumulado">
					  	
					  	<ul class="nav nav-tabs fontSize1_5">
						  <li class="active"><a href="#Lineadetiempo" data-toggle="tab">Linea de tiempo 
						        <span class="label label-default fontSize1" id="labelTiempoReal"></span></a>
						  </li>
						  <li><a href="#Acumulado" data-toggle="tab">Acumulado 
						        <span class="label label-default fontSize1" id="labelAcumulado"></span></a>
						  </li>
						</ul>

						<div class="tab-content">
						  	<div class="tab-pane active" id="Lineadetiempo">
						  		<script>
							  		var ipCifrada = $('.containerIP').attr('id');
									var enlaceLoad2 = $('#sinTurnoAcumulado-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
									$('#Lineadetiempo').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x text-danger"></i></p>');
									$('#Lineadetiempo').load(enlaceLoad2);
								</script>
						    	
						   	</div>
							
							<div class="tab-pane" id="Acumulado">
							  	<script>
							  		var ipCifrada = $('.containerIP').attr('id');
									var enlaceLoad3 = $('#sinTurnoAcumulado-titulo a:eq(2)').attr('href')+ '/' + ipCifrada;
									 console.log(enlaceLoad3)
									//$('#Acumulado').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x text-danger"></i></p>');
									$('#Acumulado').load(enlaceLoad3);
								</script>
							</div>
						</div>
					  	
					  </div>
				  </div>
				</div>

				<div class="panel panel-tigo-amarillo panel-extra">
				  <div class="panel-heading">
				    <h3 class="panel-title">
				    	<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
	         				 Almuerzos no justificados <span></span>
	        			</a>
	        		</h3>
				  </div>
				  <div id="collapseThree" class="panel-collapse collapse in">
				  	<div class="panel-body" id="estadoAsesores2">
				  		<?php $this->load->view('test/almuerzo-no-justificado') ?>
					
				  	</div>
				  </div>
				</div>

			</div>