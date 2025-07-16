


window.addEventListener("resize", () => {
    const formContainer = document.querySelector(".form-container");
    const windowHeight = window.innerHeight;


    formContainer.style.marginTop = `${windowHeight / 2 - formContainer.offsetHeight / 2 - 500}px`;
});


window.dispatchEvent(new Event("resize"));
