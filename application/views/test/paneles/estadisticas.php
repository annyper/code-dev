			<div class="panel panel-tigo-azul panel-extra">
				<div class="panel-heading">
				    <h3 class="panel-title" id="EstaditicasNsPs-titulo">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseNS-PS">
	         				 Indicadores de rendimiento <span></span>
	        			</a>
                        <a href="<?php echo site_url('test/renderEstadisticas/' . $oficina); ?>"></a>
				    </h3>
				</div>
				<div id="collapseNS-PS" class="panel-collapse collapse in">
					<div class="panel-body">

	                    <div id="EstaditicasNsPs">
	                        <script>
	                            var ipCifrada = $('.containerIP').attr('id');
	                            var enlaceLoad2 = $('#EstaditicasNsPs-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
	                            console.log(enlaceLoad2);
	                            $('#EstaditicasNsPs').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x" style="color: #B98C48;"></i></p>');
	                            $('#EstaditicasNsPs').load(enlaceLoad2);
	                        </script>
	                    </div>
						
					</div>
				</div>
			</div>