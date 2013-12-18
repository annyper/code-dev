
<div class="panel panel-default panel-extra">
				<div class="panel-heading">
				    <h3 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
	         				 Actividad de los asesores <span></span>
	        			</a>
				    </h3>
				</div>
				<div id="collapseFour" class="panel-collapse collapse in">
				<div class="panel-body">
					
					<div id="container2" style="margin: 0 auto">
						<script>
                            $(function () {
                                $('#container2').highcharts({
                                    chart: {
                                        type: 'bar'
                                    },
                                    title: {
                                        text: 'Stacked bar chart'
                                    },
                                    xAxis: {
                                        categories: ['Asesor1', 'Asesor2', 'Asesor3', 'Asesor4', 'Asesor5', 'lalal']
                                    },
                                    yAxis: {
                                        min: 0,
                                        title: {
                                            text: 'Total fruit consumption'
                                        },
                                        labels: {
                                            enabled: false
                                        },
                                        gridLineWidth: 0
                                    },
                                    legend: {
                                        verticalAlign: 'top',
                                        backgroundColor: '#FFFFFF',
                                        reversed: true
                                    },
                                    plotOptions: {
                                        series: {
                                            stacking: 'percent'
                                        }
                                    },
                                        series: [{
                                        name: 'John',
                                        data: [5, 3, 4, 7, 2, 8]
                                    }, {
                                        name: 'Jane',
                                        data: [2, 2, 3, 2, 1, 7]
                                    }, {
                                        name: 'Joe',
                                        data: [3, 4, 4, 2, 5, 4]
                                    }, {
                                        name: 'John',
                                        data: [3, 0, 0, 0, 6]
                                    }]
                                });
                            });

						</script>
					</div>


				</div>
				</div>
			</div>