document.addEventListener("DOMContentLoaded", () => {
    /* menu hamburguer */

    // Seleção dos elementos
    const hamburger = document.getElementById("hamburger");
    const sidebar = document.querySelector(".sidebar");

    if (hamburger && sidebar) {
        // garante que os elementos existam
        hamburger.addEventListener("click", () => {
            // Alterna a sidebar
            sidebar.classList.toggle("active");

            // Alterna o ícone do botão
            const icon = hamburger.querySelector("i");
            if (icon) {
                icon.classList.toggle("fa-bars");
                icon.classList.toggle("fa-xmark");
            }
        });
    }
});