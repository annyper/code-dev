	<div class="container">
		
		<div class="col-sm-6" id="gtr">
			<div class="panel panel-info panel-extra">
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

								<?php $colas['colas'] = $this->test_model->getColas($turnos['TERMINAL']); ?>
								<?php $colas['servicios'] = $this->test_model->getServicios($turnos['TER_PKSTRID']); ?>

								<a href="#" class="fontSize1_5" data-toggle="modal" data-target="#myModal<?php echo $key; ?>">
									<?php echo $turnos['NOMBRE']; ?>
								</a>
								
								<!-- Modal -->
								<div class="modal" id="myModal<?php echo $key; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-lg"></i></button>
								        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
								      </div>
								      <div class="modal-body">
								      	<?php $this->load->view('test/turno_detalles',$colas) ?>
								      </div>
								    </div><!-- /.modal-content -->
								  </div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
								
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
				
				<div class="panel panel-danger panel-extra">
				  <div class="panel-heading">
				    <h3 class="panel-title">Sin turno tiempo real</h3>
				  </div>
				  <div class="panel-body">
				  	<?php $this->load->view('test/sin_turno') ?>
				  </div>
				</div>

				<div class="panel panel-success panel-extra">
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
			<pre class="fontSize1">
					<?php print_r($row) ?>
			</pre>
		</div>
	</div>
	

    <?php echo $this->benchmark->elapsed_time();?>seg
    
    <?php echo $this->benchmark->memory_usage();?>
<br>
   <?php echo $this->benchmark->elapsed_time('perro', 'gato');?>