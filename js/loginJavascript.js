// Script login

// Detecta el tamaño de la ventana y ajusta elementos dinámicamente
window.addEventListener("resize", () => {
    const formContainer = document.querySelector(".form-container");
    const windowHeight = window.innerHeight;

    // Centrar el formulario verticalmente
    formContainer.style.marginTop = `${windowHeight / 2 - formContainer.offsetHeight / 2 - 500}px`;
});

// Inicialización
window.dispatchEvent(new Event("resize"));
