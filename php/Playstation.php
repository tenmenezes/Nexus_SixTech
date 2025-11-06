<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <link rel="shortcut icon" href="../utils/gamepad.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/homePage.css" />
    <link rel="stylesheet" href="../css/gamepagestyle.css" />
    <title>Loja de Jogos</title>
</head>

<body>
    <!-- Cabeçalho com logo, menu e usuário -->
    <header>
        <div class="logo">
            <a href="./Index.php" aria-label="Página inicial">
                <img src="../utils/img/imgProject-removebg-preview.png" alt="Logo GameStore" />
            </a>
        </div>

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
            <img src="../utils/img/user.png" alt="Avatar" class="avatar" />
            <a href="./user.php"><span id="user-name" class="user-color">Usuário</span></a>
            <div class="cart-icon" id="cart-icon">
                <a href="./Cart.php">🛒</a>
                <span class="cart-count" id="cart-count"></span>
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
                <a href="./Nintendo.php"><img src="../utils/img/LogoNintendo.png" alt="Nintendo"
                        width="20" />Nintendo</a>
            </li>
            <li class="link3">
                <a href="./Playstation.php"><img src="../utils/img/LogoPS.png" alt="PlayStation"
                        width="20" />PlayStation</a>
            </li>
        </ul>
    </div>

    <!--  Grid dos jogos  -->
    <main class="main-content container">
        <div class="product-grid" id="product-grid">
            <div class="product-card">
                <img id="imagem" src="../utils/img_games_playstation/ghost-of-yotei-game-3840x2160-19048.jpg"
                    alt="Ghost Of Yotei" />
                <div class="product-info">
                    <h3 id="nome">Ghost Of Yotei</h3>
                    <p id="preco" class="price">R$ 399.90</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>
            <div class="product-card">
                <img id="imagem" src="../utils/img_games_playstation/thealters.png" alt="The Alters" />
                <div class="product-info">
                    <h3 id="nome">The Alters</h3>
                    <p id="preco" class="price">R$ 249.90</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>
            <div class="product-card">
                <img id="imagem" src="../utils/img_games_playstation/GodofWar.jpg" alt="God of War" />
                <div class="product-info">
                    <h3 id="nome">God of War</h3>
                    <p id="preco" class="price">R$ 229.99</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>
            <div class="product-card">
                <img id="imagem" src="../utils/img_games_playstation/Fallout76.jpg" alt="Fallout 76" />
                <div class="product-info">
                    <h3 id="nome">Fallout 76</h3>
                    <p id="preco" class="price">R$ 129.99</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>
            <div class="product-card">
                <img id="imagem" src="../utils/img_games_playstation/UntilDawn.jpg" alt="Until Dawn" />
                <div class="product-info">
                    <h3 id="nome">Until Dawn</h3>
                    <p id="preco" class="price">R$ 199.99</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>
            <div class="product-card">
                <img id="imagem" src="../utils/img_games_playstation/Wildarms.jpg" alt="Wild Arms After Code: F" />
                <div class="product-info">
                    <h3 id="nome">Wild Arms After Code: F</h3>
                    <p id="preco" class="price">R$ 99.99</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>
            <div class="product-card">
                <img id="imagem" src="../utils/img_games_playstation/dinocrisis.jpg" alt="Dino Crisis" />
                <div class="product-info">
                    <h3 id="nome">Dino Crisis</h3>
                    <p id="preco" class="price">R$ 189.99</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>
            <div class="product-card">
                <img id="imagem" src="../utils/img_games_playstation/starwars.jpg" alt="Lego Star Wars" />
                <div class="product-info">
                    <h3 id="nome">Lego Star Wars</h3>
                    <p id="preco" class="price">R$ 89.99</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_playstation/Star_Wars_Jedi_Fallen_Order_capa.png"
                    alt="Star Wars Jedi Fallen Order" />
                <div class="product-info">
                    <h3 id="nome">Jedi Fallen Order</h3>
                    <p id="preco" class="price">R$ 99.90</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_playstation/Ghost_of_Tsushima_capa.png"
                    alt="Ghost of Tsushima" />
                <div class="product-info">
                    <h3 id="nome">Ghost of Tsushima</h3>
                    <p id="preco" class="price">R$ 299.99</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>
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