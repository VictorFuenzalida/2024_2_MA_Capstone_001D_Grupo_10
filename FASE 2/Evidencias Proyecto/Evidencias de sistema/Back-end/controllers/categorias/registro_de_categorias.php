<?php

include ('../../config.php');

$categoria = $_GET['categoria'];

$sentencia = $pdo->prepare("INSERT INTO categoria
       (categoria, fyh_creacion)
VALUES (:categoria, :fyh_creacion)");

$sentencia->bindParam('categoria', $categoria);
$sentencia->bindParam('fyh_creacion', $fechaHora);
if($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Registro completado";
    $_SESSION['icono'] = "success";
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias";
    </script>
    <?php
}else {
    session_start();
    $_SESSION['mensaje'] = "Error, no se pudo completar el registro";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias";
    </script>
    <?php
}