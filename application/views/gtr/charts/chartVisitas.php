<div id="vistas" style="min-width: 310px; margin: 0 auto"></div>

<script>
	
	$(function () {
        $('#vistas').highcharts({
            chart: {
            },
            title: {
                text: 'Visitas y turnos puntuales'
            },
            xAxis: {
                categories: <?php echo json_encode($xAxisVisitas); ?>,
                title: {
                    text: 'HORA'
                },
            },
            yAxis: {
                title: {
                    text: ''
                },
                labels: {
                    formatter: function() {
                        return this.value
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
                type: 'spline',
                name: 'Visitas',
                data: <?php echo json_encode($Visitas); ?>,
                marker: {
                    symbol: 'circle',
                    radius: 4,
                    lineWidth: 4,
                    lineColor: null,
                    fillColor: 'white'
                },
                color: 'RGB(50, 137, 72)'
            },{
                type: 'spline',
                visible: false,
                name: 'Visitas acumulada',
                data: <?php echo json_encode($VisitasAcumulado); ?>,
                marker: {
                    symbol: 'circle',
                    radius: 4,
                    lineWidth: 4,
                    lineColor: null,
                    fillColor: 'white'
                },
                color: 'RGB(255, 194, 14)'
            },{
                type: 'spline',
                name: 'Puntuales',
                data: <?php echo json_encode($Puntuales); ?>,
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