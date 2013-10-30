<?php $RandonId = rand() ?>
<ul class="nav nav-tabs nav-justified">
  <li class="active"><a href="#servicios<?php echo $RandonId; ?>" data-toggle="tab">Servicios</a></li>
  <li><a href="#colas<?php echo $RandonId; ?>" data-toggle="tab">Información de colas</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="servicios<?php echo $RandonId; ?>">
  		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum, assumenda, repudiandae qui dicta eum exercitationem maiores consequatur cumque sapiente quia impedit animi quo debitis voluptate fugiat aut adipisci laboriosam ipsam necessitatibus id corrupti sunt explicabo pariatur vero at cum et. Quod, explicabo, nisi, adipisci ratione repellat amet magnam et numquam obcaecati porro nam nemo sit expedita odit suscipit id est laborum molestiae veritatis cumque consequatur totam ad maxime voluptate minima? Molestiae perferendis nulla voluptates amet. Amet, odio, reiciendis dolorem velit cum dolorum harum autem officiis necessitatibus numquam maxime hic assumenda corrupti repellendus repellat ducimus perferendis molestiae nostrum sit expedita omnis.
  </div>
  <div class="tab-pane" id="colas<?php echo $RandonId; ?>">

    						<table class="table table-hover table-condensed table-bordered fontSize1">
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