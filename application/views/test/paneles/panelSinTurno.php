			<div class="panel panel-tigo-rojo panel-extra">
				  <div class="panel-heading">
				    <h3 class="panel-title" id="sinTurnoAcumulado-titulo">
				    	<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
	         				 Sin turno acumulado <span class="fontSize0"><?php echo $oficina2; ?></span>
	        			</a>
	        			<a href="<?php echo site_url('test/renderSinTurno'); ?>"></a>
	        		</h3>
				  </div>
				  <div id="collapseTwo" class="panel-collapse collapse">
					  <div class="panel-body" id="sinTurnoAcumulado">
					  	

							  	<script>
							  		var ipCifrada = $('.containerIP').attr('id');
									var enlaceLoad3 = $('#sinTurnoAcumulado-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
									 console.log(enlaceLoad3)
									//$('#Acumulado').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x text-danger"></i></p>');
									$('#sinTurnoAcumulado').load(enlaceLoad3);
								</script>
							
						</div>
					  						 
				  </div>
				</div>