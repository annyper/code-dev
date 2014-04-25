$(function(){

$.fn.datepicker.defaults.format = "yyyy-mm-dd";
$.fn.datepicker.defaults.todayHighlight= true;

Highcharts.setOptions({
   lang: {
			months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
			shortMonths: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
			weekdays: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"]
   },
   colors: ['#5060BA', '#E61950', '#41C800', '#FFD700', '#4572A7', 
   '#AA4643', 
   '#89A54E', 
   '#80699B', 
   '#3D96AE', 
   '#DB843D']
});
bootstrap_alert = function() {}
bootstrap_alert.warning = function(divid,message,append) {
	if(append){
		$('#'+divid).append('<div class="alert alert-warning fade in">'
    	+'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
    	+'<span>'+message+'</span></div>');
	}else{
		$('#'+divid).html('<div class="alert alert-warning fade in">'
    	+'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
    	+'<span>'+message+'</span></div>');
	}    
}
bootstrap_alert.error = function(divid,message,append) {
	if(append){
		$('#'+divid).append('<div class="alert alert-error fade in">'
    	+'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
    	+'<span>'+message+'</span></div>');
	}else{
		$('#'+divid).html('<div class="alert alert-error fade in">'
    	+'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
    	+'<span>'+message+'</span></div>');
	}    
}
bootstrap_alert.success = function(divid,message,append) {
	if(append){
		$('#'+divid).append('<div class="alert alert-success fade in">'
    	+'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
    	+'<span>'+message+'</span></div>');
	}else{
		$('#'+divid).html('<div class="alert alert-success fade in">'
    	+'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
    	+'<span>'+message+'</span></div>');
	}    
}
bootstrap_alert.info = function(divid,message,append) {
	if(append){
		$('#'+divid).append('<div class="alert alert-info fade in">'
    	+'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
    	+'<span>'+message+'</span></div>');
	}else{
		$('#'+divid).html('<div class="alert alert-info fade in">'
    	+'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
    	+'<span>'+message+'</span></div>');
	}    
}
});