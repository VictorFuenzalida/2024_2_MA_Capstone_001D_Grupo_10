<?php

$id_producto_get = $_GET["id"];

$sql_productos = "SELECT *, ca.categoria as categoria, us.email as email, us.id_usuario as id_usuario
                 FROM producto as pr INNER JOIN categoria as ca ON pr.id_categoria = ca.id_categoria 
                 INNER JOIN usuario as us ON us.id_usuario = pr.id_usuario WHERE id_producto = '$id_producto_get' ";
$query_productos = $pdo->prepare($sql_productos);
$query_productos->execute();
$productos_datos = $query_productos->fetchAll(PDO::FETCH_ASSOC);

foreach ($productos_datos as $productos_dato) {
    $codigo = $productos_dato['codigo'];
    $categoria = $productos_dato['categoria'];
    $nombre = $productos_dato['nombre'];
    $marca = $productos_dato['marca'];
    $email = $productos_dato['email'];
    $id_usuario = $productos_dato['id_usuario'];
    $descripcion = $productos_dato['descripcion'];
    $stock = $productos_dato['stock'];
    $stock_minimo = $productos_dato['stock_minimo'];
    $stock_maximo = $productos_dato['stock_maximo'];
    $precio_compra = $productos_dato['precio_compra'];
    $precio_venta = $productos_dato['precio_venta'];
    $fecha_ingreso = $productos_dato['fecha_ingreso'];
    $fecha_vencimiento = $productos_dato['fecha_vencimiento'];
    $ubicacion = $productos_dato['ubicacion'];
    $imagen = $productos_dato['imagen'];
}