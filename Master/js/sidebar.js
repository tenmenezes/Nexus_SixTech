document.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.getElementById("hamburger");
  const sidebar = document.querySelector(".sidebar");
  const icon = hamburger.querySelector("i");
  const body = document.body;

  hamburger.addEventListener("click", () => {
    sidebar.classList.toggle("active");
    if (sidebar.classList.contains("active")) {
      icon.classList.remove("fa-bars");
      icon.classList.add("fa-xmark");
      if (window.innerWidth <= 1024) {
        body.classList.add("no-scroll");
      }
    } else {
      icon.classList.remove("fa-xmark");
      icon.classList.add("fa-bars");
      body.classList.remove("no-scroll");
    }
  });

  // Remove no-scroll se redimensionar para desktop
  window.addEventListener("resize", () => {
    if (window.innerWidth > 1024) {
      body.classList.remove("no-scroll");
      sidebar.classList.remove("active");
      icon.classList.remove("fa-xmark");
      icon.classList.add("fa-bars");
    }
  });
});
