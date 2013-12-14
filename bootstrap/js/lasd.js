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

//================================================================================

	// var enlaceLoad = $('.loadInstantaneo a').attr('href');
	// $('.loadInstantaneo').load(enlaceLoad);

	actualizar('#estadoAsesores-titulo', '#estadoAsesores', 12000);
	actualizar('#clientesEspera-titulo', '#clientesEspera', 12000);
	actualizar('#sinTurnoAcumulado-titulo', '#Lineadetiempo', 12000);
	actualizar2('#sinTurnoAcumulado-titulo', '#Acumulado', 120000);

	function actualizar(idTitulo, idBody, tiempo){

		setInterval( function() 
    	{
    		var ipCifrada = $('.containerIP').attr('id');
    	    var enlace = $(idTitulo + ' a:eq(1)').attr('href') + '/' + ipCifrada;
       	    console.log(enlace)
       	    $(idTitulo + ' a span').html('<i class="font-color-blanco fa fa-refresh fa-spin"></i>');
    	    $(idBody).load(enlace);
    	    $(idTitulo + ' a span').html('<i class="font-color-blanco fa fa-check"></i>')
    	}, tiempo);
	}

	function actualizar2(idTitulo, idBody, tiempo){

		setInterval( function() 
    	{
    		var ipCifrada = $('.containerIP').attr('id');
    	    var enlace = $(idTitulo + ' a:eq(2)').attr('href') + '/' + ipCifrada;
       	    console.log(enlace)
       	    $(idTitulo + ' a span').html('<i class="font-color-blanco fa fa-refresh fa-spin"></i>');
    	    $(idBody).load(enlace);
    	    $(idTitulo + ' a span').html('<i class="font-color-blanco fa fa-check"></i>')
    	}, tiempo);
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
				
				console.log(estado)
				console.log(error)
			},
			complete: function(jqXHR, estado){
				console.log(estado)
				$('.main form .btn').html('Enviar');
			},

			timeout: 10000,

		});

	});


	//========== F O R M U L A R I O S  ==================================================================
		$('form.formajax').on('submit', function(event) {

			event.preventDefault();

			var ran=Math.floor(Math.random()*1000000);

			var enlace = $(this).attr('action');

			$(this).attr('id', ran);

			$.post(enlace, $(this).serialize(), function(data) {

				//var obj = jQuery.parseJSON(data);

				$('#'+ ran.toString() + ' div.alerta').html(data);

				//$('form.formajax')[0].reset();

				console.log(data);

			});
			

		});

});