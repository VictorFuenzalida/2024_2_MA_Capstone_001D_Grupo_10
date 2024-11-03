<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/productos/cargar_producto.php');


?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Información del producto: <?php echo $nombre;?></h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-blue">
                            <div class="card-header">
                                <h3 class="card-title">Datos del productos </h3>
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

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for=""> Código:</label>
                                                                <input type="text" class="form-control"
                                                                       value="<?php echo $codigo;?>" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for=""> Categoría:</label>
                                                                <div style="display: flex ">
                                                                    <input type="text" class="form-control" value="<?php echo $categoria;?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for=""> Producto:</label>
                                                                <input type="text" name="nombre" value="<?php echo $nombre;?>" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for=""> Marca:</label>
                                                                <input type="text" name="marca" value="<?php echo $marca;?>" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Usuario:</label>
                                                            <input type="text" class="form-control" value="<?php echo $email;?>" disabled>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for=""> Descripción:</label>
                                                                <textarea name="descripcion" id="" cols="30" rows="2"  class="form-control" disabled><?php echo $descripcion;?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for=""> Stock:</label>
                                                                <input type="number" name="stock" value="<?php echo $stock;?>" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for=""> Stock mínimo:</label>
                                                                <input type="number" name="stock_minimo" value="<?php echo $stock_minimo;?>" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for=""> Stock máximo:</label>
                                                                <input type="number" name="stock_maximo" value="<?php echo $stock_maximo;?>" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for=""> Precio compra:</label>
                                                                <input type="number" name="precio_compra" value="<?php echo $precio_compra;?>" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for=""> Precio venta:</label>
                                                                <input type="number" name="precio_venta" value="<?php echo $precio_venta;?>" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for=""> Fecha ingreso:</label>
                                                                <input type="date" name="fecha_ingreso" value="<?php echo $fecha_ingreso;?>" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for=""> Fecha vencimiento:</label>
                                                                <input type="date" name="fecha_vencimiento" value="<?php echo $fecha_vencimiento;?>" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""> Ubicación:</label>
                                                                <textarea name="ubicacion" id="" cols="30" rows="1"  class="form-control" disabled><?php echo $ubicacion;?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Imagen</label>
                                                        <center>
                                                            <img src="<?php echo $URL."/productos/img_productos/".$imagen;?>" alt="" width="75%">
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="form-group">
                                                <a href="index.php" class="btn btn-secondary">Volver</a>
                                            </div>
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


<!-- Page specific script -->

<script>
    $(function () {
        $("#example1").DataTable({
            /* cambio de idiomas de datatable */
            "pageLength": 10,
            language: {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                "infoEmpty": "Mostrando 0 to 0 de 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Productos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            /* fin de idiomas */

            "responsive": true, "lengthChange": true, "autoWidth": false,
            /* Ajuste de botones */
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                    text: 'Copiar',
                    extend: 'copy'
                }, {
                    extend: 'pdf',
                }, {
                    extend: 'csv',
                }, {
                    extend: 'excel',
                }, {
                    text: 'Imprimir',
                    extend: 'print'
                }
                ]
            },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas'
                }
            ],
            /*Fin de ajuste de botones*/
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>