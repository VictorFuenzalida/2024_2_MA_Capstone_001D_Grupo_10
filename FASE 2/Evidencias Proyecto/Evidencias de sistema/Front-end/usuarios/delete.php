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
                    <div class="card card-outline card-red">
                        <div class="card-header">
                            <h3 class="card-title">¿Está seguro de eliminar este usuario?</h3>
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
                                    <form action="../app/controllers/usuarios/delete_usuario.php" method="post">
                                        <input type="text" name="id_usuario" value="<?php echo $id_usuario_get;?>" hidden>
                                        <div class="form-froup">
                                            <label for="">Primer Nombre</label>
                                            <input type="text" name="p_nombre" class="form-control" value="<?php echo $p_nombre;?>" disabled>
                                        </div>
                                        <div class="form-froup">
                                            <label for="">Primer Apellido</label>
                                            <input type="text" name="p_apellido" class="form-control" value="<?php echo $p_apellido;?>" disabled>
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
                                            <input type="text" name="rol" class="form-control" value="<?php echo $rol;?>" disabled>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <a href="index.php" class="btn btn-secondary">Volver</a>
                                            <button class="btn btn-danger"><i class="fa fa-trash"></i>Borrar</button>
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
