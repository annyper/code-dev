<ul class="nav nav-tabs fontSize1_5">
  <li class="active"><a href="#Lineadetiempo" data-toggle="tab">Linea de tiempo</a></li>
  <li><a href="#Acumulado" data-toggle="tab">Acumulado</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane active" id="Lineadetiempo">
  	<?php foreach ($sinturno as $key => $value): ?>	
      <?php if ($value['tiempo_Sin_Turno'] > 90): ?>          
        	
        <div class="row well-white marcador-borde-rojo bloque-top fontSize1_5">
          <div><strong>Asesor:</strong> <span class="text-danger"><?php echo $value['nombre'] ?></span></div>
          <div class=""><strong>Duración:</strong> <?php echo round($value['tiempo_Sin_Turno']/60, 1) ?> min
          <span class="pull-right"><strong>Fecha:</strong> <?php echo $value['fecha'] ?></span></div>
        </div>

        <?php endif ?>
    <?php endforeach ?>
   </div>
  <div class="tab-pane" id="Acumulado">
  	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, asperiores, est unde adipisci totam dolore natus voluptates illum illo vero fuga nobis ratione tempora! Reprehenderit sint in voluptates aperiam ipsum!</p>
  	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi, expedita, rerum, nemo, similique asperiores excepturi ab eos optio quaerat totam est provident nisi ad nobis quod deserunt quas ullam doloremque!</p>
  </div>
</div>