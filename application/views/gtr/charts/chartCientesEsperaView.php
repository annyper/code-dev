								<script>
		
								$(function () {

									var ipCifrada = $('.containerIP').attr('id');
									var enlaceLoad4 = $('#clientesEspera-titulo a:eq(2)').attr('href')+ '/' + ipCifrada;
									//console.log(enlaceLoad4);
									var options = {
									    chart: {
							                type: 'bar'
							            },
							            credits: {
  											enabled: false
  										},
							            title: {
							                text: ''
							            },
							            tooltip: {
							                borderColor: 'black',
							                padding: 0,
							                borderWidth: 1,
							            },
							            xAxis: {
							                categories: ['.', ''],
							                labels: {
							                    enabled: false
							                }
							            },
							            yAxis: {
							                min: 0,
							                title: {
							                    text: ''
							                },
							                labels: {
							                    enabled: false
							                },
							                gridLineWidth: 0
							            },
							            legend: {
							            	verticalAlign: 'top',
							                backgroundColor: '#fff',
							                reversed: true
							            },
							            plotOptions: {

							                series: {
							                	animation: false,
							                    stacking: 'percent',
							                    dataLabels: {
							                        enabled: true,
							                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
							                    }
							                }

							            },
							            series: <?php echo $jsonCodificado; ?>

									};

									$("#estadoSala").highcharts(options);

							    });
							</script>