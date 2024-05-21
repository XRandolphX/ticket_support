document.querySelectorAll(".dropdown-item").forEach((item) => {
    item.addEventListener("click", function () {
        let prioridad = this.getAttribute("data-value");
        document.getElementById("prioridad-input").value = prioridad;
    });
});

function toggleTheme() {
    let body = document.body;
    body.classList.toggle("light-theme");
    body.classList.toggle("dark-theme");
    // Cambiar icono
    let themeIcon = document.getElementById("theme-icon");
    if (body.classList.contains("dark-theme")) {
        themeIcon.classList.remove("fa-moon");
        themeIcon.classList.add("fa-sun");
    } else {
        themeIcon.classList.remove("fa-sun");
        themeIcon.classList.add("fa-moon");
    }
}
