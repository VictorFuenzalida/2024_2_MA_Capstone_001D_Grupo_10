<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/usuarios/show_usuario.php');


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
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Usuario registrado</h3>
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
                                    <form action="../app/controllers/usuarios/create.php" method="post">
                                        <div class="form-froup">
                                            <label for="">Primer Nombre</label>
                                            <input type="text" name="p_nombre" class="form-control" value="<?php echo $p_nombre;?>" disabled>
                                        </div>
                                        <div class="form-froup">
                                            <label for="">Segundo Nombre</label>
                                            <input type="text" name="s_nombre" class="form-control" value="<?php echo $s_nombre;?>" disabled>
                                        </div>
                                        <div class="form-froup">
                                            <label for="">Primer Apellido</label>
                                            <input type="text" name="p_apellido" class="form-control" value="<?php echo $p_apellido;?>" disabled>
                                        </div>
                                        <div class="form-froup">
                                            <label for="">Segundo Apellido</label>
                                            <input type="text" name="s_apellido" class="form-control" value="<?php echo $s_apellido;?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="">RUN</label>
                                            <input type="text" name="run" class="form-control" value="<?php echo $run;?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nacionalidad</label>
                                            <input type="text" name="nacionalidad" class="form-control" value="<?php echo $nacionalidad;?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Dirección</label>
                                            <input type="text" name="direccion" class="form-control" value="<?php echo $direccion;?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Comuna</label>
                                            <input type="text" name="comuna" class="form-control" value="<?php echo $comuna;?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Sexo</label>
                                            <input type="text" name="sexo" class="form-control" value="<?php echo $sexo;?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Fecha de Nacimiento</label>
                                            <input type="text" name="fecha_nacimiento" class="form-control" value="<?php echo $fecha_nacimiento;?>" disabled>
                                        </div>
                                        <div class="form-froup">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo $email;?>" disabled>
                                        </div>
                                        <div class="form-froup">
                                            <label for="">numero_telefonico</label>
                                            <input type="text" name="numero_telefonico" class="form-control" value="<?php echo $numero_telefonico;?>" disabled>
                                        </div>
                                        <div class="form-froup">
                                            <label for="">Rol</label>
                                            <input type="text" name="numero_telefonico" class="form-control" value="<?php echo $rol;?>" disabled>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <a href="index.php" class="btn btn-secondary">Volver</a>
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

<?php include('../layout/parte2.php');?>
