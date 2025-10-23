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
    <link rel="stylesheet" href="../css/gamepagestyle.css" />
    <title>Carrinho</title>
</head>

<body>
    <!-- Cabeçalho com logo, menu e usuário -->
    <header>
        <div class="logo">
            <a href="./Index.php" aria-label="Página inicial">
                <img src="../utils/img/imgProject-removebg-preview.png" alt="Logo GameStore" />
            </a>
        </div>

        <!-- Menu padrão (visível apenas em telas grandes) -->
        <nav class="main-menu">
            <ul>
                <li class="link1">
                    <a href="./Xbox.php"><img src="../utils/img/logoXbox.png" alt="Xbox" width="30" />
                        <h2>Xbox</h2>
                    </a>
                </li>
                <li class="link2">
                    <a href="./Nintendo.php"><img src="../utils/img/LogoNintendo.png" alt="Nintendo" width="30" />
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
            <img src="../utils/img/user.png" alt="Avatar" class="avatar" />
            <a href="./user.php"><span id="user-name" class="user-color">Usuário</span></a>

            <div class="cart-icon" id="cart-icon">
                🛒 <span class="cart-count" id="cart-count">0</span>
            </div>
        </div>

        <button class="menu-toggle" onclick="toggleMenu()"><i class="fa-solid fa-bars"></i></button>
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

    <main class="main-content container">
        <div class="product-grid" id="product-grid"></div>
        <div class="finalizar">
            <button class="btn-finalizar">Finalizar Compra</button>
        </div>
    </main>

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
                    Bruno Washington <br />
                    Carlos Eduardo <br />
                    Fred Santos <br />
                    Thiago Rocha <br />
                    Yasmim Mantovani <br />
                    Yago Menezes
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
    <script src="../js/Cart.js"></script>
    <script src="../js/utils.js"></script>
</body>

</html>