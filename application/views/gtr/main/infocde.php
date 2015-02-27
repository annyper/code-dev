<?php if (isset($tienda_admin) && !empty($tienda_admin)): ?>
<div class="alert alert-info fontSize2">
	<p><strong>Horario:</strong> <?php echo $tienda_admin['Horario']; ?></p>
	<p><strong>Ciudad:</strong> <?php echo $tienda_admin['Ciudad'] . ', '; ?><strong> Clasificación:</strong> <?php echo $tienda_admin['ClasificacionCDE']; ?></p>
	<p><strong>Direccion:</strong> <?php echo $tienda_admin['Direccion']; ?></p>
</div>

<?php if (isset($admin) && !empty($admin)): ?>
	<?php foreach ($admin as $key => $value): ?>
		<p><i class="glyphicon glyphicon-user"></i><strong> Administrador: </strong>
			<?php echo $value['Nombre'] . ' ' . $value['Apellido']; ?> 
		</p>
		<p><strong>Celular:</strong> <?php echo $value['Movil_1']; ?></p>
		<p><i class="glyphicon glyphicon-envelope"></i><strong> Correo:</strong> <a href="mailto:<?php echo $value['Correo']; ?>"><?php echo $value['Correo']; ?></a></p>
	<?php endforeach; ?>
<?php endif; ?>

<?php if (isset($coor) && !empty($coor)): ?>
	<?php foreach ($coor as $key => $value): ?>
		<p><i class="glyphicon glyphicon-user"></i><strong> Coordinador:</strong> 
			<?php echo $value['Nombre'] . ' ' . $value['Apellido']; ?> 
		</p>
		<p><strong>Celular:</strong> <?php echo $value['Movil_1'] . '-' . $value['Movil_2']; ?></p>
		<p><i class="glyphicon glyphicon-envelope"></i><strong> Correo:</strong> 
			<a href="mailto:<?php echo $value['Correo']; ?>"><?php echo $value['Correo']; ?></a>
		</p>
	<?php endforeach; ?>
<?php endif; ?>

<?php endif; ?>