<div class="panel panel-default col-md-8 col-md-offset-2" style="padding: 20px;">
    <?php echo form_open('gtr/insertInfoCde') ?>

        <div class="panel panel-default">
            <div class="panel-heading">Información del CDE</div>
            <div class="panel-body">
                                <label for="Cod_Pos">Codigo Pos</label>
                                <input required type="number" name="Cod_Pos" placeholder="Codigo Pos" class="form-control">
                                
                                <label for="version">Nombre de la Tienda</label>
                                <input type="text" name="nombreTienda" placeholder="Escribe el nombre de la tienda" class="form-control">
                    
                                <label for="version">Horario de la Tienda</label>
                                <input type="text" name="horario" placeholder="Escribe el horario de la tienda" class="form-control">

                                <label for="Cod_Pos">Regional</label>
                                <select class="form-control" required name="regional">
                                  <option value="">Selecciona Regional</option>
                                  <option value="Centro">Centro</option>
                                  <option value="Costa">Costa</option>
                                  <option value="Noroccidente">Noroccidente</option>
                                  <option value="Oriente">Oriente</option>
                                  <option value="Suroccidente">Suroccidente</option>
                                </select>

                                <label for="version">Versión del CDE</label>
                                <input type="text" name="version" placeholder="Versión del CDE" class="form-control">
                                
                                <label for="version">Tipo</label>
                                <input type="text" name="tipo" placeholder="Tipo" class="form-control">
                     
                                <label for="ciudad">Ciudad donde se encuentra</label>
                                <input type="text" name="ciudad" placeholder="Ciudad donde se encuentra" required class="form-control">
                                
                                <label for="direccion">Clasificacion</label>
                                <input type="text" list="clasificacion" name="clasificacion" placeholder="Clasificación del CDE" required class="form-control">
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
                                <input type="text" name="direccion" placeholder="Dirección del CDE" required class="form-control">
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Información del administrador
            </div>
            <div class="panel-body">

                    <div class="form-group">
                        <p><i class="glyphicon glyphicon-user"></i><strong> Administrador: </strong></p>
                        <div class="col-md-6">
                            <input type="text" name="nombreAdmin" placeholder="Nombre Administrador" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="apellidoAdmin" placeholder="Apellido Administrador" required class="form-control">
                        </div>

                        <p><strong>Número de identificación:</strong>
                            <input type="number" name="identificacionAdmin" placeholder="No. identificación Administrador" required class="form-control">
                        </p>
                        
                        <p><strong>Celular 1:</strong><small>Linea utilizada para los SMS de presidencia</small>
                            <input type="text" name="CelAdmin" placeholder="Celular Administrador" required class="form-control"></p>
                        <p><strong>Celular 2:</strong><input type="text" name="CelAdmin2" placeholder="Celular Administrador" class="form-control"></p>

                        <p><i class="glyphicon glyphicon-envelope"></i><strong> Correo:</strong> <input type="email" name="emailAdmin" placeholder="Correo Administrador" required class="form-control">
                        </p>
                    </div>

            </div>

        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Información del Coordinador
            </div>
            <div class="panel-body">

                    <div class="form-group">
                        <p><i class="glyphicon glyphicon-user"></i><strong> Coordinador: </strong></p>
                        <div class="col-md-6">
                            <input type="text" name="nombreCoor" placeholder="Nombre Coordinador" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="apellidoCoor" placeholder="Apellido Coordinador" required class="form-control">
                        </div>

                        <p><strong>Número de identificación:</strong>
                            <input type="number" name="identificacionCoor" placeholder="No. identificación Coordinador" required class="form-control">
                        </p>
                        
                        <p><strong>Celular 1:</strong><small>Linea utilizada para los SMS de presidencia</small>
                            <input type="text" name="CelCoor" placeholder="Celular Coordinador" required class="form-control"></p>
                        <p><strong>Celular 2:</strong><input type="text" name="CelCoor2" placeholder="Celular Coordinador" class="form-control"></p>

                        <p><i class="glyphicon glyphicon-envelope"></i><strong> Correo:</strong> <input type="email" name="emailCoor" placeholder="Correo Coordinador" required class="form-control">
                        </p>
                    </div>

            </div>

        </div>
        <div class="margen">
            <button class="btn btn-primary btn-lg" type="submit">Guardar</button>
        </div>

    </form>
</div>