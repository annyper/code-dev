s<div class="container containerIP" id="<?php echo $ipCifrada; ?>" style="width: 95%;">
	
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
							<div class="panel-title col-md-3" id="actividadAsesoresAnalytics-titulo">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			         				 Actividad de los asesores <span></span>
			        			</a>
			        			<a href="<?php echo site_url('gtr/chartActividadAsesores'); ?>"></a>	
			        		</div>
							
							<div class="col-md-3">
			        			<?php echo form_open('gtr/chartActividadAsesoresForm', array('class' => 'formAjaxClic form-inline')) ?>
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

		<div class="row" id="checkListAperturaPanel">
			<div class="col-md-12">
				<div class="panel panel-tigo-azul panel-extra">
					<div class="panel-heading">
						<div class="row">
							<div class="panel-title col-md-2" id="checkListApertura-titulo">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseChecklist">
			         				 Check list de apertura <span></span>
			        			</a>
			        			<a href="<?php echo site_url('gtr/chartActividadAsesores'); ?>"></a>	
			        		</div>
							
							<div class="col-md-9">
			        			<?php echo form_open('cocinfo/checkListDeApertura', array('class' => 'formAjaxClicCheck form-inline')) ?>
        				
			          				<div class="form-group">	
	                                    <input type="text" name="fechaInicioCheck1" id="datepickerCheckList1" placeholder="Fecha de  inicio" required class="form-control">
	                                </div>
	                                <div class="form-group">
	                                        <input type="text" name="fechaInicioCheck2" id="datepickerCheckList2" placeholder="Fecha fin" required class="form-control">
	                                </div>

	                                <div class="checkbox">
								        <label>
								          <input type="checkbox" name="checkCosta" value="Costa"> Costa
								        </label>
								        <label>
								          <input type="checkbox" name="checkCentro" value="Centro"> Centro
								        </label>
								        <label>
								          <input type="checkbox" name="checkNoroccidente" value="Noroccidente"> Noroccidente
								        </label>
								        <label>
								          <input type="checkbox" name="checkSuroccidente" value="Suroccidente"> Suroccidente
								        </label>
								        <label>
								          <input type="checkbox" name="checkOriente" value="Oriente"> Oriente
								        </label>
								      </div>
	                                       
										<button class="btn btn-default" id="" type="submit">Generar</button>
									      
	                           
	                            </form>	   
		        			</div>	        				
	                        
                        </div>

					</div>
					<div id="collapseChecklist" class="panel-collapse collapse in">

						
						<div class="panel-body" id="">
							
							<div id="checkListApertura" class="text-center">
								<div class=""><i class="fa fa-bar-chart-o fa-5x text-muted" style="font-size: 9em; "></i></div>

							</div>
							
						</div>
					</div>

				</div>
			</div>
		</div>
</div>