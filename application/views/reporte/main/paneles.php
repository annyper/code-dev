
<?php 
if($region=='0'){
	$info=" - PAIS";
}else{
	$info=" - $region";
}
?>

<script type="text/javascript">

var MatNS=[ 
<?php
$sw=true;
if(isset($list) and is_array($list) ){
	foreach ($list as $key => $option){
		if(!$sw){
			echo ",";
		}else{
			$sw=false; 
			if($cde<>'0'){
				$info=$info." / ".$option['kpi'][0]['cde'];
			}
		}
		?>
		['NS','<?php echo date_format($option['fecha'],"Y-m-d");?>','<?php echo round( $option['kpi'][0]['ns'] *100, 2); ?>']
		<?php
	}
}
?>
];
MatNS.sort();

var MatPS=[ 
<?php
$sw=true;
if(isset($list) and is_array($list) ){
	foreach ($list as $key => $option){
		if(!$sw){echo ",";}else{$sw=false;}
		?>
		['PS','<?php echo date_format($option['fecha'],"Y-m-d");?>','<?php echo round( $option['kpi'][0]['ps'] *100, 2); ?>']
		<?php		  
	}
}
?>
];
MatPS.sort();

var MatAHT=[ 
<?php
$sw=true;
if(isset($list) and is_array($list) ){
	foreach ($list as $key => $option){
		if(!$sw){echo ",";}else{$sw=false;}
		?>
		['AHT','<?php echo date_format($option['fecha'],"Y-m-d");?>','<?php echo round( $option['kpi'][0]['aht'] , 2); ?>']
		<?php		  
	}
}
?>
];
MatAHT.sort();

var MatASA=[ 
<?php
$sw=true;
if(isset($list) and is_array($list) ){
	foreach ($list as $key => $option){
		if(!$sw){echo ",";}else{$sw=false;}
		?>
		['ASA','<?php echo date_format($option['fecha'],"Y-m-d");?>','<?php echo round( $option['kpi'][0]['asa'], 2); ?>']
		<?php		  
	}
}
?>
];
MatASA.sort();


var MatVisitaAt=[ 
<?php
$sw=true;
if(isset($list) and is_array($list) ){
	foreach ($list as $key => $option){
		if(!$sw){echo ",";}else{$sw=false;}
		?>
		['V.Aten Impuntuales','<?php echo date_format($option['fecha'],"Y-m-d");?>',
		'<?php echo round( $option['kpi'][0]['visitasAten'] - $option['kpi'][0]['visitasAtenPun'], 2); ?>']
		<?php		  
	}
	foreach ($list as $key => $option){
		if(!$sw){echo ",";}else{$sw=false;}
		?>
		['V.Aten  Puntuales','<?php echo date_format($option['fecha'],"Y-m-d");?>','<?php echo round( $option['kpi'][0]['visitasAtenPun'], 2); ?>']
		<?php		  
	}
}
?>
];
MatVisitaAt.sort();

var MatAba=[ 
<?php
$sw=true;
if(isset($list) and is_array($list) ){
	foreach ($list as $key => $option){
		if(!$sw){echo ",";}else{$sw=false;}
		?>
		['Aba. Impuntuales','<?php echo date_format($option['fecha'],"Y-m-d");?>',
		'<?php echo round( $option['kpi'][0]['aba'] - $option['kpi'][0]['abaPunt'], 2); ?>']
		<?php		  
	}
	foreach ($list as $key => $option){
		if(!$sw){echo ",";}else{$sw=false;}
		?>
		['Aba.  Puntuales','<?php echo date_format($option['fecha'],"Y-m-d");?>','<?php echo round( $option['kpi'][0]['abaPunt'], 2); ?>']
		<?php		  
	}
}
?>
];
MatAba.sort();


var MatBraq=[ 
<?php
$sw=true;
if(isset($list) and is_array($list) ){
	foreach ($list as $key => $option){
		if(!$sw){echo ",";}else{$sw=false;}
		?>
		['[15-30]','<?php echo date_format($option['fecha'],"Y-m-d");?>',
		'<?php echo round( $option['kpi'][0]['Entre15_30'], 0); ?>']
		<?php		  
	}
	foreach ($list as $key => $option){
		if(!$sw){echo ",";}else{$sw=false;}
		?>
		['[30-45]','<?php echo date_format($option['fecha'],"Y-m-d");?>',
		'<?php echo round( $option['kpi'][0]['Entre30_45'], 0); ?>']
		<?php		  
	}
	foreach ($list as $key => $option){
		if(!$sw){echo ",";}else{$sw=false;}
		?>
		['[45-60]','<?php echo date_format($option['fecha'],"Y-m-d");?>',
		'<?php echo round( $option['kpi'][0]['Entre45_60'], 0); ?>']
		<?php		  
	}	
	foreach ($list as $key => $option){
		if(!$sw){echo ",";}else{$sw=false;}
		?>
		['[>=60]','<?php echo date_format($option['fecha'],"Y-m-d");?>',
		'<?php echo round( $option['kpi'][0]['Mayor60'], 0); ?>']
		<?php		  
	}
}
?>
];
MatBraq.sort();

     //   Entre15_30,Entre30_45,Entre45_60,Mayor60,

