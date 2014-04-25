<?php if (isset($total)): ?>
  <div><strong>Tiempo total: </strong><?php echo gmdate('H:i:s',round($total, 1)); ?> (hh:mm:ss)</div>
<?php endif; ?>

        <?php foreach ($sinturno as $key => $value): ?> 
          <?php if ($value['tiempo_Sin_Turno'] > 90): ?>          
              
            <div class="row well-white marcador-borde-rojo bloque-top fontSize1_5">
              <div><strong>Asesor:</strong> <span class="text-danger"><?php echo $value['nombre'] ?></span></div>
              <div class=""><strong>Duración:</strong> <?php echo gmdate('H:i:s',round($value['tiempo_Sin_Turno'], 1)); ?> min
              <span class="pull-right"><strong>Fecha:</strong> <?php echo $value['fecha'] ?></span></div>
            </div>

            <?php endif ?>
        <?php endforeach ?>
        <script>
            var cantidad = <?php echo count($sinturno); ?>;
            $("#labelAcumulado").html(cantidad);
        </script>