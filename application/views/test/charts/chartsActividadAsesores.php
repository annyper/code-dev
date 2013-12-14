        <div id="testh" style="min-width: 310px; height: 150px; margin: 0 auto"></div>
                        <script>
                           $(function () {
    $('#testh').highcharts({
        chart: {
            type: 'bar',
            inverted: true,
            zoomType: 'y'
        },
        title: {
            text: '',
            enabled: false
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
            min: <?php echo $milisegundos ?>,
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
        series: <?php echo $dataJSON; ?>
    });
});
</script>