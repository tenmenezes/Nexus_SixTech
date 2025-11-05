<?php
session_start();

if (!empty($_SESSION['user_login'])) {
    $usuario = $_SESSION['user_login'];
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <link rel="shortcut icon" href="../utils/gamepad.png" type="image/x-icon">

    <link rel="stylesheet" href="../css/homePage.css" />
    <link rel="stylesheet" href="../css/carrossel.css" />
    <title>Home Page</title>
</head>

<body>
    <!-- Cabeçalho com logo, menu e usuário -->
    <header>
        <div class="logo">
            <a href="./Index.php" aria-label="Página inicial">
                <img src="../utils/img/imgProject.png" alt="Logo GameStore" />
            </a>
        </div>

        <!-- Menu padrão visível apenas em telas grandes -->
        <nav class="main-menu">
            <ul>
                <li class="link1">
                    <a href="./Xbox.php"><img src="../utils/img/logoXbox.png" alt="Xbox" width="30" />
                        <h2>Xbox</h2>
                    </a>
                </li>
                <li class="link2">
                    <a href="./Nintendo.php"><img src="../utils/img/LogoNintendo.png" alt="Nintendo" width="35" />
                        <h2>Nintendo</h2>
                    </a>
                </li>
                <li class="link3">
                    <a href="./Playstation.php"><img src="../utils/img/LogoPS.png" alt="PlayStation" width="30" />
                        <h2>PlayStation</h2>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="user-info">

            <?php if (empty($usuario)) {
                echo "<a href='login.php'><img src='../utils/img/user.png' alt='Avatar' class='avatar'/></a>";
            } else {
                echo "<img src='../utils/img/user.png' alt='Avatar' class='avatar' />";
                echo "<a href='logout.php'><span id='user-name' class='user-color'>";
                echo $usuario;
                echo "</span></a>";
            } ?>
            <div class="cart-icon" id="cart-icon">
                <a href="Cart.html">🛒</a>
                <span class="cart-count" id="cart-count"></span>
            </div>

            <button class="menu-toggle" onclick="toggleMenu()"><i class="fa-solid fa-bars"></i></button>
        </div>
    </header>

    <!-- Menu flutuante para mobile -->
    <div id="floating-menu" class="floating-menu">
        <ul>
            <li class="link1">
                <a href="./Xbox.php"><img src="../utils/img/logoXbox.png" alt="Xbox" width="20" />
                    Xbox</a>
            </li>
            <li class="link2">
                <a href="./Nintendo.php"><img src="../utils/img/LogoNintendo.png" alt="Nintendo" width="20" />
                    Nintendo</a>
            </li>
            <li class="link3">
                <a href="./Playstation.php"><img src="../utils/img/LogoPS.png" alt="PlayStation" width="20" />
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
        <a href="Playstation.html" target="_blank">
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
        <a href="Xbox.html" target="_blank">
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
        <a href="Nintendo.html" target="_blank">
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

    <!-- Footer -->

    <footer>
        <div class="footer-grid">
            <div class="col-info">
                <h4>Nexus SixTech</h4>
                <p>&copy; 2025 - Todos os direitos reservados.</p>
                <p>Rio de Janeiro, Brasil</p>
            </div>

            <div class="col-links">
                <h4>Navegação</h4>
                <ul>
                    <li><a href="../html/sobre.html">Sobre Nós</a></li>
                    <li><a href="../html/termos.html">Termos de Uso</a></li>
                    <li><a href="../html/politica.html">Política de Privacidade</a></li>
                    <li><a href="../html/fale_conosco.html">Fale Conosco</a></li>
                </ul>
            </div>

            <div class="col-team">
                <h4>Desenvolvido por</h4>
                <p>
                    <a href="https://github.com/Bruno-Washington"> Bruno Washington</a>
                    <br />
                    <a href="https://github.com/ClaudinoGomes"> Carlos Eduardo</a>
                    <br />
                    <a href="https://github.com/FredWallace"> Fred Wallace</a>
                    <br />
                    <a href="https://github.com/Thiago-Rock"> Thiago Rocha</a>
                    <br />
                    <a href="https://github.com/YasmimMantovani"> Yasmim Mantovani</a>
                    <br />
                    <a href="http://github.com/tenmenezes"> Yago Menezes </a>
                </p>
            </div>

            <div class="col-social">
                <h4 class="text-social">Siga-nos</h4>
                <div class="social-icons">
                    <a href="#" target="_blank" aria-label="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="https://github.com/tenmenezes/Nexus_SixTech" target="_blank" aria-label="GitHub">
                        <i class="fa-brands fa-github"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="../js/homePage.js"></script>
    <script src="../js/utils.js"></script>
    <script src="../js/Cart.js"></script>
</body>

</html>