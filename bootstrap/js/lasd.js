// Ejecuta multiples CDEs al tiempo
var multiQuery = {
	// Cuando cargue el DOM
	//p.fetch("http://10.66.6.241:82/code-dev/gtr/getDatosApertura", "apertura");

	datosIPs: [],

	datosConsulta : {},

	consultaCDE: function (url, cod_pos) {
		url = url || '';
		if (url === '') {return};

		url = url + '/' + cod_pos

		var puntero = this;
		$.ajax(url,{
			type: 'GET',
			dataType: 'json',
			success: function(result){

				puntero.datosConsulta[cod_pos] = result;
				//puntero.exe();
			}

		});
	},
	exe: function(url){

		url = url || '';		
		if (url === '') {return};

		var datosIPs = this.datosIPs;
		for (var i = 0; i < datosIPs.length; i++) {			
			this.consultaCDE(url, datosIPs[i]['COD_POS']);
		}

	},
	loadIPs: function (regional, url) {
		regional = regional || '';
		url = url || '';

		var url = 'http://10.66.6.241:82/code-dev/Staff/getListaCodPos/' + regional;

		var puntero = this;
		$.ajax(url,{
			type: 'GET',
			dataType: 'json',
			success: function(result){

				puntero.datosIPs = result;
				console.log("Ip's cargadas");
				//puntero.exe(url);
			}

		});
	}

};


/*
** Al hacer clic sobre la entidades estas desapareco o aparece.
*/

