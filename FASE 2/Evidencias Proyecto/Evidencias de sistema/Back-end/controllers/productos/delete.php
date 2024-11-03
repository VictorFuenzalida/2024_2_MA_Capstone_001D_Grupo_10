<?php

include('../../config.php');

$id_producto = $_POST['id_producto'];

$sentencia = $pdo->prepare("DELETE FROM producto WHERE id_producto = :id_producto");

$sentencia->bindParam('id_producto', $id_producto);
if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Producto eliminado correctamente";
    $_SESSION['icono'] = "success";
    header('Location: '.$URL.'/productos/');
}else {
    session_start();
    $_SESSION['mensaje'] = "Error, no se pudo eliminar";
    $_SESSION['icono'] = "error";
    header('Location: '.$URL.'/productos/delete.php?id=' . $id_producto);
}

