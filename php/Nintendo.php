<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nintendo</title>
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
                    <a href="Playstation.html"><img src="../utils/img/LogoPS.png" alt="PlayStation" width="30" />
                        <h2>PlayStation</h2>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="user-info">
            <img src="../utils/img/user.png" alt="Avatar" class="avatar" />
            <a href="user.html"><span id="user-name" class="user-color">Usuário</span></a>

            <div class="cart-icon" id="cart-icon">
                <a href="Cart.html">🛒</a>
                <span class="cart-count" id="cart-count"></span>
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
                <a href="Nintendo.html"><img src="../utils/img/LogoNintendo.png" alt="Nintendo" width="20" />
                    Nintendo</a>
            </li>
            <li class="link3">
                <a href="Playstation.html"><img src="../utils/img/LogoPS.png" alt="PlayStation" width="20" />
                    PlayStation</a>
            </li>
        </ul>
    </div>

    <!--  Grid dos jogos  -->
    <main class="main-content container">
        <div class="product-grid" id="product-grid">
            <div class="product-card">
                <img id="imagem" src="../utils/games_nintendo/bomberman-generation-17334.jpg" alt="Bomberman" />
                <div class="product-info">
                    <h3 id="nome">Bomberman</h3>
                    <p id="preco" class="price">R$ 419.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/games_nintendo/Earthworm_Jim_Super.jpg" alt="Earthworm" />
                <div class="product-info">
                    <h3 id="nome">Earthworm</h3>
                    <p id="preco" class="price">R$ 449.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/games_nintendo/castlevania_dracula_x.jpg" alt="Castlevania Drácula X" />
                <div class="product-info">
                    <h3 id="nome">Castlevania - Drácula X</h3>
                    <p id="preco" class="price">R$ 139.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/games_nintendo/Final_Fight.jpg" alt="Final Fight" />
                <div class="product-info">
                    <h3 id="nome">Final Fight</h3>
                    <p id="preco" class="price">R$ 99.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>
            <div class="product-card">
                <img id="imagem" src="../utils/games_nintendo/Legend_of_Zelda_Breath_of_the_Wild_capa.png"
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
                <img id="imagem" src="../utils/games_nintendo/Super_Mario_64.jpg" alt="Super Mario 64" />
                <div class="product-info">
                    <h3 id="nome">Super Mario 64</h3>
                    <p id="preco" class="price">R$ 149.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/games_nintendo/Super_Mario_Allstar.jpg" alt="Super Mario allstar" />
                <div class="product-info">
                    <h3 id="nome">Super Mario allstar</h3>
                    <p id="preco" class="price">R$ 249.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/games_nintendo/Super_Mario_Party.png" alt="Mario Party" />
                <div class="product-info">
                    <h3 id="nome">Mario Party</h3>
                    <p id="preco" class="price">R$ 349.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/games_nintendo/Mario Kart 8 S pass.jpg" alt="Mario Kart" />
                <div class="product-info">
                    <h3 id="nome">Mario Kart 8 Deluxe</h3>
                    <p id="preco" class="price">R$ 199.99</p>
                    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">
                        Comprar
                    </button>
                </div>
            </div>

            <div class="product-card">
                <img id="imagem" src="../utils/games_nintendo/the-legend-of-zelda-tears-of-the-kingdom_cover.jpg"
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