$(function(){



//============================================================================
//============================ AJAX ==========================================
//============================================================================
	
	$('.rangeAjax').on('change', function(event){

		var enlace = $(this).attr('action');

		$.post(enlace, $(this).serialize()).success(function(data){

		});

	});

	// Para menú responsive
	$("#menu-toggle").click(function(e) {
	        e.preventDefault();
	        $("#wrapper").toggleClass("active");
	        $("#sidebar").toggleClass("desactive");
	});
//================================================================================

	// var enlaceLoad = $('.loadInstantaneo a').attr('href');
	// $('.loadInstantaneo').load(enlaceLoad);

	actualizar2('#estadoAsesores-titulo', '#estadoAsesores', 7000);
	actualizar('#clientesEspera-titulo', '#clientesEspera', 7000);
	actualizar('#dashboardEncabezado-titulo', '#dashboardEncabezado', 60000);
	//actualizar('#sinTurnoAcumulado-titulo', '#Lineadetiempo', 12000);
	actualizar('#sinTurnoAcumulado-titulo', '#sinTurnoAcumulado', 120000);
	actualizar('#AlmuerzosNoJustificados-titulo', '#AlmuerzosNoJustificados', 121000);
	actualizar('#LaborAdministrativaAcumulada-titulo', '#LaborAdministrativaAcumulada', 121000);
	actualizar('#BanoAcumulado-titulo', '#BanoAcumulado', 121000);

	actualizar('#EstaditicasNsPs-titulo', '#EstaditicasNsPs', 160000);

	// actualizacion auntomatica de el Chart de los asesores en el controlador analytics
	//actualizar('#actividadAsesoresAnalytics-titulo', '#actividadAsesoresAnalytics', 300000);

	function actualizar(idTitulo, idBody, tiempo){

		setInterval( function() 
    	{
    		var ipCifrada = $('.containerIP').attr('id');
    	    var enlace = $(idTitulo + ' a:eq(1)').attr('href') + '/' + ipCifrada;
       	    //console.log(enlace)
       	    //$(idTitulo + ' a span').html('<i class="font-color-blanco fa fa-refresh fa-spin"></i>');
    	    $(idBody).load(enlace);
    	    //$(idTitulo + ' a span').html('<i class="font-color-blanco fa fa-check"></i>')
    	}, tiempo);
	}

	function actualizar2(idTitulo, idBody, tiempo){

		setInterval( function() 
    	{
    		var ipCifrada = $('.containerIP').attr('id');
    	    var enlace = $(idTitulo + ' a:eq(2)').attr('href') + '/' + ipCifrada;
       	    //console.log(enlace)
       	    //$(idTitulo + ' a span').html('<i class="font-color-blanco fa fa-refresh fa-spin"></i>');
    	    $(idBody).load(enlace);
    	    //$(idTitulo + ' a span').html('<i class="font-color-blanco fa fa-check"></i>')
    	}, tiempo);
	}

	$('#btnActividadAsesores').on('click', function(e){
		e.preventDefault();
		//alert('hola');
		var url = $(this).attr('href');
		console.log(url);
		actualizarClick2('#actividadAsesores', url);

		actualizarClick('#actividadAsesores', url, 300000);

	});

	$('#btnActividadAsesoresAnalytics').on('click', function(e){
		e.preventDefault();
		//alert('hola');
		var url = $(this).attr('href');
		console.log(url);
		actualizarClick2('#actividadAsesoresAnalytics', url);

		actualizarClick('#actividadAsesoresAnalytics', url, 300000);

	});


	$('#btnVisitas').on('click', function(e){
		e.preventDefault();
		//alert('hola');
		var url = $(this).attr('href');
		console.log(url);
		actualizarClick2('#visitasAtendidos', url);
	});

	function actualizarClick(idBody, url, tiempo){

		setInterval( function() 
    	{
    		var ipCifrada = $('.containerIP').attr('id');
    	    var enlace = url + '/' + ipCifrada;
    	    console.log(enlace);
       	    
       	    //$(idBody).html('<i class="text-muted fa fa-spinner fa-spin" style="font-size: 9em"></i>');
    	    $(idBody).load(enlace);

    	}, tiempo);
	}

	function actualizarClick2(idBody, url){

    		var ipCifrada = $('.containerIP').attr('id');
    	    var enlace = url + '/' + ipCifrada;
    	    console.log(enlace);
       	    
       	    $(idBody).html('<i class="text-muted fa fa-spinner fa-spin" style="font-size: 9em"></i>');
    	    $(idBody).load(enlace);
    	    //$(idBody).html('<i class="text-muted fa fa-check"></i>')
	}

//========== F O R O ==================================================================

	$('.foroTitulo a').on('click', function() {
			//var id_enlace_foro = $(this).attr('id');
			var enlace_foro = $(this).attr('href');
			$('.cuerpoModalDelForo, #cuerpoModalDelForo').html('<i class="centrar-caja font-color-blanco fa fa-refresh fa-spin fa-4x text-success"></i>');
			$('#cuerpoModalDelForo').load(enlace_foro);
			$('.cuerpoModalDelForo').load(enlace_foro);

	});

	$('.ModalInfo a').on('click', function() {
			//var id_enlace_foro = $(this).attr('id');
			var enlace_foro = $(this).attr('href');
			$('.cuerpoModalDelForo, #cuerpoModalDelForo').html('<i class="centrar-caja font-color-blanco fa fa-refresh fa-spin fa-4x text-success"></i>');
			$('#cuerpoModalDelForo').load(enlace_foro);
			$('.cuerpoModalDelForo').load(enlace_foro);


	});

	    
    
    $('#AgregarCalificacion, .ActualizarCalificacion').on('click', function() {
            
        var enlace = $(this).attr('href');
        $('.modalNotas').html('<i class="icon-spinner icon-spin icon-5x spin-center"></i>');

        $('.modalNotas').load(enlace);

    });

    $('#myModalasd').on('hide', function () {
  		$('.modalNotas').html();
	})



//======== L O G I N ====================================================================

	var peticion = $('.main form').attr('action');

	$('.main form').on('submit',function(e){

		e.preventDefault();

		$.ajax({

			beforeSend: function(){
				// se ejuecuta antes de realizar la peticion
				$('.main form .btn').html('<i class="icon-spinner icon-spin icon-large icon-muted"></i>');
				
			},

			url: peticion,
			type: "POST",
			data: $('.main form').serialize(),

			success: function(resp){

				var obj = jQuery.parseJSON(resp);

				// console.log(obj["msj"])

				if (obj["estado"] == 1) {
					self.location = obj["msj"];
				}
				else if (obj["estado"] == 0){
					
					// $('#errorvalidation .alert').html(obj["msj"]);
					// $('#errorvalidation').removeClass('oculto');

					$('#errorvalidation2 .alert').html(obj["msj"]);
					$('#errorvalidation2').removeClass('oculto');
				}
			},

			error: function(jqXHR,estado,error){
				
				console.log(estado);
				console.log(error);
			},
			complete: function(jqXHR, estado){
				console.log(estado)
				$('.main form .btn').html('Enviar');
			},

			timeout: 10000,

		});

	});

	$(function() {
		$( "#datepickerActividadAsesor" ).datepicker({dateFormat: "yy-mm-dd"});
		$( "#datepickerCheckList1" ).datepicker({dateFormat: "yy-mm-dd"});
		$( "#datepickerCheckList2" ).datepicker({dateFormat: "yy-mm-dd"});

	});

	//========== F O R M U L A R I O S  ==================================================================
		$('form').filter('.formajax').on('submit', function(event) {

			event.preventDefault();

			var ran=Math.floor(Math.random()*1000000);

			var enlace = $(this).attr('action');
			console.log(enlace);
			console.log($(this).serialize());

			$(this).attr('id', ran);

			$.post(enlace, $(this).serialize(), function(data) {

				$('#'+ ran.toString() + ' div.alerta').html(data);

				console.log(data);

			});
			

		});

		$('form').on('change', '.inputajax', function(event){
			event.preventDefault();
			var hora = $(this).val();
			var form = $(this).closest('form');
			var el = $(this);
			var enlace = form.attr('action') + '/' + $(this).data('dia') + '/' + $(this).data('hora');

			var serializeForm = $(this).serialize();

			$.post(enlace, serializeForm, function(data) {
				//$('#checkListApertura').html(data);
				//console.log($(this));
				if (data == 1) {
					el.closest('td').addClass('has-success');
				};

			});

			console.log(enlace);

		});
		$('form').on('submit', '.inputajax', function(event){
			event.preventDefault();
			console.log('submit');
		});

		$('form.formAjaxClic').on('submit', function(e){

			e.preventDefault();
			var enlace = $(this).attr('action');
			var serializeForm = $(this).serialize();

			actualizarFormAjaxClick('#actividadAsesoresAnalytics', enlace, serializeForm);

		});


		$('form.formAjaxClicCheck').on('submit', function(e){

			e.preventDefault();
			var enlace = $(this).attr('action');
			var serializeForm = $(this).serialize();

			$('#checkListApertura').html('<i class="text-muted fa fa-spinner fa-spin" style="font-size: 9em"></i>');
			$.post(enlace, serializeForm, function(data) {
				$('#checkListApertura').html(data);
			});

			console.log('fin')

		});

		$('form').on('click', '.boton-borrar', function(event){
			event.preventDefault();
			var enlace = $(this).data('url');
			var form = $(this).closest('form');

			form.load(enlace);
			//console.log(enlace);
		});

		function actualizarFormAjaxClick(idBody, url, serializeForm){

	    		var ipCifrada = $('.containerIP').attr('id');
	    	    var enlace = url + '/' + ipCifrada;
	    	    console.log(enlace);
	       	    
	       	    $(idBody).html('<i class="text-muted fa fa-spinner fa-spin" style="font-size: 9em"></i>');
	    	    
	    	    $.post(enlace, serializeForm, function(data) {

					$(idBody).html(data);

				});


	    	    //$(idBody).html('<i class="text-muted fa fa-check"></i>')
		}


		//-------------------------------------------------------------------------------------
		//			JS en las vistas.
		//-------------------------------------------------------------------------------------
				var ipCifrada = $('.containerIP').attr('id');
				
				var enlaceLoad1 = $('#estadoAsesores-titulo a:eq(2)').attr('href')+ '/' + ipCifrada;
				 
				$('#estadoAsesores').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x text-success"></i></p>');
				//console.log(enlaceLoad1);
				if (ipCifrada != undefined ) {

					$.get( enlaceLoad1, function( data ) {
					  	if (data != 0) {
					  		$( "#estadoAsesores" ).html( data );
					  	} else if (data == 0) {
					  		$( "#estadoAsesores" ).text("ola k ase");
					  	};
					}).fail(function() {
						console.log('error')
					});


				};
				



				var enlaceLoadCliEspera = $('#clientesEspera-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
				 
				$('#clientesEspera').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x text-success"></i></p>');
				
				$('#clientesEspera').load(enlaceLoadCliEspera, function( response, status, xhr ) {
				  if ( status == "error" ) {
				    var msg = "Error  NOT found ";
				    $( "#clientesEspera" ).html( msg + xhr.status + " " + xhr.statusText );
				  }
				});

				function LoadCliEsperaChart(){
					var enlaceLoadCliEspera = $('#clientesEspera-titulo a:eq(2)').attr('href')+ '/' + ipCifrada;
				 			
					$('#estadoSala').load(enlaceLoadCliEspera, function( response, status, xhr ) {
					  if ( status == "error" ) {
					    var msg = "Error  NOT found ";
					    $( "#estadoSala" ).html( msg + xhr.status + " " + xhr.statusText );
					  }
					});
				};
				LoadCliEsperaChart();

				function Encabezado(){
					var enlaceLoad3 = $('#dashboardEncabezado-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
					//console.log(enlaceLoad3);
					$('#dashboardEncabezado').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x" style="color: #eee;"></i></p>');
				
					$('#dashboardEncabezado').load(enlaceLoad3);
				};
				Encabezado();

				function panelSinturno(){
					var enlaceLoad4 = $('#sinTurnoAcumulado-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
					//console.log(enlaceLoad4)
					//$('#Acumulado').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x text-danger"></i></p>');
					$('#sinTurnoAcumulado').load(enlaceLoad4);
				};
				panelSinturno();

				function panelAlmuerzo(){
					var enlaceLoad5 = $('#AlmuerzosNoJustificados-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
					$('#AlmuerzosNoJustificados').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x" style="color: #B98C48;"></i></p>');
					$('#AlmuerzosNoJustificados').load(enlaceLoad5);
				};				
				panelAlmuerzo();

				function panelLaborAdministrativaAcumulada(){
					var enlaceLoad6 = $('#LaborAdministrativaAcumulada-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
					$('#LaborAdministrativaAcumulada').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x" style="color: #B98C48;"></i></p>');
					$('#LaborAdministrativaAcumulada').load(enlaceLoad6);
				};
				panelLaborAdministrativaAcumulada();

				function panelBanoAcumulado(){
					var enlaceLoad7 = $('#BanoAcumulado-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
					$('#BanoAcumulado').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x" style="color: #B98C48;"></i></p>');
					$('#BanoAcumulado').load(enlaceLoad7);
				};
				panelBanoAcumulado();

				function panelEstaditicasNsPs(){
					var enlaceLoad8 = $('#EstaditicasNsPs-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
	                //console.log(enlaceLoad2);
	                $('#EstaditicasNsPs').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x" style="color: #B98C48;"></i></p>');
	                $('#EstaditicasNsPs').load(enlaceLoad8);
				};
				panelEstaditicasNsPs();

				$('#listaCDEbutton').on('click', function(e){
		    		e.preventDefault();
		    		var enlace = $('#listaCDE').val();
		    		
		    		enlace = "TIGO-" + enlace.replace(/ /g, "-");
		    		$('#listaCDE').val("");
		    		console.log(enlace)
		    		//self.location= enlace;
		    		window.open(enlace);

				});

		    	$('#listaCDEform').on('submit', function(e){
		    		e.preventDefault();
		    		var enlace = $('#listaCDE').val();
		    		
		    		enlace = "TIGO-" + enlace.replace(/ /g, "-");
		    		self.location= enlace;
		    	});
		//-------------------------------------------------------------------------------------
		//			JS en las vistas.
		//-------------------------------------------------------------------------------------
				var timerBusquedaCDE
				$('#busquedaCDE').on('keyup' ,function(){
						
						var valor = $(this).val().replace(" ", "-");
						var enlace = $('#hiddenURI').attr('value') + "/" + valor;

						clearInterval(timerBusquedaCDE);

						if (valor.length > 2) {
							
							//setTimeout(function(){
							console.log(enlace);
							$('#listaCDEs').load(enlace);
							//},500);
							
						};
					
				});


				$('#uriPais').on('click', function(e){
					e.preventDefault();

					clearInterval(timerBusquedaCDE);

					var enlace = $(this).attr('href');
					$('#listaCDEs').html('<p class="text-center"><i class="fa fa-spinner fa-spin" style="font-size: 9em; color:#ccc"></i></p>');
					$('#listaCDEs').load(enlace);
				});

				
				$('#busquedaCDEregional label input:radio').on('change', function(e){
					e.preventDefault();
					var region = $(this).attr('value');
					var enlace = $('#uriPais').attr('href') + '/' + region;

					clearInterval(timerBusquedaCDE);
				

					$('#listaCDEs').html('<p class="text-center"><i class="fa fa-spinner fa-spin" style="font-size: 9em; color:#ccc"></i></p>');
					$('#listaCDEs').load(enlace);

					timerBusquedaCDE = setInterval( function() 
					{
						$('#listaCDEs').load(enlace);
						console.log('actualizado00')
					}, 120000);
				});

			$('.tooltipShow').tooltip();
			$('.opop').popover('show')


			$('.oculatarToggle').on('click', function(event){
				event.preventDefault();
				$('.oculatarToggleTarget').toggleClass('hidden');

			});

			$('.oculatarToggle2').on('click', function(event){
				event.preventDefault();
				$('.oculatarToggleTarget2').toggleClass('hidden');

			});

			$( ".changeArea" ).on( "click", "button", function( event ) {
			    event.preventDefault();
			    var confirmar = confirm("¿Está seguro que desea cambiarlo de CDE?");

			    if (confirmar) {
			    	var Cod_posNuevo = $(this).parent().find("select").val();
			    	var enlace = $(this).data('url') + '/' + Cod_posNuevo;
			    	var form = $(this).closest('form');
			    	console.log(enlace);
			    	form.load(enlace);
			    }
			    
			});

});