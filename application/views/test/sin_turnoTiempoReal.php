<?php //echo "<pre>"; print_r($sinturnoTiempoReal); echo "</pre>"; ?>

        <?php foreach ($sinturnoTiempoReal as $key => $value): ?> 
            <div class="row well-white marcador-borde-rojo bloque-top fontSize1_5">
              <div><strong>Asesor:</strong> <span class="text-danger"><?php echo $value['NOMBRE'] ?></span></div>
              <div class=""><strong>Duración:</strong> <?php echo gmdate('H:i:s',round($value['TIEMPO']*60, 1)); ?> min
              <span class="pull-right"><?php echo $value['TERMINAL'] ?></span></div>
            </div>
        <?php endforeach ?>

        <script>
            var cantidad = <?php echo count($sinturnoTiempoReal); ?>;
            $("#labelTiempoReal").html(cantidad);
        </script>