<?php

include ('../../config.php');

$email = $_POST['email'];
$password_usuario = $_POST['password_usuario'];

$contador = 0;
$sql = "SELECT * FROM usuario WHERE email = '$email'";
$query = $pdo->prepare($sql);
$query->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($usuarios as $usuario) {
    $contador = $contador + 1;
    $email_tabla = $usuario['email'];
    $nombres = $usuario['p_nombre'];
    $password_usuario_tabla = $usuario['password_usuario'];
}


if(($contador > 0) && (password_verify($password_usuario, $password_usuario_tabla)) ){
    echo "Datos correctos";
    session_start();
    $_SESSION['session_email'] = $email;
    header('location: '.$URL.'/index.php');
}else {

    echo "Datos incorrectos";
    session_start();
    $_SESSION['mensaje'] = "Error datos incorrectos";
    header('Location: '.$URL.'/login');
}