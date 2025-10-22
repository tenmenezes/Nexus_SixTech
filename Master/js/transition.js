document.addEventListener("DOMContentLoaded", () => {
  const links = document.querySelectorAll("a");
  const transicao = document.querySelector(".transicao");

  transicao.classList.remove("ativa");

  links.forEach((link) => {
    link.addEventListener("click", function (event) {
      const href = this.getAttribute("href");

      if (href && !href.startsWith("#")) {
        transicao.classList.add("ativa");
        event.preventDefault();

        setTimeout(() => {
          window.location.href = href;
        }, 1200); // Tempo da transição
      }
    });
  });
});
