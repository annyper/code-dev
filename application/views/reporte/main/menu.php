
<div id="wrapper" class="">      
	      <!-- Sidebar -->
	    <div id="sidebar-wrapper">
	    	<div class="sidebarLasd">
		      	<ul id="sidebar_menu" class="sidebar-nav">
		      	     <li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<i id="main_icon" class="fa fa-align-justify fa-lg"></i></a></li>
		      	</ul>
		      	<ul class="sidebar-nav desactive" id="sidebar">     
		      	  <li><a href="#filtroReporte">Filtro</a></li>
		      	  <li><a href="#nivel1">NS - PS</a></li>
		      	  <li><a href="#nivel2">AHT - ASA</a></li>
		      	  <li><a href="#nivel3">Visitas - Abandonos</a></li>
		      	  <li><a href="#nivel4">Braquets - Total Visitas</a></li>
		      	</ul>
	     	</div>
	    </div>
	</div><!-- Sidebar -->
<div class="container">
	<div class="row">
		<div class="col-md-9 col-sm-9" >
			<div class="row">
				
				<div class="panel panel-default">
					<div class="panel-body">

						<div class="row" id="filtroReporte">

						<div class="form-group col-md-3 col-sm-4">
							<label for="regionalLst">Regional</label>
							<select id="regionalLst" class="form-control" 
							onchange="loadAjax('cdeLst','<?php echo site_url('reporte/renderCentralCDELst');?>',new Array($('#regionalLst').val()));">							
								<option value="0">Todo el País...</option>
								<option value="CENTRO">CENTRO</option>
								<option value="COSTA">COSTA</option>
								<option value="NOROCCIDENTE">NOROCCIDENTE</option>
								<option value="ORIENTE">ORIENTE</option>
								<option value="SUROCCIDENTE">SUROCCIDENTE</option>
							</select>

						</div>	
						<div class="form-group col-md-5 col-sm-8">	
							<label for="cdeLst">CDE</label>
							<select id="cdeLst" class="form-control" >
								<option value="0">Todo...</option>

							</select>
						</div>	
						</div>
						<div class="row">
						<div class="col-md-2 col-sm-3 col-xs-4">
							<select id="periodo" class="form-control" 
							 onchange="changeDate('fechaProgramada','2013-04-24',true,parseInt($('#periodo').val()),'; ');" >
								<option value="0">Día</option>
								<option value="1">Mes</option>
								<!-- option value="2">Año</option -->
							</select>
						</div>
						<div class="input-group col-md-10 col-sm-12 col-xs-12" style="margin-bottom:1%;">
							
							<input id="fechaProgramada" type="text" class="form-control" 
								placeholder="Seleccione las fechas... " class="datepicker" >							

							<span class="input-group-btn">
								<button class="btn btn-success" type="button" 
								onclick="loadAjaxIco('paneles','panelesLoad','<?php echo site_url('reporte/renderPanelesKPI');?>',
								new Array($('#regionalLst').val(),$('#cdeLst').val(),$('#periodo').val(),$('#fechaProgramada').val().replace(/; /gi,'_')));">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>				
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
<div id="paneles">
	<div class="row" id="nivel1">	
		<div class="col-md-6">
			<div class="panel panel-tigo-amarillo panel-extra">
				<div class="panel-heading" data-toggle="collapse" href="#rNS">
					<h3 class="panel-title">						
	         				 Nivel de Servicio
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
					<h3 class="panel-title">						
	         				 Percepción de Servicio
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
	<div class="row"  id="nivel2">	
		<div class="col-md-6">
			<div class="panel panel-tigo-verde panel-extra">
				<div class="panel-heading" data-toggle="collapse" href="#rAHT">
					<h3 class="panel-title">						
	         				 Tiempo de Atención Promedio
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
					<h3 class="panel-title">						
	         				 Tiempo de Espera Promedio
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
	<div class="row" id="nivel3">	
		<div class="col-md-6">
			<div class="panel panel-tigo-azul panel-extra">
				<div class="panel-heading" data-toggle="collapse" href="#rVisitasA">
					<h3 class="panel-title">Visitas Atendidas</h3>
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
					<h3 class="panel-title">Abandonos Totales</h3>
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
	<div class="row"  id="nivel4">	
		<div class="col-md-6">
			<div class="panel panel-tigo-rojo panel-extra">
				<div class="panel-heading" data-toggle="collapse" href="#rBraquets" >
					<h3 class="panel-title">Braquets Visitas Atendidas</h3>
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
					<h3 class="panel-title">Visitas Totales</h3>
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
</div>
</div>

<script type="text/javascript">
	$(function(){
		changeDate('fechaProgramada','2013-04-24',true,parseInt($("#periodo").val()),"; ");	
	});
	
</script>
