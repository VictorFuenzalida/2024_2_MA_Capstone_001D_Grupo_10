// Captura el botón y el menú
const hamburguesaBtn = document.getElementById("hamburguesa-btn");
const menu = document.getElementById("menu");

// Agregar un listener al botón
hamburguesaBtn.addEventListener("click", () => {
    menu.classList.toggle("active"); // Muestra/oculta el menú
});