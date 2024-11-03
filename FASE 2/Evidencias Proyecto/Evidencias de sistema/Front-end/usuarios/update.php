<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/usuarios/update_usuario.php');
include('../app/controllers/roles/listado_de_roles.php');


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de usuarios</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card card-outline card-green">
                        <div class="card-header">
                            <h3 class="card-title">Actualizar usuario</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="../app/controllers/usuarios/update.php" method="post">
                                        <input type="text" name="id_usuario" value="<?php echo $id_usuario_get;?>" hidden>
                                        <div class="form-group">
                                            <label for="">Primer Nombre</label>
                                            <input type="text" name="p_nombre" class="form-control" value="<?php echo $p_nombre;?>" pattern="[a-zA-Z]+" placeholder="Escribir aquí el primer nombre del usuario" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Segundo Nombre</label>
                                            <input type="text" name="s_nombre" class="form-control" value="<?php echo $s_nombre;?>" pattern="[a-zA-Z]+" placeholder="Escribir aquí el segundo nombre del usuario">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Primer Apellido</label>
                                            <input type="text" name="p_apellido" class="form-control" value="<?php echo $p_apellido;?>" pattern="[a-zA-Z]+" placeholder="Escribir aquí el primer apellido del usuario" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Segundo Apellido</label>
                                            <input type="text" name="s_apellido" class="form-control" value="<?php echo $s_apellido;?>" pattern="[a-zA-Z]+" placeholder="Escribir aquí el segundo apellido del usuario">
                                        </div>
                                        <div class="form-group">
                                            <label for="">RUN</label>
                                            <input type="text" name="run" class="form-control" value="<?php echo $run;?>" pattern="[0-9]{6,8}-[0-9k-k]{1}" placeholder="Escribir aquí el RUN del usuario">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nacionalidad</label>
                                            <input type="text" name="nacionalidad" class="form-control" value="<?php echo $nacionalidad;?>" pattern="[a-zA-Z]+" placeholder="Escribir aquí la nacionalidad del usuario">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Dirección</label>
                                            <input type="text" name="direccion" class="form-control" value="<?php echo $direccion;?>" placeholder="Escribir aquí el número y calle del usuario">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Comuna</label>
                                            <input type="text" name="comuna" class="form-control" value="<?php echo $comuna;?>" pattern="[a-zA-Z]+" placeholder="Escribir aquí la comuna del usuario">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Sexo</label>
                                            <input type="text" name="sexo" class="form-control" value="<?php echo $sexo;?>" pattern="[m-mf-fo-oM-MF-FO-O]+" placeholder="Escribir aquí el sexo del usuario (M, F u O)">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Fecha de Nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" class="form-control" value="<?php echo $fecha_nacimiento;?>" placeholder="Ingresar aquí la fecha de nacimiento del usuario">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo $email;?>" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" placeholder="Escribir aquí el email del usuario" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Numero Telefonico</label>
                                            <input type="text" name="numero_telefonico" pattern="[0-9]{9}" class="form-control" value="<?php echo $numero_telefonico;?>" pattern="[0-9]{9}" placeholder="Escribir aquí el numero telefonico del usuario">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Rol</label>
                                            <select name="rol" id=""  class="form-control">
                                                <?php
                                                foreach ($roles_datos as $roles_dato) {
                                                    $rol_tabla = $roles_dato['rol'];
                                                    $id_rol = $roles_dato['id_rol'];?>
                                                    <option value="<?php echo $id_rol;?>"<?php if($rol_tabla == $rol) { ?> selected="selected" <?php } ?> >
                                                        <?php echo $rol_tabla;?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Contraseña</label>
                                            <input type="text" name="password_usuario" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Vuelva a Ingresar la Contraseña</label>
                                            <input type="text" name="password_repeat" class="form-control">
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../layout/mensajes.php');?>
<?php include('../layout/parte2.php');?>

