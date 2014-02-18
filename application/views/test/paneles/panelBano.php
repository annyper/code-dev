				<div class="panel panel-info panel-extra">
					  <div class="panel-heading">
					    <h3 class="panel-title" id="BanoAcumulado-titulo">
					    	<a data-toggle="collapse" data-parent="#accordion" href="#collapseBano">
		         				Historico baños <span class="fontSize0"><?php echo $oficina2; ?></span>
		        			</a>
		        			<a href="<?php echo site_url('test/renderBanohistorico'); ?>"></a>
		        		</h3>
					  </div>

					  <div id="collapseBano" class="panel-collapse collapse">
					  	<div class="panel-body" id="">
					  		<div id="BanoAcumulado">
					  			<script>
							  		var ipCifrada = $('.containerIP').attr('id');
									var enlaceLoad2 = $('#BanoAcumulado-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
									$('#BanoAcumulado').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x" style="color: #B98C48;"></i></p>');
									$('#BanoAcumulado').load(enlaceLoad2);
								</script>
							</div>
					
					  	</div>
					  </div>
				</div>