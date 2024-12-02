<?php
session_start();
?>
<?php include('../app/config.php');?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900italic,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $URL;?>/web/public/css/style_general_modified.css">
    <base href="/sistemainventario1/web/">

    <title>La Martita</title>
</head>
<body>
<div class="topnav" id="myTopnav">
    <a href="<?php echo $URL;?>/web/index.php" class="navbar-logo"><img src="<?php echo $URL;?>/web/public/images/logo.png" alt="Logo" /></a>
    
    <a href="<?php echo $URL;?>/web/about.php" >NOSOTROS</a>
    <a href="<?php echo $URL;?>/web/ofertas.php">OFERTAS</a>
    <a href="<?php echo $URL;?>/web/marcas.php">MARCAS</a>
    <a href="<?php echo $URL;?>/web/ubicacion.php">UBICACIÓN</a>
    <a href="<?php echo $URL;?>/web/contacto.php">CONTACTO</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<script>
/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
<script>
// JavaScript para poner la clase 'active' dependiendo de la URL
document.addEventListener('DOMContentLoaded', () => {
    const currentLocation = window.location.href; // Obtener la URL actual
    const menuItems = document.querySelectorAll('.topnav a'); // Seleccionar todos los enlaces del navbar

    menuItems.forEach((item) => {
        // Comparar la URL del enlace con la URL actual
        if (item.href === currentLocation) {
            item.classList.add('active'); // Agregar la clase 'active' al enlace correspondiente
        } else {
            item.classList.remove('active'); // Asegurarse de quitar 'active' de los demás
        }
    });
});
</script>