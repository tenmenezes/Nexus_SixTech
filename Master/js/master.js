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
    // Pega o elemento que vai ficar em fullscreen (a página inteira)
    const elem = document.documentElement;
  
    if (!document.fullscreenElement) {
      // Solicita fullscreen
      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.webkitRequestFullscreen) {
        /* Safari */
        elem.webkitRequestFullscreen();
      } else if (elem.msRequestFullscreen) {
        /* IE11 */
        elem.msRequestFullscreen();
      }
    } else {
      // Sai do fullscreen
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.webkitExitFullscreen) {
        /* Safari */
        document.webkitExitFullscreen();
      } else if (document.msExitFullscreen) {
        /* IE11 */
        document.msExitFullscreen();
      }
    }
  });
});

