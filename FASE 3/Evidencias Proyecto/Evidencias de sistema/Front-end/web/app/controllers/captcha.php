<?php
session_start();
header("Content-Type: image/png");

// Generar código aleatorio de captcha y almacenarlo en la sesión
$captcha_code = rand(1000, 9999);
$_SESSION['captcha_code'] = $captcha_code;

// Crear la imagen y definir los colores
$image = imagecreate(80, 30);
$background = imagecolorallocate($image, 255, 255, 255); // Blanco
$text_color = imagecolorallocate($image, 0, 0, 0); // Negro

// Escribir el código de captcha en la imagen
imagestring($image, 5, 10, 5, $captcha_code, $text_color);

// Enviar la imagen y liberar recursos
imagepng($image);
imagedestroy($image);
