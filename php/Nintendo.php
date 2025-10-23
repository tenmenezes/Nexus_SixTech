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
    <title>Nintendo</title>
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
                <a href="./Nintendo.php"><img src="../utils/img/LogoNintendo.png" alt="Nintendo" width="20" />
                    Nintendo</a>
            </li>
            <li class="link3">
                <a href="./Playstation.php"><img src="../utils/img/LogoPS.png" alt="PlayStation" width="20" />
                    PlayStation</a>
            </li>
        </ul>
    </div>

    <!--  Grid dos jogos  -->
    <main class="main-content container">
        <div class="product-grid" id="product-grid">
            <div class="product-card">
                <img id="imagem" src="../utils/img_games_nintendo/bomberman-generation-17334.jpg" alt="Bomberman" />
                <div class="product-info">
                    <h3 id="nome">Bomberman</h3>
                    <p id="preco" class="price">R$ 419.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_nintendo/Earthworm_Jim_Super.jpg" alt="Earthworm" />
                <div class="product-info">
                    <h3 id="nome">Earthworm</h3>
                    <p id="preco" class="price">R$ 449.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_nintendo/castlevania_dracula_x.jpg"
                    alt="Castlevania Drácula X" />
                <div class="product-info">
                    <h3 id="nome">Castlevania - Drácula X</h3>
                    <p id="preco" class="price">R$ 139.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_nintendo/Final_Fight.jpg" alt="Final Fight" />
                <div class="product-info">
                    <h3 id="nome">Final Fight</h3>
                    <p id="preco" class="price">R$ 99.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>
            <div class="product-card">
                <img id="imagem" src="../utils/img_games_nintendo/Legend_of_Zelda_Breath_of_the_Wild_capa.png"
                    alt="Legend of Zelda" />
                <div class="product-info">
                    <h3 id="nome">Legend of Zelda</h3>
                    <p id="preco" class="price">R$ 299.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_nintendo/Super_Mario_64.jpg" alt="Super Mario 64" />
                <div class="product-info">
                    <h3 id="nome">Super Mario 64</h3>
                    <p id="preco" class="price">R$ 149.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_nintendo/Super_Mario_Allstar.jpg" alt="Super Mario allstar" />
                <div class="product-info">
                    <h3 id="nome">Super Mario allstar</h3>
                    <p id="preco" class="price">R$ 249.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_nintendo/Super_Mario_Party.png" alt="Mario Party" />
                <div class="product-info">
                    <h3 id="nome">Mario Party</h3>
                    <p id="preco" class="price">R$ 349.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_nintendo/Mario Kart 8 S pass.jpg" alt="Mario Kart" />
                <div class="product-info">
                    <h3 id="nome">Mario Kart 8 Deluxe</h3>
                    <p id="preco" class="price">R$ 199.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_nintendo/the-legend-of-zelda-tears-of-the-kingdom_cover.jpg"
                    alt="Legend of Zelda TK" />
                <div class="product-info">
                    <h3 id="nome">The Legend of Zelda TK</h3>
                    <p id="preco" class="price">R$ 249.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
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
                    <a href="https://github.com/Bruno-Washington"><i class="fa-solid fa-arrow-up-right-from-square"
                            style="font-size: 14px;"></i> Bruno Washington</a> <br />
                    <a href="https://github.com/ClaudinoGomes"><i class="fa-solid fa-arrow-up-right-from-square"
                            style="font-size: 14px;"></i> Carlos Eduardo</a> <br />
                    <a href="https://github.com/FredWallace"><i class="fa-solid fa-arrow-up-right-from-square"
                            style="font-size: 14px;"></i> Fred Wallace</a> <br />
                    <a href="https://github.com/Thiago-Rock"><i class="fa-solid fa-arrow-up-right-from-square"
                            style="font-size: 14px;"></i> Thiago Rocha</a> <br />
                    <a href="https://github.com/YasmimMantovani"><i class="fa-solid fa-arrow-up-right-from-square"
                            style="font-size: 14px;"></i> Yasmim Mantovani</a> <br />
                    <a href="http://github.com/tenmenezes"><i class="fa-solid fa-arrow-up-right-from-square"
                            style="font-size: 14px;"></i> Yago Menezes </a>
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