<?php if (isset($gtr) && count($gtr) > 0 ): ?>
	
	<?php if ($gtr['PS'] < 0.7):  ?>

		<div class="alert alert-danger" style="padding: 5px; margin-bottom: 10px;">	

	<?php elseif ($gtr['PS'] >= 0.7 && $gtr['PS'] < 0.8):  ?>

		<div class="alert alert-warning" style="padding: 5px; margin-bottom: 10px; background-color: rgba(255, 194, 14, 0.25); color: #A28048; border-color: rgba(255, 194, 14, 0.5);">	

	<?php elseif ($gtr['PS'] >= 0.8 && $gtr['PS'] <= 1):  ?>
		
		<div class="alert alert-success" style="padding: 5px; margin-bottom: 10px;">

	<?php endif; ?>

		<div class="row">
			
			<div class="col-md-2 col-xs-4 col-sm-2 fontSize3 text-center">
				<strong><?php echo round($gtr['SL']*100, 2); ?></strong><p class="fontSize0" style="margin: 0;">NS (%)</p>
			</div>

			<div class="col-md-2 col-xs-4 col-sm-2 fontSize3 text-center">
				<strong><?php echo round($gtr['PS']*100, 2);?></strong><p class="fontSize0" style="margin: 0;">PS (%)</p>	
			</div>

			<div class="col-md-2 col-xs-4 col-sm-2 fontSize3 text-center">
				<strong><?php echo round($gtr['PercepcionEsperada']*100, 2); ?></strong><p class="fontSize0" style="margin: 0;">PS esperada</p>	
			</div>

			<div class="col-md-2 col-xs-4 col-sm-2 fontSize3 text-center">
				<strong><?php echo $gtr['PUNTUALES']; ?></strong><p class="fontSize0" style="margin: 0;">Puntuales</p>	
			</div>

			<div class="col-md-2 col-xs-4 col-sm-2 fontSize3 text-center">
				<strong><?php echo $gtr['ATENDIDOS']; ?></strong><p class="fontSize0" style="margin: 0;">Atendidos</p>	
			</div>

			<div class="col-md-2 col-xs-4 col-sm-2 fontSize3 text-center">
				<strong><?php echo $gtr['VISITAS']; ?></strong><p class="fontSize0" style="margin: 0;">Visitas</p>	
			</div>
			
			<?php if (isset($gtr['AHT']) && isset($gtr['ASA'])): ?>
				<div class="col-md-2 col-xs-4 col-sm-2 fontSize3 text-center">
					<strong><?php echo $gtr['AHT']; ?></strong><p class="fontSize0" style="margin: 0;">AHT (min)</p>	
				</div>

				<div class="col-md-2 col-xs-4 col-sm-2 fontSize3 text-center">
					<strong><?php echo $gtr['ASA']; ?></strong><p class="fontSize0" style="margin: 0;">ASA (min)</p>	
				</div>
			<?php endif; ?>
		</div>

	</div>

<?php endif ?>