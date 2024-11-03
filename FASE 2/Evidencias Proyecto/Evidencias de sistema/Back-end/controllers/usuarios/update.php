<?php

include('../../config.php');

$p_nombre = $_POST['p_nombre'];
$s_nombre = $_POST['s_nombre'];
$p_apellido = $_POST['p_apellido'];
$s_apellido = $_POST['s_apellido'];
$run = $_POST['run'];
$nacionalidad = $_POST['nacionalidad'];
$direccion = $_POST['direccion'];
$comuna = $_POST['comuna'];
$sexo = $_POST['sexo'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$email = $_POST['email'];
$numero_telefonico = $_POST['numero_telefonico'];
$rol = $_POST['rol'];
$password_usuario = $_POST['password_usuario'];
$password_repeat = $_POST['password_repeat'];
$id_usuario = $_POST['id_usuario'];

if($password_usuario == ""){
    if($password_usuario == $password_repeat){
        $password_usuario = password_hash($password_usuario, PASSWORD_DEFAULT);
        $sentencia = $pdo->prepare("UPDATE usuario 
SET   p_nombre=:p_nombre,
      s_nombre=:s_nombre, 
      p_apellido=:p_apellido, 
      s_apellido=:s_apellido, 
      run=:run,
      nacionalidad=:nacionalidad,
      direccion=:direccion,
      comuna=:comuna,
      sexo=:sexo,
      fecha_nacimiento=:fecha_nacimiento,
      email=:email,
      id_rol=:id_rol,
      numero_telefonico=:numero_telefonico, 
      fyh_actualizacion=:fyh_actualizacion      
WHERE id_usuario = :id_usuario");

        $sentencia->bindParam('p_nombre', $p_nombre);
        $sentencia->bindParam('s_nombre', $s_nombre);
        $sentencia->bindParam('p_apellido', $p_apellido);
        $sentencia->bindParam('s_apellido', $s_apellido);
        $sentencia->bindParam('run', $run);
        $sentencia->bindParam('nacionalidad', $nacionalidad);
        $sentencia->bindParam('direccion', $direccion);
        $sentencia->bindParam('comuna', $comuna);
        $sentencia->bindParam('sexo', $sexo);
        $sentencia->bindParam('fecha_nacimiento', $fecha_nacimiento);
        $sentencia->bindParam('email', $email);
        $sentencia->bindParam('numero_telefonico', $numero_telefonico);
        $sentencia->bindParam('id_rol', $rol);
        $sentencia->bindParam('fyh_actualizacion', $fechaHora);
        $sentencia->bindParam('id_usuario', $id_usuario);
        $sentencia->execute();
        session_start();
        $_SESSION['mensaje'] = "Se actualizo correctamente";
        $_SESSION['icono'] = "success";
        header('Location: '.$URL.'/usuarios');

    }else{
        session_start();
        $_SESSION['mensaje'] = "Error la contraseña no coincide";
        $_SESSION['icono'] = "error";
        header('Location: '.$URL.'/usuarios/update.php?id='.$id_usuario);
    }
}else{
    if($password_usuario == $password_repeat){
        $password_usuario = password_hash($password_usuario, PASSWORD_DEFAULT);
        $sentencia = $pdo->prepare("UPDATE usuario 
SET   p_nombre=:p_nombre,
      s_nombre=:s_nombre, 
      p_apellido=:p_apellido, 
      s_apellido=:s_apellido, 
      run=:run,
      nacionalidad=:nacionalidad,
      direccion=:direccion,
      comuna=:comuna,
      sexo=:sexo,
      fecha_nacimiento=:fecha_nacimiento,
      email=:email, 
      numero_telefonico=:numero_telefonico, 
      id_rol=:id_rol,
      password_usuario=:password_usuario, 
      fyh_actualizacion=:fyh_actualizacion      
WHERE id_usuario = :id_usuario");

        $sentencia->bindParam('p_nombre', $p_nombre);
        $sentencia->bindParam('s_nombre', $s_nombre);
        $sentencia->bindParam('p_apellido', $p_apellido);
        $sentencia->bindParam('s_apellido', $s_apellido);
        $sentencia->bindParam('run', $run);
        $sentencia->bindParam('nacionalidad', $nacionalidad);
        $sentencia->bindParam('direccion', $direccion);
        $sentencia->bindParam('comuna', $comuna);
        $sentencia->bindParam('sexo', $sexo);
        $sentencia->bindParam('fecha_nacimiento', $fecha_nacimiento);
        $sentencia->bindParam('email', $email);
        $sentencia->bindParam('numero_telefonico', $numero_telefonico);
        $sentencia->bindParam('id_rol', $rol);
        $sentencia->bindParam('password_usuario', $password_usuario);
        $sentencia->bindParam('fyh_actualizacion', $fechaHora);
        $sentencia->bindParam('id_usuario', $id_usuario);
        $sentencia->execute();
        session_start();
        $_SESSION['mensaje'] = "Se actualizo correctamente";
        $_SESSION['icono'] = "success";
        header('Location: '.$URL.'/usuarios');

    }else{
        session_start();
        $_SESSION['mensaje'] = "Error la contraseña no coincide";
        $_SESSION['icono'] = "error";
        header('Location: '.$URL.'/usuarios/update.php?id='.$id_usuario);
    }
}

