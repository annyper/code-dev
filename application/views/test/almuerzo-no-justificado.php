<?php foreach ($AlmuerzoHistorico as $key => $value): ?>

    <div class="row well-white marcador-borde-Amarillo bloque-top fontSize1_5">
       <div><strong>Asesor:</strong> <span class="" style="color: #B98C48;"><?php echo $value['nombre'] ?></span></div>
       <div class=""><strong>Duración:</strong> <?php echo gmdate('H:i:s',round($value['tiempo_Labor'], 1)); ?> min
       <span class="pull-right"><strong>Fecha:</strong> <?php echo $value['fecha'] ?></span></div>
    </div>

<?php endforeach; ?>