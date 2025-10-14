document.addEventListener("DOMContentLoaded", () => {

  /* botão dos cards responsivos */

  document.querySelectorAll(".toggle-card").forEach((button) => {
    button.addEventListener("click", function () {
      const card = this.closest(".box-info-single");
      card.classList.toggle("active");

      // Alterna seta para cima/baixo
      const icon = this.querySelector("i");
      icon.classList.toggle("fa-chevron-down");
      icon.classList.toggle("fa-chevron-up");
    });
  });

  /* filtro dropdown */

  const filterBtn = document.querySelector(".filter-btn");
  const produtoSelect = document.getElementById("produtoSelect");
  const filterDropdown = document.querySelector(".filter-dropdown");

  // Função que alterna o dropdown
  function toggleDropdown() {
    filterDropdown.classList.toggle("show");
  }

  // Abrir ao clicar no botão
  filterBtn.addEventListener("click", toggleDropdown);

  // Abrir ao clicar no select
  produtoSelect.addEventListener("click", toggleDropdown);

  // Fecha ao clicar fora
  document.addEventListener("click", (e) => {
    if (!filterBtn.contains(e.target) && !filterDropdown.contains(e.target)) {
      filterDropdown.classList.remove("show");
    }
  });

  // Fecha o dropdown ao selecionar uma opção

  const fullscreenBtn = document.getElementsByClassName("fullscreen")[0];

  fullscreenBtn.addEventListener("click", () => {
    console.log("Fullscreen button clicked"); // debug
    const elem = document.documentElement;

    if (!document.fullscreenElement) {
      if (elem.requestFullscreen) {
        elem.requestFullscreen().catch((err) => {
          alert("Erro ao tentar fullscreen: " + err.message);
        });
      } else {
        alert("Fullscreen não suportado neste navegador.");
      }
    } else {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      }
    }
  });
});