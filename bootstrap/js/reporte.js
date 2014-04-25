	function isInt(n) {
	   return n % 1 === 0;
	}

	function changeDate(id,startD,multi,minView,separador){
		$('#'+id).datepicker('remove');
		$('#'+id).val('');
		$('#'+id).datepicker({
	   	startDate: startD,
	    format: "yyyy-mm-dd",
	    multidate: multi,
	    multidateSeparator: separador,
	    clearBtn:true,  
	    language: "es",  
		minViewMode: minView
		});

	}

	function loadAjax(divid,url,parameters){
		//$('#'+divid).html('<i class="icon-spinner icon-spin icon-5x spin-center"></i>');
		var param="";
		var i;
		for (i = 0; i < parameters.length; ++i) {
		    param = param + "/" + parameters[i];
		}
		//console.log(url+param) ;
		
		$('#'+divid).load(url+param);
		
	}

	function loadAjaxIco(divid,loadClass,url,parameters){
		$('.'+loadClass).html('<div style="text-align:center;"><i class="fa fa-spinner fa-spin" style="font-size: 9em; color:#ccc;"></i></div>');
		var param="";
		var i;
		for (i = 0; i < parameters.length; ++i) {
		    param = param + "/" + parameters[i];
		}
		//console.log(url+param) ;
		
		$('#'+divid).load(url+param);
		
	}

	function postAjax(divid,loadClass,url,parameters){
		$('.'+loadClass).html('<div style="text-align:center;"><i class="fa fa-spinner fa-spin" style="font-size: 9em; color:#ccc;"></i></div>');
		var param="";
		var i;
		for (i = 0; i < parameters.length; ++i) {
		    param = param + "/" + parameters[i];
		}
		//console.log(url+param) ;
		
		txt=$("input").val();
		  $.post("demo_ajax_gethint.asp",{suggest:txt},function(result){
		    $("span").html(result);
		  });
		$('#'+divid).load(url+param);
		
	}
	

	function loadAjaxPost(divId,urls,campos){
		var xmlhttp;
		if (window.XMLHttpRequest) {xmlhttp=new XMLHttpRequest();}
		else{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
		xmlhttp.onreadystatechange=function(){
		  if (xmlhttp.readyState==4 && xmlhttp.status==200){ 		  
			$('#'+divId).html(xmlhttp.responseText);
		  }
		}
		
		xmlhttp.open("POST",urls,true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(campos);
	}


function graficarMatrizStack(typeChart,matriz,medidas,divid,titulo,und,invertida) {
    // On document ready, call visualize on the datatable.
	
	$(document).ready(function() {
	var chart;
	var table = null;
	table = matriz;
	options = {
		chart: {
			renderTo: divid,
			zoomType: 'x',
			type: typeChart
		},
		title: {
			text: titulo
		},
		xAxis: {
			maxZoom:1,
		},
		yAxis: {
			title: {
				text: medidas
			}
		},
		credits: {
			enabled: false
		},
		tooltip: {
			 //pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.y/point.stackTotal:.0f}%)<br/>',
             //shared: true,
			
			formatter: function() {
				var porcentaje =Math.round(this.y * 100 /this.point.stackTotal );
				return '<b>'+ this.x +'</b><br/>'+
					this.series.name +': '+ this.y +' ('+porcentaje+'%)<br/>'+
					'Total: '+ this.point.stackTotal;
			}
		},
		plotOptions: {
			column: {
				stacking: 'normal',
				dataLabels: {
					enabled: true,
					color: 'white'
				}
			}
		}
	};
	if(invertida){
		options.xAxis.categories = [];
		var i,j;
		options.series = [];
		
		for(i=0; i< table.length; i++){			
			for(j=0; j<table[i].length;j++){
				if(j == 0 && i != 0 && undefined != table[i][0]){
					options.xAxis.categories.push(table[i][0]);	
				}
				if (i == 0 && undefined != table[i][j]) { // get the name and init the series
					options.series[j - 1] = {
						name: table[i][j],
						data: []
					};
				}else  {
					if(undefined != table[i][j] && table[i][j] != ''){ // add values
					options.series[j - 1].data.push(parseFloat(table[i][j]));
					}else{
					options.series[j - 1].data.push(null);
					}
				}
			}
		}
	}else{
		options.xAxis.categories = [];
		var i;
		if(table.length > 0){	
			for( i=1;i<table[0].length ;i++){
				options.xAxis.categories.push(table[0][i]);	
			}
		}
		
		// the data series
		options.series = [];
		
		for(i=1; i< table.length; i++){			
			for(j=0; j<table[i].length;j++){
				if (j == 0) { // get the name and init the series
					options.series[i - 1] = {
						name: table[i][j],
						data: []
					};
				} else { // add values
					options.series[i - 1].data.push(parseFloat(table[i][j]));
				}
			}
		}
	}
		
		chart = new Highcharts.Chart(options);
    });
    
}

function graficarMatriz(typeChart,matriz,medidas,divid,titulo,und) {
    // On document ready, call visualize on the datatable.
	
	$(document).ready(function() {
var chart;
	var table = null;
	table = matriz;
	options = {
		chart: {
			renderTo: divid,
			zoomType: 'x',
			type: typeChart
		},
		title: {
			text: titulo
		},
		xAxis: {
			maxZoom:1,
		},
		yAxis: {
			title: {
				text: medidas
			}
		},
		credits: {
			enabled: false
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.series.name +'</b><br/>'+
					this.y + und + ' ' + this.x.toLowerCase();
			}
		}
	};
	 options.xAxis.categories = [];
		var i;
		if(table.length > 0){	
			for( i=1;i<table[0].length ;i++){
				options.xAxis.categories.push(table[0][i]);	
			}
		}
		
		// the data series
		options.series = [];
		
		for(i=1; i< table.length; i++){			
			for(j=0; j<table[i].length;j++){
				if (j == 0) { // get the name and init the series
					options.series[i - 1] = {
						name: table[i][j],
						data: []
					};
				} else { // add values
					options.series[i - 1].data.push(parseFloat(table[i][j]));
				}
			}
		}
		
		chart = new Highcharts.Chart(options);
		   
    });
    
}

function graficarMatrizRev(typeChart,matriz,medidas,divid,titulo,und) {
    // On document ready, call visualize on the datatable.
	
	$(document).ready(function() {
	var chart;
	var table = null;
	table = matriz;
	options = {
		chart: {
			renderTo: divid,
			zoomType: 'x',
			type: typeChart
		},
		title: {
			text: titulo
		},
		xAxis: {
			maxZoom:1
		},
		yAxis: {
			title: {
				text: medidas
			}
		},
		credits: {
			enabled: false
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.series.name +'</b><br/>'+
					this.y + und + ' ' + this.x.toLowerCase();
			}
		}
	};
	 options.xAxis.categories = [];
		var i,j;
		options.series = [];
		
		for(i=0; i< table.length; i++){			
			for(j=0; j<table[i].length;j++){
				if(j == 0 && i != 0 && undefined != table[i][0]){
					options.xAxis.categories.push(table[i][0]);	
				}
				if (i == 0 && undefined != table[i][j]) { // get the name and init the series
					options.series[j - 1] = {
						name: table[i][j],
						data: []
					};
				}else  {
					if(undefined != table[i][j] && table[i][j] != ''){ // add values
					options.series[j - 1].data.push(parseFloat(table[i][j]));
					}else{
					options.series[j - 1].data.push(null);
					}
				}
			}
		}
		
		chart = new Highcharts.Chart(options);
		   
    });
    
}

