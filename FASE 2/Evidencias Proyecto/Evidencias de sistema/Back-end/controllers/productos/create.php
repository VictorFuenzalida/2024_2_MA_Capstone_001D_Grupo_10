<?php

include('../../config.php');

$codigo = $_POST['codigo'];
$id_categoria = $_POST['id_categoria'];
$nombre = $_POST['nombre'];
$marca = $_POST['marca'];
$id_usuario = $_POST['id_usuario'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$fecha_vencimiento = $_POST['fecha_vencimiento'];
$ubicacion = $_POST['ubicacion'];

$image = $_POST['image'];
$nombreDelArchivo = date("Y-m-d-H-i-s");
$filename = $nombreDelArchivo."__".$_FILES['image']['name'];
$location = "../../../productos/img_productos/".$filename;

move_uploaded_file($_FILES['image']['tmp_name'], $location);

$sentencia = $pdo->prepare("INSERT INTO producto
       (codigo, nombre, marca, descripcion, stock, stock_minimo, stock_maximo, precio_compra, precio_venta, fecha_ingreso, fecha_vencimiento, ubicacion, imagen, id_usuario, id_categoria, fyh_creacion)
VALUES (:codigo, :nombre, :marca, :descripcion, :stock, :stock_minimo, :stock_maximo, :precio_compra, :precio_venta, :fecha_ingreso, :fecha_vencimiento, :ubicacion, :imagen, :id_usuario, :id_categoria, :fyh_creacion)");

$sentencia->bindParam('codigo', $codigo);
$sentencia->bindParam('nombre', $nombre);
$sentencia->bindParam('marca', $marca);
$sentencia->bindParam('descripcion', $descripcion);
$sentencia->bindParam('stock', $stock);
$sentencia->bindParam('stock_minimo', $stock_minimo);
$sentencia->bindParam('stock_maximo', $stock_maximo);
$sentencia->bindParam('precio_compra', $precio_compra);
$sentencia->bindParam('precio_venta', $precio_venta);
$sentencia->bindParam('fecha_ingreso', $fecha_ingreso);
$sentencia->bindParam('fecha_vencimiento', $fecha_vencimiento);
$sentencia->bindParam('ubicacion', $ubicacion);
$sentencia->bindParam('imagen', $filename);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('id_categoria', $id_categoria);
$sentencia->bindParam('fyh_creacion', $fechaHora);
if($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Registro completado";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/productos');
}else {
    session_start();
    $_SESSION['mensaje'] = "Error, no se pudo completar el registro";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/productos/create.php');
}


