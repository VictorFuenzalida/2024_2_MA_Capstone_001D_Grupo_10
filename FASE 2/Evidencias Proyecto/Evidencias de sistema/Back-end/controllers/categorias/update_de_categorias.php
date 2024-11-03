<?php


include('../../config.php');

$id_categoria = $_GET['id_categoria'];
$categoria = $_GET['categoria'];



$sentencia = $pdo->prepare("UPDATE categoria 
SET   categoria=:categoria,
      fyh_actualizacion=:fyh_actualizacion      
WHERE id_categoria = :id_categoria");

$sentencia->bindParam('id_categoria', $id_categoria);
$sentencia->bindParam('categoria', $categoria);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se actualizo correctamente";
    $_SESSION['icono'] = "success";
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias";
    </script>
    <?php
}else {
    session_start();
    $_SESSION['mensaje'] = "Error, no se pudo actualizar";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias";
    </script>
    <?php
}



