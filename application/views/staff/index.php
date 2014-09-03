<!DOCTYPE html>
<html lang="es">
<head>
	<title>Staff</title>
	<meta charset="UTF-8">
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="bootstrap/js/underscore-min.js"></script>
	<script src="bootstrap/js/staff.js"></script>
</head>
<body>
	<p>Hola Mundo</p>
	<div class="fecha">
		<input id="fecha1" type="date" class="form-control" placeholder="Text input" value="2014-06-17">
		<input id="fecha2" type="date" class="form-control" placeholder="Text input" value="2014-06-10">
	</div>

	<div class="forCDE">
		<p>Abandono: 
			<input id="aba" type="number" step="0.1" max="100" min="-100" class="form-control" placeholder="Abandono" value="-0.1">
		</p>
		<p>Primer turno:
			<input id="PrimerTurno" type="number" step="1" min="0" class="form-control" placeholder="Primer turno" value="38">
		</p>
		<p>Segundo turno:
			<input id="SegTurno" type="number" step="1" min="0" class="form-control" placeholder="Segundo Turno" value="0">
		</p>
		<p>Hora Seg turno:
			<input id="HoraSegTurno" type="number" step="0.1" min="0" max="24" class="form-control" placeholder="Hora Segundo Turno" value="11">
		</p>
	</div>


	<input id="CodPos" type="number" class="form-control" placeholder="Codigo Post" value="5000035">
	<a id="validacion" href="<?php echo site_url("/staff/u") ?>" class="btn btn-default">Fecha</a>

</body>
</html>

<script>
//     PronosticosTigo.js 0.0.1

