<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Carrinho</title>
  <link rel="stylesheet" href="../css/homePage.css" />
  <link rel="stylesheet" href="../css/gamepagestyle.css" />
</head>

<body>
  <!-- Cabeçalho com logo, menu e usuário -->
  <header>
    <div class="logo">
      <a href="index.php" aria-label="Página inicial">
        <img src="../utils/img/imgProject-removebg-preview.png" alt="Logo GameStore" />
      </a>
    </div>

    <!-- Menu padrão (visível apenas em telas grandes) -->
    <nav class="main-menu">
      <ul>
        <li class="link1">
          <a href="Xbox.html"><img src="../utils/img/logoXbox.png" alt="Xbox" width="30" />
            <h2>Xbox</h2>
          </a>
        </li>
        <li class="link2">
          <a href="Nintendo.html"><img
              src="../utils/img/LogoNintendo.png"
              alt="Nintendo"
              width="30" />
            <h2>Nintendo</h2>
          </a>
        </li>
        <li class="link3">
          <a href="Playstation.html"><img
              src="../utils/img/LogoPS.png"
              alt="PlayStation"
              width="30" />
            <h2>PlayStation</h2>
          </a>
        </li>
      </ul>
    </nav>

    <div class="user-info">
      <img src="../utils/img/user.png" alt="Avatar" class="avatar" />
      <a href="user.html"><span id="user-name" class="user-color">Usuário</span></a>

      <div class="cart-icon" id="cart-icon">
        🛒 <span class="cart-count" id="cart-count">0</span>
      </div>
    </div>

    <button class="menu-toggle" onclick="toggleMenu()">☰</button>
  </header>

  <!-- Menu flutuante para mobile -->
  <div id="floating-menu" class="floating-menu">
    <ul>
      <li class="link1">
        <a href="Xbox.html"><img src="../utils/img/logoXbox.png" alt="Xbox" width="20" />
          Xbox</a>
      </li>
      <li class="link2">
        <a href="Nintendo.html"><img
            src="../utils/img/LogoNintendo.png"
            alt="Nintendo"
            width="20" />
          Nintendo</a>
      </li>
      <li class="link3">
        <a href="Playstation.html"><img src="../utils/img/LogoPS.png" alt="PlayStation" width="20" />
          PlayStation</a>
      </li>
    </ul>
  </div>

  <main class="main-content container">
    <div class="product-grid" id="product-grid"></div>
    <div class="finalizar">
      <button class="btn-finalizar">Finalizar Compra</button>
    </div>
  </main>

  <footer>
    <p>
      &copy; 2025 Nexus SixTech - Todos os direitos reservados. <br />
      <br />
      Bruno Washington<br /><br />
      Carlos Eduardo<br /><br />
      Fred Santos<br /><br />
      Thiago Rocha<br /><br />
      Yasmim Mantovani<br /><br />
      Yago Menezes
    </p>
  </footer>

  <script>
    const user = JSON.parse(localStorage.getItem("usuarioLogado"));
    if (user && user.usuario) {
      document.getElementById("user-name").textContent = user.usuario;
    } else {
      document.getElementById("user-name").textContent = "Usuário";
    }
  </script>

  <script src="../js/homePage.js"></script>
  <script src="../js/Cart.js"></script>
  <script src="../js/utils.js"></script>
</body>

</html>