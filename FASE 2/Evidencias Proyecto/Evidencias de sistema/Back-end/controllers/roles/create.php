<?php

include('../../config.php');

$rol = $_POST['rol'];

    $sentencia = $pdo->prepare("INSERT INTO rol
       (rol, fyh_creacion)
VALUES (:rol, :fyh_creacion)");

    $sentencia->bindParam('rol', $rol);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    if($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Registro completado";
        $_SESSION['icono'] = "success";
        header('Location: ' . $URL . '/roles');
    }else {
        session_start();
        $_SESSION['mensaje'] = "Error, no se pudo completar el registro";
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/roles/create.php');
    }






