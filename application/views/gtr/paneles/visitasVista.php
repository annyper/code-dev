			<div class="panel panel-tigo-azul panel-extra">
				<div class="panel-heading">
				    <h3 class="panel-title" id="visitasAtendidos-titulo">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseNS-visitas">
	         				 Visitas <span></span>
	        			</a>
                        <a href="<?php echo site_url('gtr/renderVisitasHoy/' . $oficina); ?>" type="button" id="btnVisitas" class="btn btn-primary"><i class="fa fa-flash"></i> Generar</a>
				    </h3>
				</div>
				<div id="collapseNS-visitas" class="panel-collapse collapse in">
					<div class="panel-body">

	                    <div id="visitasAtendidos">
	                    </div>
						
					</div>
				</div>
			</div>