<?php //echo "<pre>"; print_r($clientesEspera); echo "</pre>"; ?> 
<?php foreach ($clientesEspera as $key => $value): ?>

						<div class="row well-white marcador-borde-verde bloque-top">
							<div class="col-sm-2 fontSize1_5">
								<?php echo $value['TUR_SDSTRTURNO']; ?>
							</div>
							<div class="col-sm-5">

								<h5 class="media-heading text-primary ajaxLink">	
									<a >
										<?php echo $value['SER_SDSTRNOMBRE']; ?>
									</a>
								</h5>
								
							</div>
							<div class="col-sm-2 fontSize1_5">
								<?php echo gmdate('H:i:s',$value['TSA']*60); ?>
							</div>
							<div class="col-sm-3 fontSize1_5">
								<?php echo $value['TUR_SDSTRNOMBRECLIENTE']; ?>
							</div>
						</div>
					<?php endforeach; ?>