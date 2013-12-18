<div class="panel panel-tigo-amarillo panel-extra">
					  <div class="panel-heading">
					    <h3 class="panel-title" id="AlmuerzosNoJustificados-titulo">
					    	<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
		         				 Almuerzos no justificados <span></span>
		        			</a>
		        			<a href="<?php echo site_url('test/renderAlmuerzoHistorico'); ?>"></a>
		        		</h3>
					  </div>

					  <div id="collapseThree" class="panel-collapse collapse in">
					  	<div class="panel-body" id="">
					  		<div id="AlmuerzosNoJustificados">
					  			<script>
							  		var ipCifrada = $('.containerIP').attr('id');
									var enlaceLoad2 = $('#AlmuerzosNoJustificados-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
									$('#AlmuerzosNoJustificados').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x" style="color: #B98C48;"></i></p>');
									$('#AlmuerzosNoJustificados').load(enlaceLoad2);
								</script>
							</div>
						
					  	</div>
					  </div>
				</div>