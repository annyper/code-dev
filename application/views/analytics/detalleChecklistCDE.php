<table class="table table-hover table-striped table-condensed table-bordered">
	<thead>
		<tr>
			<th>FECHA</th>
			<th>DIA</th>
			<th>HORA APERTURA</th>
			<th>HORA INGRESO</th>
			<th>REGIONAL</th>
			<th>CDE</th>
			<th>RESULTADO</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data as $key => $value): ?>
		<tr>
			
			<td><?php echo $value['fechaa']; ?></td>
			<td><?php echo $value['Dia']; ?></td>
			<td><?php echo $value['Apertura1']; ?></td>
			<td><?php echo $value['hora_ingreso']; ?></td>
			<td><?php echo $value['regional']; ?></td>
			<td><?php echo $value['Tienda']; ?></td>
			<td><?php echo $value['Check_list']; ?></td>
			
			
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>