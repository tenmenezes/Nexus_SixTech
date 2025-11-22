function redirecionarComErro(msg) {
  sessionStorage.setItem("Erro", msg);
  window.location.href = "../erro.html";
}

// Funções para tema e fonte global
function applyTheme(theme) {
  const body = document.body;
  if (theme === "dark") {
    body.classList.add("dark-mode");
    body.classList.remove("theme-light");
  } else {
    body.classList.remove("dark-mode");
    body.classList.add("theme-light");
  }
}

function applyFontSize(size) {
  const body = document.body;
  if (size === "large") {
    body.classList.add("large-font");
  } else {
    body.classList.remove("large-font");
  }

  if (size === "small") {
    body.classList.add("small-font");
  } else {
    body.classList.remove("small-font");
  }
}

function applyUserPreferences() {
  const savedTheme = localStorage.getItem("user-theme") || "light";
  const savedFontSize = localStorage.getItem("user-font") || "normal";
  applyTheme(savedTheme);
  applyFontSize(savedFontSize);
}

document.addEventListener("DOMContentLoaded", applyUserPreferences);

// redireciona o usuário conforme o login
function redirecionarUsuarioOuLogin() {
  const user = JSON.parse(localStorage.getItem("usuarioLogado"));
  if (user && user.usuario && user.email) {
    window.location.href = "../HomePage/user.html";
  } else {
    window.location.href = "#";
  }
}

// Garante que tema e fonte sejam reaplicados ao voltar para a página
window.addEventListener("pageshow", applyUserPreferences);