function graficarMatrizRevDoble(typeChart1,typeChart2,medidas1,medidas2,und1,und2,limite,matriz,divid,titulo,rotar) {
    // On document ready, call visualize on the datatable.
	
	$(document).ready(function() {
	var chart;
	var table = null;
	table = matriz;
	options = {
		chart: {
			renderTo: divid,
			zoomType: 'x'
		},
		title: {
			text: titulo
		},
		xAxis: {
			maxZoom:1
		},
		yAxis: [{ // Primary yAxis
                min: 0,
				labels: {
                    formatter: function() {
                        return this.value +und1;
                    },
                    style: {
                        color: '#89A54E'
                    }
                },
                title: {
                    text: medidas1,
                    style: {
                        color: '#89A54E'
                    }
                },
                opposite: true
    
            }, { // Secondary yAxis
                gridLineWidth: 0,
                title: {
                    text: medidas2,
                    style: {
                        color: '#4572A7'
                    }
                },
                labels: {
                    formatter: function() {
                        return this.value +und2;
                    },
                    style: {
                        color: '#4572A7'
                    }
                }
    
            }],
		credits: {
			enabled: false
		},
		tooltip: {
                shared: true
		}
	};
	 options.xAxis.categories = [];
	 if(rotar){
	 	options.xAxis.labels=  {
				rotation: -30,
				align: 'right'
				};
	 }
		var i,j;
		options.series = [];
		
		for(i=0; i< table.length; i++){			
			for(j=0; j<table[i].length;j++){
				if(j == 0 && i != 0 && undefined != table[i][0]){
					options.xAxis.categories.push(table[i][0]);	
				}
				if (i == 0 && undefined != table[i][j]) { // get the name and init the series
					if(j<=limite){
						options.series[j - 1] = {
							name: table[i][j],
							data: [],						
							yAxis: 0,
							type: typeChart1,
							tooltip: {
								valueSuffix: und1
							}
						};
					}else{
						options.series[j - 1] = {
							name: table[i][j],
							data: [],						
							yAxis: 1,
							type: typeChart2,
							tooltip: {
								valueSuffix: und2
							}
						};

					}
				}else {
					if(undefined != table[i][j] && table[i][j] != ''){ // add values
					options.series[j - 1].data.push(parseFloat(table[i][j]));
					}else{
					options.series[j - 1].data.push(null);
					}
				}
			}
		}
		
		chart = new Highcharts.Chart(options);
		   
    });
    
}

