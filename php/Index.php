<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home Page</title>
    <link rel="stylesheet" href="../css/homePage.css" />
    <link rel="stylesheet" href="../css/carrossel.css" />
</head>

<body>
    <!-- Cabeçalho com logo, menu e usuário -->
    <header>
        <div class="logo">
            <a href="index.php" aria-label="Página inicial">
                <img src="../utils/img/imgProject-removebg-preview.png" alt="Logo GameStore" />
            </a>
        </div>

        <!-- Menu padrão visível apenas em telas grandes -->
        <nav class="main-menu">
            <ul>
                <li class="link1">
                    <a href="Xbox.html"><img src="../utils/img/logoXbox.png" alt="Xbox" width="30" />
                        <h2>Xbox</h2>
                    </a>
                </li>
                <li class="link2">
                    <a href="Nintendo.html"><img src="../utils/img/LogoNintendo.png" alt="Nintendo" width="35" />
                        <h2>Nintendo</h2>
                    </a>
                </li>
                <li class="link3">
                    <a href="Playstation.php"><img src="../utils/img/LogoPS.png" alt="PlayStation" width="30" />
                        <h2>PlayStation</h2>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="user-info">
            <img src="../utils/img/user.png" alt="Avatar" class="avatar" />
            <a href="user.html"><span id="user-name" class="user-color">Usuário</span></a>
            <div class="cart-icon" id="cart-icon">
                <a href="Cart.php">🛒</a>
                <span class="cart-count" id="cart-count"></span>
            </div>

            <button class="menu-toggle" onclick="toggleMenu()">☰</button>
        </div>
    </header>

    <!-- Menu flutuante para mobile -->
    <div id="floating-menu" class="floating-menu">
        <ul>
            <li class="link1">
                <a href="Xbox.php"><img src="../utils/img/logoXbox.png" alt="Xbox" width="20" />
                    Xbox</a>
            </li>
            <li class="link2">
                <a href="../HomePage/Nintendo.html"><img src="../utils/img/LogoNintendo.png" alt="Nintendo"
                        width="20" />
                    Nintendo</a>
            </li>
            <li class="link3">
                <a href="Playstation.php"><img src="../utils/img/LogoPS.png" alt="PlayStation" width="20" />
                    PlayStation</a>
            </li>
        </ul>
    </div>

    <!-- Seção Banner -->
    <section class="hero slider">
        <div class="slide-track">
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-Nintendo-Studios.jpg" alt="Banner Nintendo Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-PS-Studios.jpg" alt="Banner PS Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-xbox-Studios.jpg" alt="Banner Xbox Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-Nintendo-Studios.jpg" alt="Banner Nintendo Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-PS-Studios.jpg" alt="Banner PS Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-xbox-Studios.jpg" alt="Banner Xbox Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-Nintendo-Studios.jpg" alt="Banner Nintendo Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-PS-Studios.jpg" alt="Banner PS Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-xbox-Studios.jpg" alt="Banner Xbox Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-Nintendo-Studios.jpg" alt="Banner Nintendo Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-PS-Studios.jpg" alt="Banner PS Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-xbox-Studios.jpg" alt="Banner Xbox Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-Nintendo-Studios.jpg" alt="Banner Nintendo Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-PS-Studios.jpg" alt="Banner PS Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-xbox-Studios.jpg" alt="Banner Xbox Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-Nintendo-Studios.jpg" alt="Banner Nintendo Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-PS-Studios.jpg" alt="Banner PS Studios" />
            </div>
            <div class="slide">
                <img class="img" src="../utils/img_Banner/Banner-xbox-Studios.jpg" alt="Banner Xbox Studios" />
            </div>
        </div>
    </section>

    <!-- Grid de jogos em destaque -->
    <section class="jogos" id="playstation">
        <h2>PlayStation</h2>
        <a href="Playstation.php" target="_blank">
            <div class="grid">
                <div class="jogo">
                    <img src="../utils/img/ghost-of-yotei-game-3840x2160-19048.jpg" alt="Ghost Of Yotei" />
                    <h3>Ghost Of Yotei</h3>
                    <p>R$ 399,90</p>
                </div>
                <div class="jogo">
                    <img src="../utils/img_games_playstation/the-alters.jpg" alt="The Alters" />
                    <h3>The Alters</h3>
                    <p>R$ 249,90</p>
                </div>
            </div>
        </a>
    </section>

    <section class="jogos" id="xbox">
        <h2>Xbox</h2>
        <a href="Xbox.php" target="_blank">
            <div class="grid">
                <div class="jogo">
                    <img src="../utils/img_games_x-box/senuasSacrifice.jpg" alt="Hellblade Senua's Sacrifice" />
                    <h3>Hellblade Senua's Sacrifice</h3>
                    <p>R$ 99,90</p>
                </div>
                <div class="jogo">
                    <img src="../utils/img_games_x-box/senuasSaga.jpg" alt="Senua's Saga Hellblade II" />
                    <h3>Senua's Saga Hellblade II</h3>
                    <p>R$ 199,90</p>
                </div>
            </div>
        </a>
    </section>

    <section class="jogos" id="nintendo">
        <h2>Nintendo</h2>
        <a href="Nintendo.php" target="_blank">
            <div class="grid">
                <div class="jogo">
                    <img src="../utils/img/capaNint.jpg" alt="Zelda: Tears of the Kingdom" />
                    <h3>Zelda: Tears of the Kingdom</h3>
                    <p>R$ 249,99</p>
                </div>
                <div class="jogo">
                    <img src="../utils/img/capaNint2.jpg" alt="MarioKart 8 Deluxe" />
                    <h3>MarioKart 8 Deluxe</h3>
                    <p>R$ 199,99</p>
                </div>
            </div>
        </a>
    </section>

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
    <script src="../js/utils.js"></script>
    <script src="../js/Cart.js"></script>
</body>

</html>