<?php //echo "<pre>"; print_r($Esp); echo "</pre>"; ?>

<div class="">
<table class="table table-hover table-striped fontSize1_5 " id="">
	<thead>
		<tr style="cursor:s-resize">
			<th>REGIONAL</th>
			<th>CDE</th>
			<th class="hidden-xs">[0 a 15]</th>
	    	<th class="hidden-xs">[15 a 30]</th>
	    	<th class="hidden-xs">[30 a 45]</th>
	    	<th class="hidden-xs">[45 a 60]</th>
	    	<th class="hidden-xs">[Mayor a 60]</th>
			<th>NS</th>
			<th>PS</th>
			<th>PS Esperada</th>
		</tr>
	</thead>
	<tbody id="tablaGTResperaBody" style="color: black;">
		<?php foreach ($Esp as $key => $value): ?>
		<?php 
			$ipCifrada = $this->encrypt->encode($value['ip']);
            
            $ipCifrada = str_replace("/", "-", $ipCifrada);
            $ipCifrada = str_replace("+", "_", $ipCifrada);
            $ipCifrada = str_replace("=", "", $ipCifrada);
		 ?>
		<tr>		
			<td><?php echo $value['REGIONAL']; ?></td>
			<td class="text-primary tiendaLink">
				<a class="lanzador" data-cde="<?php echo $value['NOMBRE']; ?>" href="<?php echo site_url('gtr/renderRacsTiempoReal2') . '/' . str_replace(" ", "-", trim($value['NOMBRE'])) . '/' . $ipCifrada; ?>" 
					id="<?php echo site_url('gtr/renderClientesEsperaTiempoReal') . '/' . str_replace(" ", "-", trim($value['NOMBRE'])) . '/' . $ipCifrada; ?>">
					<strong class="fontSize1_5"><?php echo $value['NOMBRE']; ?></strong>
				</a>
			</td>
			<td class="hidden-xs"><?php echo $value['Entre0_5_2'] + $value['Entre5_15_2']; ?></td>
			<td class="hidden-xs"><?php echo $value['Entre15_30_2']; ?></td>
			<td class="hidden-xs"><?php echo $value['Entre30_45_2']; ?></td>
			<td class="hidden-xs"><?php echo $value['Entre45_60_2']; ?></td>
			<td class="hidden-xs"><?php echo $value['Mayor60_2']; ?></td>
			
			<?php if (date('Y-m-d') != $value['fecha']): ?>
				<td></td><td></td><td></td>
			<?php else: ?>
				<td class="formato-color-target"><span class=""><?php echo round($value['SL']*100, 2); ?></span></td>
				<td class="formato-color-target"><span class=""><?php echo round($value['PS'], 2); ?></span></td>
				<td class="formato-color-target"><span class=""><?php echo round($value['PS_ESPERADA'], 2); ?></span></td>
			<?php endif ?>

			<td>
				<div class="btn-group botonInfoCDE" data-toggle="buttons">
					<label class="btn btn-default btn-xs">			
						<input type="checkbox" class="" ><span class="glyphicon glyphicon-eye-open success"></span>
					</label>
					<a href="<?php echo site_url('gtr/renderInfoCDE') . '/' . $value['COD_POS']; ?>" ></a>
				</div>
			</td>		
		</tr>
		<tr class="desaparecer troculta">
			<td colspan="10">
				<div class="btn-group">				
					<a href="<?php echo site_url('gtr/cde') . '/' . str_replace(" ", "-", trim($value['NOMBRE'])); ?>" target="_blank" class="btn btn-default btn-sm" > Ver CDE</a>
					
					<a href="<?php echo site_url('analytics/index') . '/' . str_replace(" ", "-", trim($value['NOMBRE'])); ?>" 
						target="_blank" class="btn btn-default btn-sm" > Ver Analytics</a>
					<a href="<?php echo site_url('gtr/editInfoCDE') . '/' . $value['COD_POS']; ?>" 
						target="_blank" class="btn btn-info btn-sm" ><i class="fa fa-pencil-square-o fa-lg"></i> Editar</a>
				</div>
				<div class="panel panel-default">
					<div class="panel-body infoCDEcomp">
						
					</div>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>

<script>
	var timer;
	var timer2;

	$('.botonInfoCDE').on('click', function(e){
		e.preventDefault();
		
		var enlace = $(this).find('a').attr('href');
		console.log(enlace);
		$(this).parent().parent().next().toggleClass("desaparecer");

		$(this).parent().parent().next().find('.infoCDEcomp').load(enlace);

	});

	$('.tiendaLink a.lanzador').on('click', function(e){
		e.preventDefault();

		$("#tablaGTResperaBody tr").removeClass("success");
		$(this).parent().parent().addClass("success");
		
		$('#panelInfoCDE').removeClass("desaparecer");

		clearInterval(timer);
		clearInterval(timer2);		

		var oficina = $(this).attr('id');

		var enlace = $(this).attr('href');
		var enlace2 = $(this).attr('id');

       	console.log(enlace);
       	console.log(enlace2);
       	$('#mainEstadoRacs').html('<i class="fa fa-refresh fa-spin"></i>');
       	$('#mainEstadoRacs').load(enlace);       	
       	$('#mainEstadoRacs-titulo .nombreTienda').html($(this).text());

       	$('#mainClientesEspera').html('<i class="fa fa-refresh fa-spin"></i>');
       	$('#mainClientesEspera').load(enlace2);
       	$('#mainClientesEspera-titulo .nombreTienda').html($(this).text());
		
		timer = setInterval( function() 
    	{
    	    $('#mainEstadoRacs').load(enlace);
    	    //$(idTitulo + ' a span').html('<i class="font-color-blanco fa fa-check"></i>')
    	}, 7000);
    	timer2 = setInterval( function() 
    	{
    	    $('#mainClientesEspera').load(enlace2);
    	}, 7000);
	});

	//$(function(){

		$("#tablaGTRespera").tablesorter({
			theme : 'blue'
		});

		//console.log($(".formato-color-target span").value);
		//$(".formato-color-target span").addClass("formato-color-amarillo");

		$( "td.formato-color-target span" ).each(function( index ) {
			if ($( this ).text() < 70) {

				$(this).addClass("formato-color-rojo");
				
			}else if($( this ).text() < 80){
				$(this).addClass("formato-color-amarillo");

			}else if($( this ).text() <= 100){
				$(this).addClass("formato-color-verde");
			};
		});

	//});

</script>