

<?php
$fecha = new DateTime($periodo['mes'].'01');
$mes=$fecha->format('MY');
$fecha = new DateTime($periodo['mesAnt'].'01');
$mesAnt=$fecha->format('MY');
$fecha = new DateTime($periodo['mesAnt2'].'01');
$mesAnt2=$fecha->format('MY');
?>

<script type="text/javascript">
var MatCDE=[ 
<?php
if(isset($kpi) and is_array($kpi) ){
	
	echo "['Indicador','Meta','$mesAnt2','$mesAnt','$mes']";
	foreach ($kpi as $key => $option){
		if($option['segmento']=='CDE' && !(is_null($option['metaact'])) && $option['unidad'] == '%'){			
			?>
			,['<?php echo utf8_encode($option['indicador']);?>','<?php echo round( $option['metaact'] *100, 2); ?>','<?php echo round( $option['valorant2'] *100, 2); ?>'
			  ,'<?php echo round( $option['valorant'] *100, 2); ?>','<?php echo round( $option['valoract'] *100, 2); ?>']
			<?php
		}
	}
}
?>];
var MatCC=[ 
<?php
if(isset($kpi) and is_array($kpi) ){
	echo "['Indicador','Meta','$mesAnt2','$mesAnt','$mes']";
	foreach ($kpi as $key => $option){
		if($option['segmento']=='CONTACT CENTER' && !(is_null($option['metaact'])) && $option['unidad'] == '%'){
			?>
			,['<?php echo utf8_encode($option['indicador']);?>','<?php echo round( $option['metaact'] *100, 2); ?>','<?php echo round( $option['valorant2'] *100, 2); ?>'
			  ,'<?php echo round( $option['valorant'] *100, 2); ?>','<?php echo round( $option['valoract'] *100, 2); ?>']
			<?php
		}
	}
}
?>];
var MatDigi=[ 
<?php
if(isset($kpi) and is_array($kpi) ){
	echo "['Indicador','Meta','$mesAnt2','$mesAnt','$mes']";
	foreach ($kpi as $key => $option){
		if($option['segmento']=='DIGITAL' && !(is_null($option['metaact'])) && $option['unidad'] == '%'){
			?>
			,['<?php echo utf8_encode($option['indicador']);?>','<?php echo round( $option['metaact'] *100, 2); ?>','<?php echo round( $option['valorant2'] *100, 2); ?>'
			  ,'<?php echo round( $option['valorant'] *100, 2); ?>','<?php echo round( $option['valoract'] *100, 2); ?>']
			<?php
		}
	}
}
?>];
function graficar() {
graficarMatriz2('spline','column',1,MatCDE,'CUMPLIMIENTO','cdeChart','CENTROS DE SERVICIO',"%");
graficarMatriz2('spline','column',1,MatCC,'CUMPLIMIENTO','ccChart','CONTACT CENTER',"%");
graficarMatriz2('spline','column',1,MatDigi,'CUMPLIMIENTO','digiChart','DIGITAL',"%");
}

$(function(){
  graficar();  
	  $("#tblKPI").tablesorter({
	    theme : "bootstrap",
	    //widthFixed: true,
	    headerTemplate : '{content} {icon}', 
   	 	widgets: [ 'uitheme', 'zebra', 'stickyHeaders', 'filter' ],

	    widgetOptions : {
	      zebra : ["even", "odd"],
	      filter_reset : ".reset",
	      stickyHeaders : '',
	      stickyHeaders_offset : -1,
	      stickyHeaders_cloneId : '-sticky',
	      stickyHeaders_addResizeEvent : true,
	      stickyHeaders_includeCaption : true,
	      stickyHeaders_zIndex : 2,
		  stickyHeaders_attachTo : '#tblStiky',

	      filter_hideFilters : true,
	      filter_ignoreCase : true,
	      filter_liveSearch : true,
	      filter_onlyAvail : 'filter-onlyAvail',
	      filter_saveFilters : true,
	      filter_searchDelay : 300,
	      filter_serversideFiltering: false,
	      filter_startsWith : false,
	      filter_useParsedData : false,
	      filter_defaultAttrib : 'data-value'

	    }
	  });
});




