<?php

$id_usuario_get = $_GET['id'];

$sql_usuarios = "SELECT users.id_usuario as id_usuario, users.p_nombre as p_nombre, users.s_nombre as s_nombre, 
                        users.p_apellido as p_apellido, users.s_apellido as s_apellido,  users.run as run, 
                        users.nacionalidad as nacionalidad, users.direccion as direccion, 
                        users.comuna as comuna, users.sexo as sexo, users.fecha_nacimiento as fecha_nacimiento, users.email as email, 
                        users.numero_telefonico AS numero_telefonico, rol.rol as rol 
                 FROM usuario as users INNER JOIN rol as rol ON users.id_rol = rol.id_rol  where id_usuario = '$id_usuario_get' ";
$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$usuarios_datos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios_datos as $usuarios_dato) {
    $p_nombre = $usuarios_dato['p_nombre'];
    $s_nombre = $usuarios_dato['s_nombre'];
    $p_apellido = $usuarios_dato['p_apellido'];
    $s_apellido = $usuarios_dato['s_apellido'];
    $run = $usuarios_dato['run'];
    $nacionalidad = $usuarios_dato['nacionalidad'];
    $direccion = $usuarios_dato['direccion'];
    $comuna = $usuarios_dato['comuna'];
    $sexo = $usuarios_dato['sexo'];
    $fecha_nacimiento = $usuarios_dato['fecha_nacimiento'];
    $email = $usuarios_dato['email'];
    $numero_telefonico = $usuarios_dato['numero_telefonico'];
    $rol = $usuarios_dato['rol'];
}