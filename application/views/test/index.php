	<div class="container">
		<div class="col-sm-2" id="panel">
		</div>

		<div class="col-sm-7" id="gtr">
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
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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

		<div class="col-sm-3" id="estadisticas">
			<pre class="fontSize1">
			<?php print_r($row) ?>
			</pre>
		</div>
	</div>
	

    <?php echo $this->benchmark->elapsed_time();?>seg
    
    <?php echo $this->benchmark->memory_usage();?>
<br>
   <?php echo $this->benchmark->elapsed_time('perro', 'gato');?>