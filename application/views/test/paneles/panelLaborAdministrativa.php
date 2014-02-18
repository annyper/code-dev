				<div class="panel panel-info panel-extra">
					  <div class="panel-heading">
					    <h3 class="panel-title" id="LaborAdministrativaAcumulada-titulo">
					    	<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
		         				Labor administrativa acumulada <span class="fontSize0"><?php echo $oficina2; ?></span>
		        			</a>
		        			<a href="<?php echo site_url('test/renderLaborAdministrativaHistorico'); ?>"></a>
		        		</h3>
					  </div>

					  <div id="collapseFour" class="panel-collapse collapse">
					  	<div class="panel-body" id="">
					  		<div id="LaborAdministrativaAcumulada">
					  			<script>
							  		var ipCifrada = $('.containerIP').attr('id');
									var enlaceLoad2 = $('#LaborAdministrativaAcumulada-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
									$('#LaborAdministrativaAcumulada').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x" style="color: #B98C48;"></i></p>');
									$('#LaborAdministrativaAcumulada').load(enlaceLoad2);
								</script>
							</div>
					
					  	</div>
					  </div>
				</div>