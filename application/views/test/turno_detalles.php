<?php $RandonId = rand() ?>
<ul class="nav nav-tabs nav-justified">
  <li class="active"><a href="#servicios<?php echo $RandonId; ?>" data-toggle="tab">Servicios</a></li>
  <li><a href="#colas<?php echo $RandonId; ?>" data-toggle="tab">Información de colas</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="servicios<?php echo $RandonId; ?>">
  		<!-- <pre><?php //print_r($servicios); ?></pre> -->

  		<div class="margen">
  			<?php foreach ($servicios as $key => $value): ?>
  			<p> 
  				<strong class="text-success"><?php echo $value['SER_SDSTRNOMBRE']; ?></strong><br>
				<?php echo $value['SUB_SDSTRNOMBRE'];; ?>
  			 </p>
  			<?php endforeach; ?>
  		</div>
		
   </div>
  <div class="tab-pane" id="colas<?php echo $RandonId; ?>">

    						<table class="margen table table-hover table-condensed table-bordered fontSize1 table-responsive">
					       		<thead>
					       			<tr>
					       				<th>Cola</th>
					       				<th>Terminal</th>
					       				<th>Prioridad</th>
					       				<th>Usuario que modificó</th>
					       				<th>Fecha modificación</th>
					       			</tr>
					       		</thead>
					       		<tbody>
					       			<?php foreach ($colas as $key => $value): ?>
						       		<tr>
										<td><?php echo $value['COL_SDSTRNOMBRE']; ?></td>
										<td><?php echo $value['TER_SDSTRNOMBRE']; ?></td>
										<td><?php echo $value['TERATI_SDINTVALORPRIORIDAD']; ?></td>
										<td><?php echo $value['LOG_SDSTRUSUARIO']; ?></td>
										<td><?php echo $value['LOG_SDDATMODIFICACION']; ?></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
					       	</table>
	  </div>
</div>