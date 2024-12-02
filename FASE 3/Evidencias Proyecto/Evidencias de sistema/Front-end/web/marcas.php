<?php include('layout/parte1.php');?>
<link rel="stylesheet" href="public/css/style_marcas.css">

<!-- Banner principal -->
<div class="banner">Principales Marcas</div>
<br>
<br>
<?php
$marcas = [
    [
        "nombre" => "Unilever",
        "descripcion" => "Productos de marcas como Magnum, Axe, Dove y Knorr. Disponibles en categorías de cuidado personal, limpieza y alimentación.",
        "imagen" => "public/images/marcas/unilever.jpg"
    ],
    [
        "nombre" => "Carozzi",
        "descripcion" => "Fabricante de pastas, salsas, cereales y otros productos alimenticios. Carozzi es una marca reconocida en Chile y América Latina.",
        "imagen" => "public/images/marcas/carozzi.jpg"
    ],
    [
        "nombre" => "Fruna",
        "descripcion" => "Golosinas, galletas y snacks asequibles y de sabor popular en Chile.",
        "imagen" => "public/images/marcas/fruna.jpg"
    ],
    [
        "nombre" => "Soprole",
        "descripcion" => "Marca de productos lácteos como yogures, leches y postres, comprometida con la calidad y el bienestar.",
        "imagen" => "public/images/marcas/soprole.jpg"
    ],
    [
        "nombre" => "Confort",
        "descripcion" => "Marca de papel higiénico y productos de cuidado personal para el hogar.",
        "imagen" => "public/images/marcas/confort.jpg"
    ],
    [
        "nombre" => "Lucchetti",
        "descripcion" => "Productor de pastas, salsas y alimentos preparados. Lucchetti es una marca de confianza en la cocina chilena.",
        "imagen" => "public/images/marcas/lucchetti.jpg"
    ],
    [
        "nombre" => "Pedigree",
        "descripcion" => "Marca de alimentos para perros con una variedad de opciones nutricionales para el cuidado de las mascotas.",
        "imagen" => "public/images/marcas/pedigree.jpg"
    ],
    [
        "nombre" => "CCU",
        "descripcion" => "Compañía chilena de bebidas que produce cervezas, gaseosas, aguas y jugos.",
        "imagen" => "public/images/marcas/ccu.jpg"
    ],
    [
        "nombre" => "Coca-Cola Company",
        "descripcion" => "Multinacional de bebidas conocida por sus refrescos, jugos y aguas embotelladas, destacando la famosa Coca-Cola.",
        "imagen" => "public/images/marcas/cocacolacompany.jpg"
    ],
    [
        "nombre" => "Maruchan",
        "descripcion" => "Reconocida por sus fideos instantáneos, Maruchan ofrece soluciones rápidas y sabrosas para el día a día.",
        "imagen" => "public/images/marcas/maruchan.jpg"
    ],
    [
        "nombre" => "Coliseo",
        "descripcion" => "Productos de confitería con una variedad de dulces, chocolates y snacks.",
        "imagen" => "public/images/marcas/coliseo.jpg"
    ],
    [
        "nombre" => "Colún",
        "descripcion" => "Cooperativa láctea chilena que ofrece leches, quesos, yogures y otros productos frescos de calidad.",
        "imagen" => "public/images/marcas/colun.jpg"
    ]
];
?>

<div class="brand-catalog">
    <?php foreach ($marcas as $marca): ?>
        <div class="brand-card">
            <div class="brand-image">
                <img src="<?php echo $marca['imagen']; ?>" alt="<?php echo $marca['nombre']; ?>">
            </div>
            <div class="brand-info">
                <h3 ><?php echo $marca['nombre']; ?></h3>
                <p><?php echo $marca['descripcion']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<br>
<br>

<<?php include('layout/parte2.php');?>