<?php include('layout/parte1.php');?>
<link rel="stylesheet" href="public/css/style_ofertas.css">

<?php
$productos = [
    [
        "nombre" => "Cheetos palitos",
        "puntos" => 1500,
        "imagen" => "public/images/productos/cheetos.jpg",
        "descuento" => 2000,
        "descripcion" => "Clásicos e iniguables. Snacks horneados de sabor a queso.",
        "descuentoPorcentaje" => 25
    ],
    [
        "nombre" => "Coca Cola 500ml",
        "puntos" => 800,
        "imagen" => "public/images/productos/cocacola.jpg",
        "descuento" => 950,
        "descripcion" => "Coca Cola Original de 500ml",
        "descuentoPorcentaje" => 15.79
    ],
    [
        "nombre" => "leche Soprole 1Lt",
        "puntos" => 1050,
        "imagen" => "public/images/productos/leche entero soprole.jpg",
        "descuento" => 1200,
        "descripcion" => "Leche Soprole entera 100% natural de la zona centro y sur de Chile. Envase con tapa.",
        "descuentoPorcentaje" => 12.5
    ],
    [
        "nombre" => "Galleta Kuky original",
        "puntos" => 800,
        "imagen" => "public/images/productos/Kuky_700x700.jpg",
        "descuento" => 1000,
        "descripcion" => "Galleta Chip KUKY  su formato perfecto para compartir! Formato 120 g Disfruta de nuestra variedad de galletas Mckay, porque Mckay Más ricas No hay",
        "descuentoPorcentaje" => 20
    ],
    [
        "nombre" => "Tritón Limón",
        "puntos" => 750,
        "imagen" => "public/images/productos/triton_lemon.jpg",
        "descuento" => 1000,
        "descripcion" => "Galleta sandwich Triton Limón - White, deliciosa y crujiente galleta sabor vainilla con crema sabor limón",
        "descuentoPorcentaje" => 25
    ],
    [
        "nombre" => "Tritón Vainilla",
        "puntos" => 750,
        "imagen" => "public/images/productos/triton.jpg",
        "descuento" => 1000,
        "descripcion" => "Galleta sandwich Triton Vainilla, deliciosa y crujiente galleta de chocolate rellena con crema sabor vainilla.",
        "descuentoPorcentaje" => 25
    ],
    [
        "nombre" => "Rolls Nuts",
        "puntos" => 1500,
        "imagen" => "public/images/productos/rolls-mani.jpg",
        "descuento" => 1800,
        "descripcion" => "chocolate formato rolls nuts de Costa un producto a base de leche de alta calidad para deleitar a tu paladar 150gr.",
        "descuentoPorcentaje" => 16.67
    ],
    [
        "nombre" => "Pasta Spaghetti N°5",
        "puntos" => 1000,
        "imagen" => "public/images/productos/fideos.jpg",
        "descuento" => 1200,
        "descripcion" => "Pasta Vitaminizada de Trigo Spaghetti 5 Lucchetti, 400g",
        "descuentoPorcentaje" => 16.67
    ],
    [
        "nombre" => "Salsa de Tomate Pomarola Italiana ",
        "puntos" => 800,
        "imagen" => "public/images/productos/pomarola.jpg",
        "descuento" => 900,
        "descripcion" => "Salsa italina en sachet para preparar tus mejores y más exquisitas pastas, disfrutando tu cocina en cada preparación, siento el mejor shef. 200gr",
        "descuentoPorcentaje" => 11.11
    ],
    // Agrega más productos según sea necesario
];
?>

<!-- Banner principal -->
<div class="banner">Oferta Semana 4 al 10 de noviembre</div>

<br>
<br>

<div class="catalog">
    <?php foreach ($productos as $producto): ?>
        <div class="product-card">
            <div class="product-image">
                <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
            </div>
            <div class="product-info">
                <p class="discount"><?php echo number_format($producto['descuento'], 0, ',', '.'); ?> $ <span><?php echo $producto['descuentoPorcentaje']; ?>% OFF</span></p>
                <p class="points"><?php echo number_format($producto['puntos'], 0, ',', '.'); ?> $</p>
                <p class="description"><?php echo $producto['descripcion']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<br>
<br>

<?php include('layout/parte2.php');?>