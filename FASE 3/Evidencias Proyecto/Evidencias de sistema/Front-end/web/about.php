<?php include('layout/parte1.php');?>
<link rel="stylesheet" href="public/css/style_about.css">

<!-- Banner principal -->
<div class="banner">Quiénes Somos</div>
<br>
<br>
<!-- Contenedor principal -->
<div class="container">
    <!-- Sección de texto -->
    <div class="text-section ">
        <h2>Bienvenidos a nuestro local!</h2>
        <p style="text-align: justify;">Bienvenidos a La Martita, tu almacén de confianza en el corazón del barrio. Desde el año 2017, hemos estado dedicados a ofrecer productos frescos y de calidad, junto con un servicio amable y cercano.</p>
        <p style="text-align: justify;">En La Martita, nos enorgullece ser parte de la comunidad. Conocemos a nuestros clientes por su nombre y nos esforzamos por crear un ambiente acogedor donde todos se sientan como en casa. Nuestra selección de productos incluye desde alimentos frescos y locales hasta artículos de uso diario, siempre a precios justos.</p>
        <p style="text-align: justify;">Nuestro compromiso es ofrecerte una experiencia de compra rápida y conveniente, porque entendemos la importancia de tu tiempo. Además, trabajamos constantemente para mejorar y adaptarnos a tus necesidades, incorporando productos que nuestros clientes realmente desean. Gracias por elegir La Martita. ¡Estamos aquí para servirte!</p>
    </div>

    <!-- Galería de imágenes -->
    <div class="image-gallery">
        <?php
            // Array con las rutas de las imágenes
            $imagenes = ["public/images/estante1.jpeg", "public/images/dulces6.jpeg", "public/images/refrigerados3.jpeg", "public/images/dulces2.jpeg"];
            
            // Generar las etiquetas <img> dinámicamente
            foreach ($imagenes as $imagen) {
                echo "<img src='$imagen' alt='Imagen de producto'>";
            }
        ?>
    </div>
</div>
<br>
<br>
<br>
<?php include('layout/parte2.php');?>