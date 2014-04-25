<div id="NS_PS" style="min-width: 310px; margin: 0 auto"></div>

<script>
	
	$(function () {
        $('#NS_PS').highcharts({
            chart: {
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Nivel y Percepción del servicio'
            },
            xAxis: {
                categories: <?php echo json_encode($xAxisNS); ?>,
                title: {
                    text: 'HORA'
                },
            },
            yAxis: {
	            max: 100,
                title: {
                    text: ''
                },
                labels: {
                    formatter: function() {
                        return this.value +'%'
                    }
                }
	        },
            tooltip: {
                crosshairs: true,
                shared: true,
                style: {
                    padding: 10,
                    fontSize: '16px'
                },
                backgroundColor: 'rgba(255, 255, 255, 0.95)'
            },
            plotOptions: {
                series: {
                    lineWidth: 4
                }
            },
            series: [{
                type: 'column',
                name: 'NS_HORA',
                data: <?php echo json_encode($seriesNS_HORA); ?>,
                color: 'RGB(89, 195, 114)'
            }, {
                type: 'column',
                name: 'PS_HORA',
                data: <?php echo json_encode($seriesPS_HORA); ?>,
                color: 'RGB(132, 149, 208)'
            }, {
                type: 'spline',
                name: 'NS',
                data: <?php echo json_encode($seriesNS); ?>,
                marker: {
                    symbol: 'circle',
                    radius: 4,
                	lineWidth: 4,
                    lineColor: null,
                	fillColor: 'white'
                },
                color: 'RGB(50, 137, 72)'
            }, {
                type: 'spline',
                name: 'PS',
                data: <?php echo json_encode($seriesPS); ?>,
                marker: {
                    symbol: 'circle',
                    radius: 4,
                	lineWidth: 4,
                    lineColor: null,
                	fillColor: 'white'
                },
                color: 'RGB(62, 86, 166)'
            }]
        });
    });
    

</script>