        <div id="legenda" style="min-width: 310px; height: 125px; margin: 0 auto"></div>
            <script>
                $(function () {
                    $('#legenda').highcharts({
                        chart: {
                            backgroundColor: 'rgba(252, 255, 197, 0)',
                            type: 'bar'
                        },
                        credits: {
                            enabled: false
                        },
                        title: {
                            text: '',
                            enabled: false
                        },
                        xAxis: {
                            categories: []
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: '',
                                enabled: false
                            },
                            labels: {
                                enabled: false
                            },
                            gridLineWidth: 0
                        },
                        legend: {
                            verticalAlign: 'top',
                            backgroundColor: '#FFFFFF',
                            reversed: true,
                            enabled: true
                        },
                        plotOptions: {
                            series: {
                                stacking: 'percent'
                            }
                        }, series: [{
                            name: 'Almuerzo',
                            color: 'rgb(137, 59, 195)'                
                        }, {
                            name: 'Sin turno',
                            color: 'rgb(202, 29, 15)'                
                        }, {
                            name: 'Labor Administrativa',
                            color: 'rgb(244, 121, 10)'                
                        }, {
                            name: 'Paso a Primera Línea',
                            color: 'rgb(255, 202, 40)'       
                        }, {
                            name: 'Break',
                            color: 'rgb(223, 237, 58)'       
                        }, {
                            name: 'Baño',
                            color: 'rgb(202, 152, 0)'       
                        }, {
                            name: 'Capacitación',
                            color: 'rgb(134, 101, 0)'       
                        }, {
                            name: 'Ocupado',
                            color: 'rgb(62, 86, 166)'       
                        }, {
                            name: 'Cierre Arranque',
                            color: 'rgb(140, 140, 140)'       
                        }, {
                            name: 'Fin de Jornada',
                            color: 'rgb(31, 43, 82)'       
                        }, {
                            name: 'Arranque Terminal',
                            color: 'rgb(124, 124, 124)'       
                        }, {
                            name: 'Desconectado',
                            color: 'rgb(108, 108, 108)'       
                        }, {
                            name: 'Llamando',
                            color: 'rgb(164, 213, 58)'       
                        }, {
                            name: 'Disponible',
                            color: 'rgb(67, 183, 96)'       
                        }]
                    });
                });
            </script>


        <?php foreach ($dataJSON as $key => $value): ?>
        <?php 
            $idChart = rand() . str_replace(".", "", microtime(true));
        ?>
        <div><h4><?php //echo $key;?></h4></div>
        <div id="<?php echo $idChart; ?>" style="min-width: 310px; width: 80%; height: 135px; margin: 0 auto"></div>
                        <script>
                           $(function () {
                                $('#<?php echo $idChart; ?>').highcharts({
                                    chart: {
                                        backgroundColor: 'rgba(252, 255, 255, 0)',
                                        type: 'bar',
                                        inverted: true,
                                        zoomType: 'y'
                                    },
                                    credits: {
                                        enabled: false
                                    },
                                    title: {
                                        text: '<?php echo ucwords(strtolower($key));?>',
                                        align: 'left'
                                    },
                                    xAxis: {
                                        startOnTick: false,
                                        categories: ['Asesor1', 'Asesor2', 'Asesor3', 'Asesor4', 'Asesor5'],
                                        labels: {
                                            enabled: false
                                        }
                                    },
                                    yAxis: {
                                        dateTimeLabelFormats: {
                                            day: '%H:%M',
                                            hour: '%H:%M',
                                            minute: '%H:%M',
                                            week: '%H:%M',
                                            month: '%H:%M',
                                            year: '%H:%M'
                                        },
                                        min: <?php echo 8*3600*1000;//$value['out'][0]; ?>,
                                        max: <?php echo $max ?>,
                                        type: 'datetime',
                                        minRange: 0,
                                        title: {
                                            text: 'Total fruit consumption',
                                            enabled: false
                                        },
                                        labels: {
                                            enabled: true
                                        }
                                    },
                                    tooltip: {
                                        formatter: function() {
                                            return '<b>'+ this.series.name +
                                                '</b>: <b>'+ (this.y/(1000*60)).toFixed(2) +'</b>' + 'min';
                                        }
                                    },
                                    legend: {
                                        enabled: false
                                    },
                                    plotOptions: {
                                        series: {
                                            stacking: 'normal'
                                        }
                                    },
                                    series: <?php echo $value['CadenaJson']; ?>
                                });
                            });
                        </script>
        <?php endforeach; ?>