function graficarMatriz2(typeChart1,typeChart2,limite,matriz,medidas,divid,titulo,und) {
    // On document ready, call visualize on the datatable.
	$(document).ready(function() {
	var chart;
	var table = null;
	table = matriz;
	options = {
		chart: {
			renderTo: divid
		},
		title: {
			text: titulo
		},
		xAxis: {
			maxZoom:1
		},
		yAxis: {
                title: {
                    text: medidas
                },
                labels: {
                    formatter: function() {
                        return this.value + und;
                    },
                    style: {
                        color: '#4572A7'
                    }
                }
		},
		credits: {
			enabled: false
		},
		tooltip: {
                shared: true
		}
	};
	 options.xAxis.categories = new Array();
		var i,j;
		options.series = new Array();
		
		for(i=0; i< table.length; i++){			
			for(j=0; j<table[i].length;j++){
				if(j == 0 && i != 0 && undefined != table[i][0]){
					options.xAxis.categories.push(table[i][0]);	
				}
				if (i == 0 && undefined != table[i][j]) { // get the name and init the series
					if(j<=limite){
						options.series[j - 1] = {
							name: table[i][j],
							data: [],
							type: typeChart1,
							tooltip: {
								valueSuffix: und
							}
						};
					}else{
						options.series[j - 1] = {
							name: table[i][j],
							data: [],
							type: typeChart2,
							tooltip: {
								valueSuffix: und
							}
						};

					}
				}else{ 
					if(undefined != table[i][j] && table[i][j] != ''){ // add values
					options.series[j - 1].data.push(parseFloat(table[i][j]));
					}else{
					options.series[j - 1].data.push(null);
					}
				}
			}
		}
		if(options.series.length > 0){options.series[0].color='#41C800';}
		if(options.series.length > 1){options.series[1].color='#5060BA';}
		if(options.series.length > 2){options.series[2].color='#E61950';}
		if(options.series.length > 3){options.series[3].color='#FFD700';}
		if(options.series.length > 4){options.series[4].color='#41C800';}
		
		chart = new Highcharts.Chart(options);
		   
    });
	
}

