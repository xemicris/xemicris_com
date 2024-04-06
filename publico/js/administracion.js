const botones = document.querySelectorAll(".boton");
function preguntar() {
    confirm("¿Deseas Continuar?")
}
botones.forEach((n => {
    n.addEventListener("click", preguntar)
}));