<?php if (isset($total)): ?>
	<div><strong>Tiempo total: </strong><?php echo gmdate('H:i:s',round($total, 1)); ?> (hh:mm:ss)</div>
<?php endif; ?>


<?php foreach ($Historico as $key => $value): ?>

    <div class="row well-white marcador-borde-azul bloque-top fontSize1_5">
       <div><strong>Asesor:</strong> <span class="" style="color: <?php echo $color; ?>;"><?php echo $value['nombre'] ?></span></div>
       <div class=""><strong>Duración:</strong> <?php echo gmdate('H:i:s',round($value['tiempo_Labor'], 1)); ?> min
       <span class="pull-right"><strong>Fecha:</strong> <?php echo $value['fecha'] ?></span></div>
    </div>

<?php endforeach; ?>