<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="footer">
    <p>&copy; 2024 A&F Soluciones, SpA. Todos los derechos reservados.</p>
    <?php if (isset($_SESSION['session_email'])) : ?>
        <!-- Si el usuario ya ha iniciado sesión, redirige directamente al sistema -->
        <button class="ingreso-boton" onclick="window.location.href='<?php echo $URL; ?>/index.php';">IR AL SISTEMA</button>
    <?php else : ?>
        <!-- Si el usuario no ha iniciado sesión, redirige al login -->
        <button class="ingreso-boton" onclick="window.location.href='<?php echo $URL; ?>/login/index.php';">INGRESAR</button>
    <?php endif; ?>
</div>
</body>
</html>