//     (c) 2014-2014 Lennin Suescun Devia, Coordinador de monitoreo Tigo.
//     PronosticosTigo may be freely distributed under the MIT license.
var resultado = {
	numberDatos : {},
	datos : {},
	consolidado: [],

	// Extrae los datos históricos de tráfico, los normaliza y los almacena en el array de datos.
	validacion : function(fechaReferencia, CodPos){

		var puntero = this;

		var fecha = $('#' + fechaReferencia);
		var boton = $('#validacion');
		var url = boton.attr("href") + '/' + CodPos +'/'+ fecha.val();

				$.ajax(url,{
					type: 'GET',
					dataType: 'json',
					beforeSend: function(){

					},
					success: function(result){
						puntero.datos[CodPos].push(puntero.normalizacion(result));

						puntero.numberDatos[CodPos]++;

						if (puntero.numberDatos[CodPos] == 2) {

							puntero.promediacion(CodPos);

							console.log("promediado y consolidado :D");
						}
						
					}

				});


			},
	//Estandariza todos los datos históricos obtenidos en el rango de las 7 a 22 horas.
	normalizacion: function(arreglo){
		var variable = [];
		var sw = true;
		for (var i = 14; i <= 44; i++) {
			for (var j = 0; j < arreglo.length; j++) {
				
				if (i/2 == arreglo[j]["HORA"]) {
					variable.push(arreglo[j]);
					sw = false;
				}
			}
			if (sw) {
				variable.push({
					ATENCION: 0,
					ATENDIDOS: 0,
					ESPERA: 0,
					HORA: i/2,
					IMPUNTUALES: 0,
					REPRESADOS: 0,
					VISITAS: 0
				});
			}
			sw = true;
		}
		return variable;
	},
	// Reune los datos traidos de las diferentes fechas y realiza las operaciones de consolidacion.
	promediacion: function(CodPos){
		var datos = this.datos[CodPos];
		var datoP = [];
		var atencion;
		var visitas;
		var visitasTotal;

		var apertura = _.findWhere(p.apertura, {Cod_Pos: CodPos});
		
		if (typeof(apertura.ph_ase_total) != "number") {apertura.ph_ase_total = 0};		
		if (typeof(apertura.ph_ase_segturno) != "number") {apertura.ph_ase_segturno = 0};

		var abandono = $('#aba').val();
		if (datos.length > 1) {

			for (var j = 0; j < datos[0].length; j++) {
				
				//var hora = datos[0][j]["HORA"];
				datoP.push({HORA:  datos[0][j]["HORA"]});

				datoP[j]["VISITAS"] = datos[0][j]["VISITAS"]*0.5 + datos[1][j]["VISITAS"]*0.5;

				if (datoP[j]["VISITAS"] != 0) {
					atencion = datos[0][j]["ATENCION"]/60 + datos[1][j]["ATENCION"]/60;
					visitas = datos[0][j]["VISITAS"] + datos[1][j]["VISITAS"];
					datoP[j]["AHT"] = atencion/visitas;
				}else{
					datoP[j]["AHT"] = 0;
				}
				
				datoP[j]["REPRESAMIENTO"] = (datos[0][j]["ATENDIDOS"] != 0 ? datos[0][j]["REPRESADOS"]/datos[0][j]["ATENDIDOS"] : 0 )*0.5 + 
											(datos[1][j]["ATENDIDOS"] != 0 ? datos[1][j]["REPRESADOS"]/datos[1][j]["ATENDIDOS"] : 0 )*0.5 ;
				
				datoP[j]["AteSinRepresamiento"] = datoP[j]["VISITAS"] * (1-abandono);


				if(j == 0){
					datoP[j]["AteConRepresamiento"] = datoP[j]["AteSinRepresamiento"] * (1-datoP[j]["REPRESAMIENTO"]);
				}else{
					datoP[j]["AteConRepresamiento"] = (datoP[j-1]["AteSinRepresamiento"] * datoP[j-1]["REPRESAMIENTO"]) + datoP[j]["AteSinRepresamiento"] * (1-datoP[j]["REPRESAMIENTO"]);
				};

				datoP[j]["Asesores"] = function(){
					
					var hora = datoP[j]["HORA"];
					var AteConRepresamiento = datoP[j]["AteConRepresamiento"];
											
					return function(){
						//var primerTurno = parseInt($('#PrimerTurno').val());
						var primerTurno = apertura.ph_ase_total;
						var segundoTurno = apertura.ph_ase_segturno;

						var horaSegTurno = parseInt($('#HoraSegTurno').val());

						if (AteConRepresamiento > 0) {
							if (hora >= horaSegTurno) {
								return primerTurno + segundoTurno;
							}else{
								return primerTurno;
							}
						}else{
							return 0;
						}
					}();// quitar para tiempo real
				}();

				datoP[j]["ServiceLevel"] = function(){
					var Asesores = datoP[j]["Asesores"];
					var AteConRepresamiento = datoP[j]["AteConRepresamiento"];
					var AHT = datoP[j]["AHT"];
					return function(){
						return ServiceLevel( Asesores, AteConRepresamiento, AHT, 15);
					}();
				}();

			};

			this.datoP = [];
			this.datoP = datoP;

			
			visitasTotal = suma(datoP, "AteConRepresamiento");
			var aht = sumaProducto(datoP, "AteConRepresamiento", "AHT")/visitasTotal;
			var SL = sumaProducto(datoP, "AteConRepresamiento", "ServiceLevel")/visitasTotal;

			this.consolidado.push({
				VISITAS: visitasTotal,
				AHT: aht,
				SL: SL,
				CodPos: CodPos,
				Tienda: apertura.info_cde,
				Asesores: function(){
					var primerTurno = apertura.ph_ase_total;
					var segundoTurno = apertura.ph_ase_segturno;
					return primerTurno + "-" + segundoTurno;
				}()
			});
		}
	}
};

// Ejecuta multiples CDEs al tiempo
var p = {

	datosIPs: [],
	apertura: [],

	fetch: function(url, storage){
		var url = url;
		var puntero = this;
		console.log(this);

		$.ajax(url,{
			type: 'GET',
			dataType: 'json',
			success: function(result){
				puntero[storage] = result;
				puntero.loadIPs();
			}

		});
	},

	loadIPs: function () {
		var url = 'http://10.66.6.241:82/code-dev/Staff/getListaCodPos/COSTA';
		var puntero = this;
		console.log(this);
		$.ajax(url,{
			type: 'GET',
			dataType: 'json',
			success: function(result){

				puntero.datosIPs = result;
				console.log("Ip's cargadas");
				puntero.exe();
			}

		});
	},
	exe: function(){

		var datosIPs = this.datosIPs;
		for (var i = 0; i < datosIPs.length; i++) {
			
			resultado.numberDatos[datosIPs[i]['COD_POS']] = 0;
			resultado.datos[datosIPs[i]['COD_POS']] = [];
			resultado.validacion("fecha1", datosIPs[i]['COD_POS']);
			resultado.validacion("fecha2", datosIPs[i]['COD_POS']);
		}
	}

};

$(function(){
	console.log("ok my friends");

	$('#validacion').click(function(event){
		event.preventDefault();

		p.fetch("http://10.66.6.241:82/code-dev/gtr/getDatosApertura", "apertura");

		//p.loadIPs();
	});
});


</script>