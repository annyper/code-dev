<script>
	
	$(function () {
    $('#container1').highcharts({
        chart: {
            backgroundColor: 'rgba(252, 255, 197, 0)',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: true
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Browser market shares at a specific website, 2010'
        },
        tooltip: {
            pointFormat: 'Porcentaje: <b>{point.percentage:.1f}%</b><br> Clientes: {point.y}'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    distance: -40,
                    enabled: true,
                    color: 'white',
                    format: '{y}',
                    backgroundColor: 'rgba(100, 100, 100, 0.3)',
                    shadow: true,
                    borderRadius: 4,
                    borderWidth: 1,
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                ['Firefox',   4],
                ['IE',       12],
                {
                    name: 'Chrome',
                    y: 6,
                    sliced: true,
                    selected: true
                },
                ['Safari',    100],
                ['Opera',     10],
                ['Others',   10]
            ]
        }]
    });
});
    

</script>