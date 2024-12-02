
<?php


// Genera el captcha
if (empty($_SESSION['captcha_code'])) {
    $_SESSION['captcha_code'] = rand(1000, 9999);
}

// Procesa el formulario cuando se envía
$nombre = $email = $mensaje = $captcha = "";
$errores = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);
    $captcha = htmlspecialchars($_POST['captcha']);
    $politica = isset($_POST['politica']);
    
    // Validación del formulario
    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El email es inválido.";
    }
    if (empty($mensaje)) {
        $errores[] = "El mensaje es obligatorio.";
    }
    if (!$politica) {
        $errores[] = "Debe aceptar la política de privacidad.";
    }
    if ($captcha != $_SESSION['captcha_code']) {
        $errores[] = "El captcha es incorrecto.";
    }

    // Si no hay errores, procesa el formulario (por ejemplo, enviar un email)
    if (empty($errores)) {
        // Lógica para enviar el formulario (e.g., enviar email, guardar en base de datos)
        echo "<p class='success'>Mensaje enviado correctamente.</p>";
        
        // Reinicia el captcha para evitar reutilización
        $_SESSION['captcha_code'] = rand(1000, 9999);
        $nombre = $email = $mensaje = ""; // Limpia los campos
    }
}
?>
<?php include('layout/parte1.php');?>

<link rel="stylesheet" href="public/css/style_contacto.css">

<!-- Banner principal -->
<div class="banner">Mantengamos el contacto</div>
<br>
<br>

<div class="contact-container">
    <!-- Imagen al lado izquierdo del formulario -->
    <div class="contact-image">
        <img src="public/images/martita3.jpeg" alt="Imagen de Contacto">
    </div>

<div class="form-container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <?php if (!empty($errores)): ?>
            <div class="error-messages">
                <?php foreach ($errores as $error): ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <label>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>" placeholder="Ingrese su nombre" required>
        </label>
        
        <label>
            <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Ingrese su email" required>
        </label>
        
        <label>
            <textarea name="mensaje" rows="4" placeholder="Ingrese su mensaje" required><?php echo $mensaje; ?></textarea>
        </label>
        
        <label class="checkbox-container">
            <input type="checkbox" name="politica" required>
            <span>He leído y entiendo la política de privacidad</span>
        </label>
        
        <div class="captcha-container">
            <img src="app/controllers/captcha.php?rand=<?php echo rand(); ?>" alt="Captcha">
            <button type="button" class="captcha-refresh">&#8635;</button>
            <input type="text" name="captcha" placeholder="Captcha" required>
        </div>
        
        <button type="submit" class="submit-button">Enviar</button>
    </form>
</div>
</div>

<script>
    document.querySelector('.captcha-refresh').addEventListener('click', function() {
        const captchaImage = document.querySelector('img[alt="Captcha"]');
        captchaImage.src = 'app/controllers/captcha.php?rand=' + Math.random();
    });
</script>

<br>
<br>
<?php include('layout/parte2.php');?>
