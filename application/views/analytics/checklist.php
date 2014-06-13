<?php if (isset($data) and !empty($data)): ?>

<div id="GraficoCheck" style="min-width: 10px; margin: 0 auto"></div>

<table class="table table-hover table-striped table-condensed table-bordered">
	<thead>
		<tr>
			<th>REGIONAL</th>
			<th>CDE</th>
			<th>IMPUNTUAL</th>
			<th>PUNTUAL</th>
			<th>NO ABRE</th>
			<th>PUNTUALIDAD</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data as $key => $value): ?>
		<tr>
			
			<td><?php echo $value['REGIONAL']; ?></td>
			<td>
				<a class="lanzadorDataModal" href="#" data-url="<?php echo site_url('cocinfo/checkListDeAperturaPorTienda/' . $datetimeInicio . '/' . $datetimeFin . '/' . str_replace(' ', '-', trim($value['TIENDA']))); ?>"
					data-toggle="modal" data-target="#myModal">
					<?php echo $value['TIENDA']; ?>
				</a>
			</td>
			<td><?php echo $value['Impuntual']; ?></td>
			<td><?php echo $value['Puntual']; ?></td>
			<td><?php echo $value['No_abre']; ?></td>
			<td><?php echo number_format($value['Puntualidad'], 2) . '%'; ?></td>
			
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Detalle del Checklist por CDE</h4>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>


	<script>
			
			$('.lanzadorDataModal').on('click', function(event) {

				event.preventDefault();
		            
		        var enlace = $(this).attr('data-url');
		        console.log(enlace);
		        $('.modal-body').html('<i class="icon-spinner icon-spin icon-5x spin-center"></i>');

		        $('.modal-body').load(enlace);

		    });

			$(function () {
	        $('#GraficoCheck').highcharts({
	            chart: {
	                type: 'column'
	            },
	            title: {
	                text: 'Puntualidad en los Check List de Apertura'
	            },
	            credits: {
  					enabled: false
  				},
	            xAxis: {
	                categories: [<?php foreach ($data as $key => $value) {
	                				echo "'" . $value['TIENDA'] . "',";
	                			} ?>],
	                labels: {
	                	style: {
	                     	color: '#888'
	                    },
	                    rotation: -60
	                }
            	
	            },
	            yAxis: {
	                min: 0,
	                max: 100,
	                title: {
	                    text: 'Puntualidad (%)'
	                }
	            },
	            tooltip: {
	                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
	                    '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
	                footerFormat: '</table>',
	                shared: true,
	                useHTML: true
	            },
	            plotOptions: {
	                column: {
	                    pointPadding: 0.2,
	                    borderWidth: 0
	                }
	            },
	            series: [{
	                name: 'Puntualidad',
	                data: [<?php foreach ($data as $key => $value) {
	                			echo $value['Puntualidad'] . ",";
	                		} ?> ]
	    
	            }]
	        });
	    });
	    

	</script>



<?php endif; ?>