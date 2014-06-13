<?php if (isset($tienda_admin) && !empty($tienda_admin)): ?>
<div class="panel panel-default col-md-8 col-md-offset-2" style="padding: 20px;">
    <?php //echo form_open('gtr/renderInfoCDE/' . $Cod_pos, array('class' => 'formajax')) ?>

        <div class="panel panel-default">
            <div class="panel-heading">Información del CDE</div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo form_open('gtr/sethorarioController/' . $Cod_pos . '/Lunes/Horario', array('class' => 'formajax')) ?>
                        
                        <label for="horario-text">Horario completo</label><div class="alerta"></div>
                        <div class="input-group">
                            <input type="text" name="hora-text" id="horario-text" value="<?php echo $tienda_admin['Horario']; ?>" placeholder="Horario completo" required class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </span>
                        </div>
                    </form>

                    <?php echo form_open('gtr/sethorarioController/' . $Cod_pos, array('class' => '')) ?>
                    <table class="table table-hover table-striped table-condensed table-bordered hidden">
                        <thead>
                            <tr>
                                <th>Dia</th>
                                <th>Apertura1</th>
                                <th>Cierre1</th>
                                <th>Apertura2</th>
                                <th>Cierre2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($horario as $key => $value): ?>
                            <tr>
                                <td>
                                    <?php echo $value['Dia'] ?></td>
                                <td>
                                    <div class="">
                                        <input data-date-format="hh:mm a" data-hora="Apertura1" data-dia="<?php echo $value['Dia'] ?>" type="text" name="hora-text" id="" value="<?php echo $value['Apertura1']; ?>" class="form-control inputajax datetimepicker1" style="cursor:pointer" >
                                    </div>
                                </td> 
                                <td>
                                    <div class="">
                                        <input data-hora="Cierre1" data-dia="<?php echo $value['Dia'] ?>" type="text" name="hora-text" id="" value="<?php echo $value['Cierre1']; ?>" class="form-control  inputajax datetimepicker1" style="cursor:pointer">
                                    </div>
                                    
                                </td> 
                                <td>
                                    <div class="">
                                        <input data-hora="Apertura2" data-dia="<?php echo $value['Dia'] ?>" type="text" name="hora-text" id="" value="<?php echo $value['Apertura2']; ?>" class="form-control  inputajax datetimepicker1" style="cursor:pointer">
                                    </div>
                                    
                                </td>
                                <td>
                                    <div class="">
                                        <input data-hora="Cierre2" data-dia="<?php echo $value['Dia'] ?>" type="text" name="hora-text" id="" value="<?php echo $value['Cierre2']; ?>" class="form-control  inputajax datetimepicker1" style="cursor:pointer">
                                    </div>
                                </td>                  
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </form>

                    <div class="panel panel-default margen">
                        <div class="panel-body">
                            <?php echo form_open('gtr/DataCDE/dataCDE/' . $Cod_pos, array('class' => 'formajax', 'data-form' => 'dataCDE')) ?>
                                <label for="Cod_Pos">Codigo Pos</label>
                                <input readonly required type="number" name="Cod_Pos" value="<?php echo $tienda_admin['Cod_Pos']; ?>" placeholder="Codigo Pos" class="form-control">
                                
                                <label for="Cod_Pos">Regional</label>
                                <select class="form-control" required name="regional" value="<?php echo $tienda_admin['Regional']; ?>">
                                  <option value="">Selecciona Regional</option>
                                  <option value="Centro" <?php if ($tienda_admin['Regional'] == 'Centro') {echo "selected";} ?>>Centro</option>
                                  <option value="Costa" <?php if ($tienda_admin['Regional'] == 'Costa') {echo "selected";} ?>>Costa</option>
                                  <option value="Noroccidente" <?php if ($tienda_admin['Regional'] == 'Noroccidente') {echo "selected";} ?>>Noroccidente</option>
                                  <option value="Oriente" <?php if ($tienda_admin['Regional'] == 'Oriente') {echo "selected";} ?>>Oriente</option>
                                  <option value="Suroccidente" <?php if ($tienda_admin['Regional'] == 'Suroccidente') {echo "selected";} ?>>Suroccidente</option>
                                </select>

                                <label for="version">Versión del CDE</label>
                                <input type="text" name="version" value="<?php echo $tienda_admin['Version']; ?>" placeholder="Versión del CDE" class="form-control">
                                
                                <label for="version">Tipo</label>
                                <input type="text" name="tipo" value="<?php echo $tienda_admin['Tipo']; ?>" placeholder="Tipo" class="form-control">
                     
                                <label for="ciudad">Ciudad donde se encuentra</label>
                                <input type="text" name="ciudad" value="<?php echo $tienda_admin['Ciudad']; ?>" placeholder="Ciudad donde se encuentra" required class="form-control">
                                
                                <label for="direccion">Clasificacion</label>
                                <input type="text" list="clasificacion" name="clasificacion" value="<?php echo $tienda_admin['ClasificacionCDE']; ?>" placeholder="Clasificación del CDE" required class="form-control">
                                <datalist id="clasificacion">
                                    <option value="Ancla">
                                    <option value="Business">
                                    <option value="Dealer">
                                    <option value="Estandar A">
                                    <option value="Estandar B">
                                    <option value="Flag Ship">
                                    <option value="Isla">
                                </datalist>

                                <label for="direccion">Dirección del CDE</label>
                                <input type="text" name="direccion" value="<?php echo $tienda_admin['Direccion']; ?>" placeholder="Dirección del CDE" required class="form-control">
                                <div class="margen">
                                    <button class="btn btn-primary" type="submit">Guardar</button>
                                </div>
                                <div class="alerta"></div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>



        <div class="panel panel-default">
            <div class="panel-heading">
                Información del administrador</div>
            <div class="panel-body">
                <?php echo form_open('gtr/DataCDE/dataAdmin/' . $Cod_pos, array('class' => 'formajax', 'data-form' => 'dataCDE')) ?>
                    <div class="form-group">
                        <p><i class="glyphicon glyphicon-user"></i><strong> Administrador: </strong></p>
                        <div class="col-md-6">
                            <input type="text" name="nombreAdmin" value="<?php echo $tienda_admin['Nombre']; ?>" placeholder="Nombre Administrador" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="apellidoAdmin" value="<?php echo $tienda_admin['Apellido']; ?>" placeholder="Apellido Administrador" required class="form-control">
                        </div>

                        <p><strong>Número de identificación:</strong>
                            <input type="number" name="identificacionAdmin" value="<?php echo $tienda_admin['Identificacion']; ?>" placeholder="No. identificación Administrador" required class="form-control">
                        </p>
                        
                        <p><strong>Celular 1:</strong><input type="text" name="CelAdmin" value="<?php echo $tienda_admin['Movil_1']; ?>" placeholder="Celular Administrador" required class="form-control"></p>
                        <p><strong>Celular 2:</strong><input type="text" name="CelAdmin2" value="<?php echo $tienda_admin['Movil_2']; ?>" placeholder="Celular Administrador" class="form-control"></p>

                        <p><i class="glyphicon glyphicon-envelope"></i><strong> Correo:</strong> <input type="email" name="emailAdmin" value="<?php echo $tienda_admin['Correo']; ?>" placeholder="Correo Administrador" required class="form-control">
                        </p>

                        <div class="hidden panel panel-danger">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                  Danger Zone
                                </a>
                              </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse">
                              <div class="panel-body">
                                Anim pariatur cliche reprehenderit, enim eiusou probably haven't heard of them accusamus labore sustainable VHS.
                              </div>
                            </div>
                        </div>

                        <div class="margen">
                            <button class="btn btn-primary" type="submit">Guardar</button>
                        </div>
                        <div class="alerta"></div>
                    </div>
                </form>
            </div>

        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">Información coordinadores</div>
                <div class="col-md-3 col-md-offset-9" style="padding: 10px;">
                    <a href="#" class="oculatarToggle"><i class="fa fa-plus"></i> Agregar Coordinador</a>
                </div>
            <div class="panel-body">
                            <form class="hidden oculatarToggleTarget" method="POST" action="<?php echo site_url('gtr/inserDAtaCDE/' . $Cod_pos); ?>">
                                <div class="panel panel-default" style="border: 1px solid #428bca;">
                                    <div class="panel-body">
                                        <div class="form-group">
                                        
                                            <p><i class="glyphicon glyphicon-user"></i><strong> Agregar Coordinador: </strong></p>

                                            <div class="col-md-6">
                                                <input type="text" name="nombreCor" placeholder="Nombre Coordinador" required class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="ApellidoCor" placeholder="Apellido Coordinador" required class="form-control">
                                            </div>

                                            <p><strong>Número de identificación:</strong>
                                                <input type="number" name="identificacion"  placeholder="No. identificación Coordinador" required class="form-control">
                                            </p>
                                            
                                            <p><strong>Celular 1:</strong>
                                                <input type="text" name="CelCor" placeholder="Celular Coordinador" required class="form-control">
                                            </p>
                                            <p><strong>Celular 2:</strong>
                                                <input type="text" name="CelCor2" placeholder="Celular Coordinador" class="form-control">
                                            </p>

                                            <p><i class="glyphicon glyphicon-envelope"></i><strong> Correo:</strong> <input type="email" 
                                                name="emailCor" placeholder="Correo Coordinador" required class="form-control">
                                            </p>

                                            <div class="margen">
                                                <button class="btn btn-primary" type="submit">Guardar</button>
                                            </div>
                                            <div class="alerta"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>



                <ul class="list-group">
                    <?php if (isset($coor) && !empty($coor)): ?>
                        <?php foreach ($coor as $key => $value): ?>

                            <?php echo form_open('gtr/DataCDE/dataCoor/' . $Cod_pos . '/' . $value['Identificacion'], array('class' => 'formajax', 'data-form' => 'dataCDE')) ?>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="form-group">

                                            <p><i class="glyphicon glyphicon-user"></i><strong> Coordinador: </strong></p>

                                            <div class="col-md-6">
                                                <input type="text" name="nombreCor<?php //echo $Identificacion; ?>" value="<?php echo $value['Nombre'] ?>" placeholder="Nombre Coordinador" required class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="ApellidoCor<?php //echo $Identificacion; ?>" value="<?php echo $value['Apellido'] ?>" placeholder="Apellido Coordinador" required class="form-control">
                                            </div>

                                            <p><strong>Número de identificación:</strong>
                                                <input type="number" name="identificacion<?php //echo $Identificacion; ?>" value="<?php echo $value['Identificacion']; ?>" placeholder="No. identificación Coordinador" required class="form-control">
                                            </p>
                                            
                                            <p><strong>Celular 1:</strong>
                                                <input type="text" name="CelCor<?php //echo $Identificacion; ?>" value="<?php echo $value['Movil_1']; ?>" placeholder="Celular Coordinador" required class="form-control">
                                            </p>
                                            <p><strong>Celular 2:</strong>
                                                <input type="text" name="CelCor2<?php //echo $Identificacion; ?>" value="<?php echo $value['Movil_2']; ?>" placeholder="Celular Coordinador" required class="form-control">
                                            </p>

                                            <p><i class="glyphicon glyphicon-envelope"></i><strong> Correo:</strong> <input type="email" 
                                                name="emailCor<?php //echo $Identificacion; ?>" value="<?php echo $value['Correo']; ?>" placeholder="Correo Coordinador" required class="form-control">
                                            </p>

                                            <div class="margen">
                                                <button class="btn btn-primary" type="submit">Guardar</button>
                                            </div>
                                            <div class="alerta"></div>

                                            <div class="panel panel-danger">
                                                <div class="panel-heading">
                                                  <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collap<?php echo $key; ?>">
                                                      Danger Zone
                                                    </a>
                                                  </h4>
                                                </div>
                                                <div id="collap<?php echo $key; ?>" class="panel-collapse collapse">
                                                  <div class="panel-body">
                                                    ¿Está seguro?, se eliminaran permanentemente los datos de este coordinador.
                                                    <button class="btn btn-danger boton-borrar" data-url="<?php echo site_url('gtr/deleteCoor/' . $value['id']); ?>" type="button" >Eliminar Coordinador</button>
                                                  </div>
                                                </div>
                                            </div>

                                            
                                        </div>
                                    </div>
                                </div>
                            </form>

                        <?php endforeach; ?>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
   <!--  </form> -->
</div>
<?php endif; ?>


<script>
$(function () {
    $("#horario-text").on('focus', function(){
        $(this).closest('.form-group').find("table").removeClass('hidden');
    });
    $('.datetimepicker1').datetimepicker({
        pickDate: false
    });
});
</script>