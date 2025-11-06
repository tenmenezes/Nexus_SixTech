<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <link rel="shortcut icon" href="../utils/gamepad.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/homePage.css" />
    <link rel="stylesheet" href="../css/gamepagestyle.css" />
    <title>Xbox</title>
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
                <img id="imagem" src="../utils/img_games_x-box/senuasSacrifice.jpg" alt="Hellblade Senua's Sacrifice" />
                <div class="product-info">
                    <h3 id="nome">Senua's Sacrifice</h3>
                    <p id="preco" class="price">R$ 99.90</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_x-box/senuasSaga.jpg" alt="Senua's Saga Hellblade II" />
                <div class="product-info">
                    <h3 id="nome">Senua's Hellblade II</h3>
                    <p id="preco" class="price">R$ 199.90</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_x-box/Doom.jpg" alt="Doom" />
                <div class="product-info">
                    <h3 id="nome">Doom</h3>
                    <p id="preco" class="price">R$ 119.99</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_x-box/Forza_Motorsport_6.jpg" alt="Forza Motorsport 6" />
                <div class="product-info">
                    <h3 id="nome">Forza Motorsport 6</h3>
                    <p id="preco" class="price">R$ 249.99</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_x-box/Dishonored 2.jpg" alt="Dishonored 2" />
                <div class="product-info">
                    <h3 id="nome">Dishonored 2</h3>
                    <p id="preco" class="price">R$ 199.99</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_x-box/Halo_Infinite_capa.png" alt="Halo Infinite" />
                <div class="product-info">
                    <h3 id="nome">Halo Infinite</h3>
                    <p id="preco" class="price">R$ 139.99</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_x-box/Sea-Of-Thieves-Emblema.jpg" alt="Sea of Thieves" />
                <div class="product-info">
                    <h3 id="nome">Sea of Thieves</h3>
                    <p id="preco" class="price">R$ 79.99</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_x-box/gears of wars.png" alt="Gears of War: E-Day" />
                <div class="product-info">
                    <h3 id="nome">Gears of Wars</h3>
                    <p id="preco" class="price">R$ 159.99</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_x-box/dishonored.jpg" alt="Dishonored" />
                <div class="product-info">
                    <h3 id="nome">Dishonored</h3>
                    <p id="preco" class="price">R$ 199.90</p>
                    <button class="add-to-cart-btn">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/img_games_x-box/doomEternal.jpg" alt="Doom Eternal" />
                <div class="product-info">
                    <h3 id="nome">Doom Eternal</h3>
                    <p id="preco" class="price">R$ 99.90</p>
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