function graficarMatrizFechaX(typeChart,matriz,medidas,divid,titulo,und,formatoFecha) {
    // spline
	
	$(document).ready(function() {
	var chart;
	var table = null;
	table = matriz;
	options = {
		chart: {
			renderTo: divid,
			zoomType: 'x',
			type: typeChart
		},
		title: {
			text: titulo
		},
		xAxis: {
			//maxZoom: 4 * 24 * 3600000,
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
				day: '%b%d',
				week: '%b%d',
				month: '%B',
				year: '%Y'
			}
		},
		yAxis: {
			title: {
				text: medidas
			}			
		},
		credits: {
			enabled: false
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.series.name +'</b><br/>'+
					this.y + und + ' el ' + Highcharts.dateFormat('%Y-%m-%d', this.x);
			}
		},
		plotOptions: {
			column: {				
				dataLabels: {
					enabled: true,					
					formatter: function() {
						return '<b>'+Highcharts.dateFormat(formatoFecha, this.x)+'</b>' 
						+'<br/>'
						+this.y + und ;
					},
					color: 'black'
				} 
			}
		}
	};
		var i;
		var serie = "";		
		// the data series
		options.series = [];
		var serieid =0;
		for(i=0; i< table.length; i++){			
			for(j=0; j<2;j++){
				if (j == 0) { // get the name and init the series
					if (i==0){
						serie = table[0][0];
						options.series[serieid] = {
							name: table[i][j],
							data: []
						};
					}else if(serie!=table[i][j]){
						serieid=serieid+1;
						serie=table[i][j];
						options.series[serieid] = {
							name: table[i][j],
							data: []
						};						
					}
				} else { // add values
					
						options.series[serieid].data.push([Date.UTC(
								parseInt(table[i][1].substring(0,4)),  
								parseInt(table[i][1].substring(5,7))-1, 
								parseInt(table[i][1].substring(8,10))
								), parseFloat(table[i][2])]);
					
					
				}
			}
		}
		
		chart = new Highcharts.Chart(options);
		   
    });
    
}

function graficarMatrizFechaStack(typeChart,matriz,medidas,divid,titulo,und,formatoFecha) {
    
	$(document).ready(function() {
	var chart;
	var table = null;
	table = matriz;
	options = {
		chart: {
			renderTo: divid,
			zoomType: 'x',
			type: typeChart
		},
		title: {
			text: titulo
		},
		xAxis: {
			//maxZoom: 4 * 24 * 3600000,
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
				day: '%b%d',
				week: '%b%d',
				month: '%B',
				year: '%Y'
			}
		},
		yAxis: {
			title: {
				text: medidas
			},
			stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: 'black'
                }
            }			
		},
		credits: {
			enabled: false
		},
		tooltip: {			
            formatter: function() {
            	var s = '<b>'+ Highcharts.dateFormat(formatoFecha, this.x) +'</b>',
                    total = 0;
                
                $.each(this.points, function(i, point) {
                    total += point.y;
                });
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+point.series.color+'">'+point.series.name+'</span>:'+
                        point.y + und;
                    s += '(' + Highcharts.numberFormat(point.y*100/total) + '%)';                    	
                    
                });                              
                
                s += '<br/><b>Total:</b> '+total+ und;
                
                return s;	
			},
			shared: true
			
		},
		plotOptions: {
			column: {
				stacking: 'normal',
				dataLabels: {
					enabled: true,
					color: 'white',
					formatter: function() {
	                    if (this.y == 0) {
	                        return null;
	                    } else {
	                        return this.y;
	                    }
	                }
				}
			}
		}
		
	};
		var i;
		var serie = "";		
		// the data series
		options.series = [];
		var serieid =0;
		for(i=0; i< table.length; i++){			
			for(j=0; j<2;j++){
				if (j == 0) { // get the name and init the series
					if (i==0){
						serie = table[0][0];
						options.series[serieid] = {
							name: table[i][j],
							data: []
						};
					}else if(serie!=table[i][j]){
						serieid=serieid+1;
						serie=table[i][j];
						options.series[serieid] = {
							name: table[i][j],
							data: []
						};						
					}
				} else { // add values
					
						options.series[serieid].data.push([Date.UTC(
								parseInt(table[i][1].substring(0,4)),  
								parseInt(table[i][1].substring(5,7))-1, 
								parseInt(table[i][1].substring(8,10))
								), parseFloat(table[i][2])]);
					
				}
			}
		}

		chart = new Highcharts.Chart(options);
		   
    });
    
}
