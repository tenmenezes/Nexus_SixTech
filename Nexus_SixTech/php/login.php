<?php

require_once 'Conn.php'; // Arquivo de conexão
// Garante que a sessão está iniciada.
include 'verificacao_2fa_modal.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Lógica de Redirecionamento 2FA:
// Se o usuário foi autenticado, mas ainda não verificou o 2FA, ele deve ver o modal.
if (isset($_SESSION['user_id']) && !isset($_SESSION['2fa_verified'])) {
    // Redireciona para o login.php com um indicador para abrir o modal.
    // Isso garante que o modal seja exibido mesmo após um refresh se a verificação falhou.
    if (!isset($_GET['show_2fa'])) {
        header('Location: login.php?show_2fa=1');
        exit;
    }
} elseif (isset($_SESSION['user_id']) && isset($_SESSION['2fa_verified'])) {
    // Se o login foi um sucesso E o 2FA foi verificado, redireciona para a página principal.
    header('Location: index.php'); // Redireciona para a página principal após sucesso total
    exit;
}

$mensagem = '';
$mostrar_modal_2fa = false;

// ----------------------------------------------------
// 1. LÓGICA DE LOGIN (POST)
// ----------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pdo = getDbConnection();

    // Use o email para login, mesmo que a coluna seja 'login' na sua consulta.
    $login_input = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $password_input = $_POST['senha'] ?? '';

    // 1. Busca o usuário no banco pelo email
    $sql = "SELECT id, login, password, user_type FROM users WHERE email = :login";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['login' => $login_input]);
    $user = $stmt->fetch();

    if ($user) {
        // 2. Verifica a senha com o hash armazenado
        if (password_verify($password_input, $user['password'])) {
            // Login bem-sucedido: inicia as variáveis de sessão, mas NÃO redireciona para index.php ainda!
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_login'] = $user['login'];
            $_SESSION['user_type'] = $user['user_type'];
            unset($_SESSION['2fa_verified']); // Remove a flag 2FA_verified se existir

            // Redireciona para exibir o modal 2FA, conforme a lógica acima.
            header('Location: login.php?show_2fa=1');
            exit;
        } else {
            $mensagem = '<div style="color: red;">Login ou Senha incorretos.</div>';
        }
    } else {
        $mensagem = '<div style="color: red;">Login ou Senha incorretos.</div>';
    }
}

