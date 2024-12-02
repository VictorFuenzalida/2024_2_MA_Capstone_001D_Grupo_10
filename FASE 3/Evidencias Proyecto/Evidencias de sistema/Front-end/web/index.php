<?php include('layout/parte1.php');?>

<link rel="stylesheet" href="public/css/style_index.css">
<link rel="stylesheet" href="public/css/style_about.css">

 
    <!-- Banner principal -->
    <div class="banner">¡Bienvenidos a nuestro almacén!</div>
    <div class="image-grid">
        <div class="main-image">
            <img src="<?php echo $URL;?>/web/public/images/estante6.jpeg" alt="Imagen principal">
            <div class="overlay">
                <h2>No te pierdas ninguna de nuestras ofertas</h2>
                <p>Únete a nuestro canal de whatsapp </p>
                <a href="https://wa.me/56956657528" target="_blank" class="btnw">Unirme </a>
            </div>
        </div>
        <div class="side-images">
            <div class="side-image">
                <img src="<?php echo $URL;?>/web/public/images/bebidas2.jpeg" alt="Imagen 1">
                <div class="overlay">
                    <h3>Encuéntranos</h3>
                    <a href="ubicacion.php" class="btn">Nuestra ubicación</a>
                </div>
            </div>
            <div class="side-image">
                <img src="<?php echo $URL;?>/web/public/images/estante4.jpeg" alt="Imagen 2">
                <div class="overlay">
                    <h3>Ofertas de la semana</h3>
                    <a href="ofertas.php" class="btn">Ver</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Contenedor principal -->
    <div class="container">
        <!-- Sección de texto -->
        <div class="text-section">
            <h2>Bienvenidos a nuestro local!</h2>
            <p>Bienvenidos a La Martita, tu almacén de confianza en el corazón del barrio. Desde el año 2017, hemos estado dedicados a ofrecer productos frescos y de calidad, junto con un servicio amable y cercano.</p>
            <p>En La Martita, nos enorgullece ser parte de la comunidad. Conocemos a nuestros clientes por su nombre y nos esforzamos por crear un ambiente acogedor donde todos se sientan como en casa. Nuestra selección de productos incluye desde alimentos frescos y locales hasta artículos de uso diario, siempre a precios justos.</p>
            <p>Nuestro compromiso es ofrecerte una experiencia de compra rápida y conveniente, porque entendemos la importancia de tu tiempo. Además, trabajamos constantemente para mejorar y adaptarnos a tus necesidades, incorporando productos que nuestros clientes realmente desean. Gracias por elegir La Martita. ¡Estamos aquí para servirte!</p>
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
<?php include('layout/parte2.php');?>