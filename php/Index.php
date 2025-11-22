<?php
require_once 'Conn.php';
//session_start();

if (!empty($_SESSION['user_login'])) {
    $usuario = $_SESSION['user_login'];
}

$pdo = getDbConnection();

function fetchGamesByPlatform($pdo, $platform)
{
    $stmt = $pdo->prepare("SELECT id, nome, preco, img, plataforma FROM games WHERE plataforma = :platform");
    $stmt->execute(['platform' => $platform]);
    return $stmt->fetchAll();
}

$games_nintendo = fetchGamesByPlatform($pdo, 'Nintendo');
$games_xbox = fetchGamesByPlatform($pdo, 'Xbox');
$games_playstation = fetchGamesByPlatform($pdo, 'PlayStation');
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
    <link rel="stylesheet" href="../css/gamepagestyle.css" />
    <title>Home Page</title>
</head>

<body>
    <!-- Cabeçalho com logo, menu e usuário -->
    <header>
        <div class="logo">
            <a href="#index" aria-label="Página inicial">
                <img src="../utils/img/imgProject.png" alt="Logo GameStore" />
            </a>
        </div>

        <!-- Menu padrão -->
        <nav class="main-menu">
            <ul>
                <li class="link1">
                    <a href="#xbox">
                        <img src="../utils/img/logoXbox.png" alt="Xbox" width="30" />
                        <h2>Xbox</h2>
                    </a>
                </li>
                <li class="link2">
                    <a href="#nintendo">
                        <img src="../utils/img/LogoNintendo.png" alt="Nintendo" width="35" />
                        <h2>Nintendo</h2>
                    </a>
                </li>
                <li class="link3">
                    <a href="#playstation">
                        <img src="../utils/img/LogoPS.png" alt="PlayStation" width="30" />
                        <h2>PlayStation</h2>
                    </a>
                </li>
            </ul>
        </nav>



        <div class="user-info">
            <?php
            if (empty($usuario)) {
                echo "<a href='login.php'><img src='../utils/img/user.png' alt='Avatar' class='avatar'/></a>";
            } else {
                echo "<img src='../utils/img/user.png' alt='Avatar' class='avatar' />";
                echo "<a href='logout.php'><span id='user-name' class='user-color'>";
                echo $usuario;
                echo "</span></a>";
            }
            ?>
            <div class="cart-icon" id="cart-icon">
                <a href="#cart">🛒</a>
                <span class="cart-count" id="cart-count"></span>
            </div>
            <button class="menu-toggle" onclick="toggleMenu()"><i class="fa-solid fa-bars"></i></button>
        </div>
    </header>

    <!-- Menu flutuante (mobile) -->
    <div id="floating-menu" class="floating-menu">
        <ul>
            <li class="link1">
                <a href="#xbox"><img src="../utils/img/logoXbox.png" alt="Xbox" width="20" /> Xbox</a>
            </li>
            <li class="link2">
                <a href="#nintendo"><img src="../utils/img/LogoNintendo.png" alt="Nintendo" width="20" /> Nintendo</a>
            </li>
            <li class="link3">
                <a href="#playstation"><img src="../utils/img/LogoPS.png" alt="PlayStation" width="20" /> PlayStation</a>
            </li>
        </ul>
    </div>

    <!-- Banner -->
    <section class="hero slider">
        <div class="slide-track">
            <div class="slide"><img class="img" src="https://i.pinimg.com/736x/13/d0/7f/13d07f394cad940c0d8c29c584eaa386.jpg" alt="Banner Nintendo Studios" /></div>
            <div class="slide"><img class="img" src="https://i.pinimg.com/736x/c3/3a/f4/c33af491155df90cc332ad51f82ae445.jpg" alt="Banner PS Studios" /></div>
            <div class="slide"><img class="img" src="https://i.pinimg.com/736x/a6/d3/ee/a6d3ee8694c75e68b129b716df23fd9f.jpg" alt="Banner Xbox Studios" /></div>
            <div class="slide"><img class="img" src="https://i.pinimg.com/736x/13/d0/7f/13d07f394cad940c0d8c29c584eaa386.jpg" alt="Banner Nintendo Studios" /></div>
            <div class="slide"><img class="img" src="https://i.pinimg.com/736x/c3/3a/f4/c33af491155df90cc332ad51f82ae445.jpg" alt="Banner PS Studios" /></div>
            <div class="slide"><img class="img" src="https://i.pinimg.com/736x/a6/d3/ee/a6d3ee8694c75e68b129b716df23fd9f.jpg" alt="Banner Xbox Studios" /></div>
            <div class="slide"><img class="img" src="https://i.pinimg.com/736x/13/d0/7f/13d07f394cad940c0d8c29c584eaa386.jpg" alt="Banner Nintendo Studios" /></div>
            <div class="slide"><img class="img" src="https://i.pinimg.com/736x/c3/3a/f4/c33af491155df90cc332ad51f82ae445.jpg" alt="Banner PS Studios" /></div>
            <div class="slide"><img class="img" src="https://i.pinimg.com/736x/a6/d3/ee/a6d3ee8694c75e68b129b716df23fd9f.jpg" alt="Banner Xbox Studios" /></div>
            <div class="slide"><img class="img" src="https://i.pinimg.com/736x/13/d0/7f/13d07f394cad940c0d8c29c584eaa386.jpg" alt="Banner Nintendo Studios" /></div>
            <div class="slide"><img class="img" src="https://i.pinimg.com/736x/c3/3a/f4/c33af491155df90cc332ad51f82ae445.jpg" alt="Banner PS Studios" /></div>
            <div class="slide"><img class="img" src="https://i.pinimg.com/736x/a6/d3/ee/a6d3ee8694c75e68b129b716df23fd9f.jpg" alt="Banner Xbox Studios" /></div>
            <div class="slide"><img class="img" src="https://i.pinimg.com/736x/13/d0/7f/13d07f394cad940c0d8c29c584eaa386.jpg" alt="Banner Nintendo Studios" /></div>
            <div class="slide"><img class="img" src="https://i.pinimg.com/736x/c3/3a/f4/c33af491155df90cc332ad51f82ae445.jpg" alt="Banner PS Studios" /></div>
            <div class="slide"><img class="img" src="https://i.pinimg.com/736x/a6/d3/ee/a6d3ee8694c75e68b129b716df23fd9f.jpg" alt="Banner Xbox Studios" /></div>
        </div>
    </section>

    <!-- Seção Home -->
    <section class="content-section active-section" id="index">
        <div class="jogos" id="destaque-playstation">
            <h2>PlayStation</h2>
            <div class="grid">
                <div class="jogo">
                    <img src="https://i.pinimg.com/736x/3d/e1/4f/3de14f998b8a7fc943f780a57c3718e8.jpg" alt="Ghost Of Yotei" />
                    <h3>Ghost Of Yotei</h3>
                    <p>R$ 399,90</p>
                </div>
                <div class="jogo">
                    <img src="https://i.pinimg.com/736x/3f/13/d6/3f13d62d1c3b06f9888f821efed0293e.jpg" alt="The Alters" />
                    <h3>The Alters</h3>
                    <p>R$ 249,90</p>
                </div>
            </div>
        </div>

        <div class="jogos" id="destaque-xbox">
            <h2>Xbox</h2>
            <div class="grid">
                <div class="jogo">
                    <img src="https://i.pinimg.com/736x/e0/37/69/e03769d041d6ff4526e4a767fd285d07.jpg" alt="Hellblade Senua's Sacrifice" />
                    <h3>Hellblade Senua's Sacrifice</h3>
                    <p>R$ 99,90</p>
                </div>
                <div class="jogo">
                    <img src="https://i.pinimg.com/736x/a8/f6/61/a8f6611bb6520d0d5ad3e41960f18196.jpg" alt="Senua's Saga Hellblade II" />
                    <h3>Senua's Saga Hellblade II</h3>
                    <p>R$ 199,90</p>
                </div>
            </div>
        </div>

        <div class="jogos" id="destaque-nintendo">
            <h2>Nintendo</h2>
            <div class="grid">
                <div class="jogo">
                    <img src="https://i.pinimg.com/736x/fc/29/86/fc2986995dabf4436c80cc67662dd5e8.jpg" alt="Zelda: Tears of the Kingdom" />
                    <h3>Zelda: Tears of the Kingdom</h3>
                    <p>R$ 249,99</p>
                </div>
                <div class="jogo">
                    <img src="https://i.pinimg.com/736x/27/87/78/278778d3778694a01d340de8746d6625.jpg" alt="MarioKart 8 Deluxe" />
                    <h3>MarioKart 8 Deluxe</h3>
                    <p>R$ 199,99</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Seções Xbox / Nintendo / PlayStation -->
    <!-- Seção XBOX -->
    <section class="content-section hidden" id="xbox">

        <main class="main-content container">
            <div class="product-grid" id="product-grid-xbox">
                <?php if (!empty($games_xbox)): ?>
                    <?php foreach ($games_xbox as $game): ?>
                        <div class="product-card">
                            <img id="imagem" src="<?php echo htmlspecialchars($game['img']); ?>" alt="<?php echo htmlspecialchars($game['nome']); ?>" />
                            <div class="product-info">
                                <h3 id="nome"><?php echo htmlspecialchars($game['nome']); ?></h3>
                                <p id="preco">R$ <?php echo number_format($game['preco'], 2, ',', '.'); ?></p>
                                <button class="add-to-cart-btn" onclick="adicionarAoCarrinho(<?php echo (int)$game['id']; ?>)">
                                    Comprar
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Nenhum jogo encontrado.</p>
                <?php endif; ?>
            </div>
        </main>
    </section>

    <!-- Seção NINTENDO -->
    <section class="content-section hidden" id="nintendo">
        <main class="main-content container">
            <div class="product-grid" id="product-grid-nintendo">
                <?php if (!empty($games_nintendo)): ?>
                    <?php foreach ($games_nintendo as $game): ?>
                        <div class="product-card">
                            <img id="imagem" src="<?php echo htmlspecialchars($game['img']); ?>" alt="<?php echo htmlspecialchars($game['nome']); ?>" />
                            <div class="product-info">
                                <h3 id="nome"><?php echo htmlspecialchars($game['nome']); ?></h3>
                                <p id="preco">R$ <?php echo number_format($game['preco'], 2, ',', '.'); ?></p>
                                <button class="add-to-cart-btn" onclick="adicionarAoCarrinho(<?php echo (int)$game['id']; ?>)">
                                    Comprar
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Nenhum jogo encontrado.</p>
                <?php endif; ?>
            </div>
        </main>
    </section>


    <!-- Seção PLAYSTATION -->
    <section class="content-section hidden" id="playstation">
        <main class="main-content container">
            <div class="product-grid" id="product-grid-playstation">
                <?php if (!empty($games_playstation)): ?>
                    <?php foreach ($games_playstation as $game): ?>
                        <div class="product-card">
                            <img id="imagem" src="<?php echo htmlspecialchars($game['img']); ?>" alt="<?php echo htmlspecialchars($game['nome']); ?>" />
                            <div class="product-info">
                                <h3 id="nome"><?php echo htmlspecialchars($game['nome']); ?></h3>
                                <p id="preco">R$ <?php echo number_format($game['preco'], 2, ',', '.'); ?></p>
                                <button class="add-to-cart-btn" onclick="adicionarAoCarrinho(<?php echo (int)$game['id']; ?>)">
                                    Comprar
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Nenhum jogo encontrado.</p>
                <?php endif; ?>
            </div>
        </main>
    </section>

    <!-- Carrinho de compras -->
    <section class="content-section hidden" id="cart">
        <main class="main-content container">
            <div class="product-grid" id="product-grid"></div>
            <div class="finalizar">
                <button class="btn-finalizar">Finalizar Compra</button>
            </div>
        </main>
    </section>

    <!-- Rodapé -->
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
                    <a href="https://github.com/Bruno-Washington">Bruno Washington</a><br />
                    <a href="https://github.com/ClaudinoGomes">Carlos Eduardo</a><br />
                    <a href="https://github.com/FredWallace">Fred Wallace</a><br />
                    <a href="https://github.com/Thiago-Rock">Thiago Rocha</a><br />
                    <a href="https://github.com/YasmimMantovani">Yasmim Mantovani</a><br />
                    <a href="http://github.com/tenmenezes">Yago Menezes</a>
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

    <!-- Scripts -->
    <script src="../js/homePage.js"></script>
    <script src="../js/utils.js"></script>
    <script src="../js/Cart.js"></script>
</body>

</html>