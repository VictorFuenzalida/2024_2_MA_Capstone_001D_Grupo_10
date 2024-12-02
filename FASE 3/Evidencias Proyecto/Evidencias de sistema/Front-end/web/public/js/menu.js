
// JavaScript para activar el menú hamburguesa al hacer clic en el botón
document.addEventListener("DOMContentLoaded", function() {
    const hamburger = document.querySelector(".hamburger");
    const menu = document.querySelector(".nav-links");

    hamburger.addEventListener("click", function() {
        menu.classList.toggle("active");
    });
});
