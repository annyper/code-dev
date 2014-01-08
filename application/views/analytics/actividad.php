<div class="container containerIP" id="<?php echo $ipCifrada; ?>">
	
	<div class="row">
		<div class="col-md-4 col-md-offset-4" style="margin: 10px;">
			<?php $this->load->view('templates/datalist'); ?>
		</div>
	</div>

		<div class="row" id="actividadAsesores">
			<div class="col-md-12">
				<div class="panel panel-tigo-verde panel-extra">
					<div class="panel-heading">
						<div class="row">
							<div class="panel-title col-md-2" id="actividadAsesoresAnalytics-titulo">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			         				 Actividad de los asesores <span></span>
			        			</a>
			        			<a href="<?php echo site_url('test/chartActividadAsesores'); ?>"></a>	
			        		</div>
							
							<div class="col-md-2">
			        			<?php echo form_open('test/chartActividadAsesoresForm', array('class' => 'formAjaxClic form-inline')) ?>
			        				<div class="form-group">
			        					<div class="input-group">
	                                        <input type="text" name="fechaActividadAsesor" id="datepickerActividadAsesor" placeholder="Ingrese la fecha" required class="form-control">
	                                        <span class="input-group-btn">
										        <button class="btn btn-default" id="" type="submit">Generar</button>
										      </span>
	                                    </div>
	                                </div>
	                            </form>	   
		        			</div>	        				
	                        
                        </div>

					</div>
					<div id="collapseOne" class="panel-collapse collapse in">

						
						<div class="panel-body" id="">
							
							<div id="actividadAsesoresAnalytics" class="text-center">
								<div class=""><i class="fa fa-bar-chart-o fa-5x text-muted" style="font-size: 9em; "></i></div>

							</div>
							
						</div>
					</div>

				</div>
			</div>

</div>