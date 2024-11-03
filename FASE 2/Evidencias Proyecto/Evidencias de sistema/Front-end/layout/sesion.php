<?php

session_start();
if(isset($_SESSION['session_email'])){
    //echo "si existe sesión de ".$_SESSION['session_email'];
    $email_session = $_SESSION['session_email'];
    $sql = "SELECT users.id_usuario as id_usuario, users.p_nombre as p_nombre, users.s_nombre as s_nombre, users.p_apellido as p_apellido, users.s_apellido as s_apellido, users.email as email, users.numero_telefonico AS numero_telefonico, rol.rol as rol 
                 FROM usuario as users INNER JOIN rol as rol ON users.id_rol = rol.id_rol  WHERE email = '$email_session'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($usuarios as $usuario) {
        $id_usuario = $usuario['id_usuario'];
        $nombres_session = $usuario['p_nombre'];
        $nombres_session2 = $usuario['p_apellido'];
        $roles_session = $usuario['rol'];

    }

}else{
    echo "no existe sesión";
    header('location: '.$URL.'/login');
}
?>