</script>
	<div id="wrapper" class="">      
	      <!-- Sidebar -->
	    <div id="sidebar-wrapper">
	    	<div class="sidebarLasd">
		      	<ul id="sidebar_menu" class="sidebar-nav">
		      	     <li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<i id="main_icon" class="fa fa-align-justify fa-lg"></i></a></li>
		      	</ul>
		      	<ul class="sidebar-nav desactive" id="sidebar">     
		      	  <li><a href="#rVisitasA">Estado asesores</a></li>
		      	  <li><a href="#rNS">Clientes espera</a></li>
		      	  <li><a href="#rAHT">Actividad acumulada</a></li>
		      	  <li><a href="#rBraquets">Indicadores</a></li>
		      	</ul>
	     	</div>
	    </div>
	</div><!-- Sidebar -->



<div class="container">
	<div class="row">		
		<div class="col-md-6">
			
			<div class="panel panel-tigo-azul panel-extra">
				<div class="panel-heading" data-toggle="collapse" href="#rVisitasA">
					<h3 class="panel-title">KPI - Cierre Mes</h3>
				</div>
				<div id="rVisitasA" class="panel-collapse  in">
					<div class="panel-body panelesLoad" >
						<div style="max-Height: 1380px; overflow-y:auto; overflow-x:visible; position: relative;" id="tblStiky">
						<table id="tblKPI" class="tablesorter table tablesorter-bootstrap table-hover fontSize1_5">
							<thead>
								<th>Segmento</th><th>Indicador</th><th data-placeholder=""><?php echo $mesAnt2;?></th><th><?php echo $mesAnt;?></th><th><?php echo $mes;?></th>
							</thead>
							<tbody>								
								<?php
								if(isset($kpi) and is_array($kpi) ){
									foreach ($kpi as $key => $option){													
								?><tr>
									<td><?php echo $option['segmento'];?></td>
									<td><?php echo htmlEntities( $option['indicador'], ENT_QUOTES | ENT_IGNORE, "Windows-1252");?></td>

									<?php 	if($option['unidad'] == '%'){?>			
										<td><?php echo number_format(round( $option['valorant2']*100, 1), 1).$option['unidad'];?></td> 
										<td><?php echo number_format(round( $option['valorant']*100, 1), 1).$option['unidad'];?></td> 
										<td><?php echo number_format(round( $option['valoract']*100, 1), 1).$option['unidad'];?></td> 
									<?php }else if($option['tipo'] == 'Pesos'){?>			
										<td><?php echo "$".number_format($option['valorant2']/1000000,0,',','.')." ".$option['unidad'];?></td> 
										<td><?php echo "$".number_format($option['valorant']/1000000,0,',','.')." ".$option['unidad'];?></td> 
										<td><?php echo "$".number_format($option['valoract']/1000000,0,',','.')." M".$option['unidad'];?></td> 
									<?php }else{?>			
										<td><?php echo number_format($option['valorant2'],0,'.',',')." ".$option['unidad'];?></td> 
										<td><?php echo number_format($option['valorant'],0,'.',',')." ".$option['unidad'];?></td> 
										<td><?php echo number_format($option['valoract'],0,'.',',')." ".$option['unidad'];?></td> 
									<?php }?>


								  </tr><?php									
									}
								}
								?>
							</tbody>
						</table>
						</div>
					</div>
				</div>

			</div>
			
		</div>	
		<div class="col-md-6">
			<div class="panel panel-tigo-amarillo panel-extra">
				<div class="panel-heading" data-toggle="collapse" href="#rNS">
					<h3 class="panel-title">CDE</h3>
				</div>
				<div id="rNS" class="panel-collapse collapse in">
					<div class="panel-body panelesLoad">
						<div id="cdeChart" >
						</div>												
					</div>
				</div>

			</div>
			<div class="panel panel-tigo-verde panel-extra">
				<div class="panel-heading" data-toggle="collapse" href="#rAHT">
					<h3 class="panel-title">CONTACT CENTER</h3>
				</div>
				<div id="rAHT" class="panel-collapse collapse in">
					<div class="panel-body panelesLoad">
						<div id="ccChart" >
						</div>
					</div>
				</div>

			</div>
			<div class="panel panel-tigo-rojo panel-extra">
				<div class="panel-heading" data-toggle="collapse" href="#rBraquets" >
					<h3 class="panel-title">DIGITAL</h3>
				</div>
				<div id="rBraquets" class="panel-collapse collapse in">
					<div class="panel-body panelesLoad" >
						<div id="digiChart" >
						</div>						
					</div>
				</div>

			</div>
		</div>
		
	
	</div>

</div>

<script type="text/javascript">	
	
/*

$('#rAHT').on('click', function() {
            bootstrap_alert.warning('ahtChart','Your text goes here',true);
});*/

</script>
