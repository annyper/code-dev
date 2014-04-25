<div class="container containerIP" id="<?php //echo $ipCifrada; ?>">
	<div class="row">

		<div class="col-md-3">
			<div id="container1" style="min-width: 100px; height: 400px; margin: 0 auto"></div>
			<?php $this->load->view('gtr/charts/chartCientesEsperaViewPie') ?>
		</div>

		<div class="col-md-3">
			<div id="container2" style="min-width: 100px; height: 400px; margin: 0 auto"></div>
			<h2>hola mundo</h2>
			<script>
	
	$(function () {
    $('#container2').highcharts({
        chart: {
            backgroundColor: 'rgba(252, 255, 197, 0)',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: true
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
		</div>

		<div class="col-md-3">
			<div id="container3" style="min-width: 100px; height: 400px; margin: 0 auto"></div>
			<h2>hola mundo</h2>
			<script>
	
	$(function () {
    $('#container3').highcharts({
        chart: {
            backgroundColor: 'rgba(252, 255, 197, 0)',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: true
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
		</div>

		<div class="col-md-3">
			<div id="container4" style="min-width: 100px; height: 400px; margin: 0 auto"></div>
			<h2>hola mundo</h2>
			<script>
	
	$(function () {
    $('#container4').highcharts({
        chart: {
            backgroundColor: 'rgba(252, 255, 197, 0)',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: true
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
		</div>

	</div>

		<div class="row">
		
		<div class="col-md-3">
			<div class="container98" style="min-width: 100px; height: 400px; margin: 0 auto"></div>
			<h2>hola mundo</h2>
		</div>

		<div class="col-md-3">
			<div class="container98" style="min-width: 100px; height: 400px; margin: 0 auto"></div>
			<h2>hola mundo</h2>
		</div>

		<div class="col-md-3">
			<div class="container98" style="min-width: 100px; height: 400px; margin: 0 auto"></div>
			<h2>hola mundo</h2>
		</div>

		<div class="col-md-3">
			<div class="container98" style="min-width: 100px; height: 400px; margin: 0 auto"></div>
			<h2>hola mundo</h2>
		</div>

	</div>
</div>