var MatVisitas=[ 
<?php
$sw=true;
if(isset($list) and is_array($list) ){	
	foreach ($list as $key => $option){
		if(!$sw){echo ",";}else{$sw=false;}
		?>
		['Visitas Totales','<?php echo date_format($option['fecha'],"Y-m-d");?>','<?php echo round( $option['kpi'][0]['visitasTotal'], 0); ?>']
		<?php		  
	}
}
?>
];
MatVisitas.sort();

function graficar() {
graficarMatrizFechaX('column',MatNS,'KPI','nsChart','Nivel de Servicio','%','<?php echo $formatoFecha; ?>');
graficarMatrizFechaX('column',MatPS,'KPI','psChart','Percepción Servicio','%','<?php echo $formatoFecha; ?>');
graficarMatrizFechaX('column',MatAHT,'KPI','ahtChart','Average Handling Time','min.','<?php echo $formatoFecha; ?>');
graficarMatrizFechaX('column',MatASA,'KPI','asaChart','Average Speed of Answer','min.','<?php echo $formatoFecha; ?>');
graficarMatrizFechaStack('column',MatVisitaAt,'Visitas','vAtenChart','Visitas Atendidas','und.','<?php echo $formatoFecha; ?>');
graficarMatrizFechaStack('column',MatAba,'Abandonos','abaChart','Abandonos','und.','<?php echo $formatoFecha; ?>');
graficarMatrizFechaStack('column',MatBraq,'Visitas','vBraquets','Braquets','und.','<?php echo $formatoFecha; ?>');
graficarMatrizFechaX('column',MatVisitas,'Visitas','vTotalChart','Total Visitas','und.','<?php echo $formatoFecha; ?>');
}
window.onload=graficar();

</script>
<div class="row" id="nivel1">	
		<div class="col-md-6">
			<div class="panel panel-tigo-amarillo panel-extra">
				<div class="panel-heading" data-toggle="collapse" href="#rNS">
					<h3 class="panel-title">Nivel de Servicio<?php echo $info;?>
        			</h3>
				</div>
				<div id="rNS" class="panel-collapse collapse in">
					<div class="panel-body panelesLoad">
						<div id="nsChart" >
						</div>												
					</div>
				</div>

			</div>
		</div>
		
		<div class="col-md-6">
			<div class="panel panel-tigo-amarillo panel-extra">
				<div class="panel-heading" href="#rPS" data-toggle="collapse" >
					<h3 class="panel-title">Percepción de Servicio <?php echo $info;?>
        			</h3>
				</div>
				<div id="rPS" class="panel-collapse collapse in">
					<div class="panel-body panelesLoad" >
						<div id="psChart" >
						</div>						
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="row" id="nivel2">	
		<div class="col-md-6">
			<div class="panel panel-tigo-verde panel-extra">
				<div class="panel-heading" data-toggle="collapse" href="#rAHT">
					<h3 class="panel-title">Tiempo de Atención Promedio<?php echo $info;?>
        			</h3>
				</div>
				<div id="rAHT" class="panel-collapse collapse in">
					<div class="panel-body panelesLoad">
						<div id="ahtChart" >
						</div>
					</div>
				</div>

			</div>
		</div>
		
		<div class="col-md-6">
			<div class="panel panel-tigo-verde panel-extra">
				<div class="panel-heading" data-toggle="collapse" href="#rASA" >
					<h3 class="panel-title">Tiempo de Espera Promedio<?php echo $info;?>
        			</h3>
				</div>
				<div id="rASA" class="panel-collapse collapse in">
					<div class="panel-body panelesLoad" id="">

						<div id="asaChart" >
						</div>
						
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="row"  id="nivel3">	
		<div class="col-md-6">
			<div class="panel panel-tigo-azul panel-extra">
				<div class="panel-heading" data-toggle="collapse" href="#rVisitasA">
					<h3 class="panel-title">Visitas Atendidas<?php echo $info;?></h3>
				</div>
				<div id="rVisitasA" class="panel-collapse  in">
					<div class="panel-body panelesLoad">
						<div id="vAtenChart">
						</div>
					</div>
				</div>

			</div>
		</div>
		
		<div class="col-md-6">
			<div class="panel panel-tigo-azul panel-extra">
				<div class="panel-heading" data-toggle="collapse" href="#rAba" >
					<h3 class="panel-title">Abandonos Totales<?php echo $info;?></h3>
				</div>
				<div id="rAba" class="panel-collapse collapse in">
					<div class="panel-body panelesLoad" id="">

						<div id="abaChart" >
						</div>						
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="row" id="nivel4">	
		<div class="col-md-6">
			<div class="panel panel-tigo-rojo panel-extra">
				<div class="panel-heading" data-toggle="collapse" href="#rBraquets" >
					<h3 class="panel-title">Braquets Visitas Atendidas<?php echo $info;?></h3>
				</div>
				<div id="rBraquets" class="panel-collapse collapse in">
					<div class="panel-body panelesLoad" id="">

						<div id="vBraquets" >
						</div>						
					</div>
				</div>

			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-tigo-rojo panel-extra">
				<div class="panel-heading" data-toggle="collapse" href="#rVisitasT" >
					<h3 class="panel-title">Visitas Totales<?php echo $info;?></h3>
				</div>
				<div id="rVisitasT" class="panel-collapse collapse in">
					<div class="panel-body panelesLoad" id="">

						<div id="vTotalChart" >
						</div>						
					</div>
				</div>

			</div>
		</div>
	</div>
</div>