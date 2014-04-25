<?php if (isset($clientesEspera) && !empty($clientesEspera)): ?>
	

<?php foreach ($clientesEspera as $key => $value): ?>

						<div class="row well-white marcador-borde-verde bloque-top">
							<div class="col-sm-2 fontSize1_5">
								<?php echo $value['TURNO']; ?>
							</div>
							<div class="col-sm-5">

								<h5 class="media-heading text-primary ajaxLink">	
									<a >
										<?php echo $value['NOMBRETRANS']; ?>
									</a>
								</h5>
								
							</div>
							<div class="col-sm-2 fontSize1_5">
								<?php echo gmdate('H:i:s',$value['TSA']*60); ?>
							</div>
							<div class="col-sm-3 fontSize1_5">
								<?php echo strtoupper($value['NOMBRECLIENTE']); ?>
							</div>
						</div>
					<?php endforeach; ?>
<?php endif ?>