// ----------------------------------------------------
// 2. LÓGICA DO MODAL 2FA (GET)
// ----------------------------------------------------
if (isset($_GET['show_2fa']) && isset($_SESSION['user_id'])) {
    // O usuário acabou de fazer login e precisa da verificação 2FA
    $mostrar_modal_2fa = true;
    
    // Inclui a lógica que define a pergunta (coluna) e armazena na sessão
   
    require_once 'verificacao_2fa_modal.php'; 
    
    // Pega a mensagem de erro da sessão, se houver (falha na verificação)
    $erro_2fa = $_SESSION['error_message'] ?? '';
    unset($_SESSION['error_message']); // Limpa a mensagem após exibir
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../css/login.css" />

     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <title>Login | Forgot Password</title>
  </head>
  <body>
    <div class="container" id="container">
        
      <div class="form-container sign-up-container">
        <form action="#">

          <h1 style="color: rgb(194, 181, 166);">Esqueceu a senha?</h1><br>  

        <div class="field input-box">
          <input id="emailforgot" name="emailforgot" type="email" placeholder=" " />
          <label for="emailforgot">E-mail *</label>
          <span class="error"></span>
        </div><br>

        <div class="field full input-box">
          <input id="senhaforgot" name="senhaforgot" type="password" placeholder=" " minlength="6" />
          <label for="senhaforgot">Nova senha *</label>
          <span class="error"></span>
        </div><br>

        <div class="field full input-box">
          <input id="senhaforgotConfirm" name="senhaforgotConfirm" type="password" placeholder=" " minlength="6" />
          <label for="senhaforgotConfirm">Senha *</label>
        </div><br>

          <button>Alterar</button>

        </form>
      </div>
      
      <div class="form-container sign-in-container">
        <form action="login.php" method="post">
            <h1 style="color: rgb(194, 181, 166);">Login</h1><br>

          <div class="field input-box">
            <input id="email" name="email" type="email" placeholder=" " />
            <label for="email">E-mail *</label>
            <span class="error"></span>
          </div><br>


          <div class="field full input-box">
            <input id="senha" name="senha" type="password" placeholder=" " minlength="6" />
            <label for="senha">Senha *</label>
            <span class="error"></span>
          </div>
          <div class="checkbox">
            <input type="checkbox" id="remember">
            <label for="remember" class="remember">Lembrar-me</label>
          </div>
            <button>Logar</button>
            <br>
            <?php echo $mensagem;?>          
            
        </form>
      </div>
      
      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-left">
            <h1>Bem vindo de volta!</h1>
            <p>
              Para continuar conectado conosco por favor insira seus dados nos
              determinados campos.
            </p>
            <button class="ghost" id="signIn">Logar</button>
          </div>
          <div class="overlay-panel overlay-right">
            <h1>Esqueceu a senha?</h1>
            <p>
              Digite seus dados para alteração de senha e tente logar novamente.
            </p>
            <button class="ghost" id="signUp">Mudar</button>
          </div>
        </div>
      </div>
    </div>

    <button id="musicControl">
      <i class="fa-solid fa-volume-xmark" style="color: red;"></i>
    </button>

   <?php if ($mostrar_modal_2fa): ?>
    
    <style>
        dialog#meuModal {
            width: 420px;
            border: none;
            border-radius: 16px;
            padding: 0;
            background: transparent;
            backdrop-filter: blur(10px);
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            position: fixed; /* Garante que fique no topo */
            top: 50%;
            left: 30%;
            transform: translate(-50%, -50%);
        }
        .modal-inner {
            background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.02));
            padding: 32px 36px;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            color: #e6e6e6;
        }
        dialog::backdrop { background-color: rgba(0,0,0,0.55); }
        .modal-actions { display:flex; gap:10px; justify-content:flex-end; margin-top:6px; }
        .modal-inner input { width: 100%; }
        .modal-inner input { color: #ffffff; }
        .modal-inner input::placeholder { color: rgba(255,255,255,0.7); }
        #fecharModalBtn { padding:10px 20px; border-radius:10px; }
        .error-message-2fa { color: red; text-align: center; margin-bottom: 10px; }
    </style>
    
    <dialog id="meuModal" open>
        <div class="modal-inner">
            <h2 style="color: rgb(194, 181, 166);">Verificação 2FA</h2>
            
            <?php if (!empty($erro_2fa)): ?>
                <div class="error-message-2fa"><?php echo $erro_2fa; ?></div>
            <?php endif; ?>

            <form action="verificacao_2fa_process.php" method="post" class="form-container sign-in-container" style="position:static;padding:0;width:100%;">
                
                <div class="field input-box">
                    <span><?php echo $pergunta_a_exibir; ?></span> 
                    <input id="verificacao2FA" name="resposta_usuario" type="text" placeholder=" " required />
                    </div>
                <div class="modal-actions">
                    <button type="submit">Confirmar</button>
                </div>
            </form>
        </div>
    </dialog>
    <script>
        // Forçar o modal a abrir assim que a página carrega.
        const modal = document.getElementById('meuModal');
        if (modal) {
            modal.showModal();
        }
    </script>
    <?php endif; ?>

    <script>
      // ... Seu JavaScript para música
      const music = document.getElementById("bgMusic");
      const btn = document.getElementById("musicControl");
      const icon = btn.querySelector("i");
      let isPlaying = false;

      btn.addEventListener("click", () => {
        if (isPlaying) {
          music.pause();
          icon.className = "fa-solid fa-volume-xmark"; // Ícone mute
          icon.style.color = "red";
        } else {
          music.play();
          icon.className = "fa-solid fa-volume-high"; // Ícone som
          icon.style.color = "green";
        }
        isPlaying = !isPlaying;
      });

    </script>
    <script src="../js/login.js"></script>
   <!--<script src="../js/validacoes.js"></script>-->
  </body>
</html>