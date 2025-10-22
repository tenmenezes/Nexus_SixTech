<?php
require_once 'Conn.php'; //arquivo de conexão
//Isso é para a página do administrador
// Se o usuário já está logado, redireciona para a área restrita.
//if (isset($_SESSION['user_id'])) {
//    header('Location: painel.php');
//    exit;
//}

$mensagem = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $pdo = getDbConnection();

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
      // Login bem-sucedido: inicia as variáveis de sessão
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_login'] = $user['login'];
      $_SESSION['user_type'] = $user['user_type']; // 'A' ou 'C'
      $mensagem = '<div style="color: red;">teste.</div>';
      // 3. Redireciona para a página principal
      header('Location: index.php');
      exit;
    } else {
      $mensagem = '<div style="color: red;">Login ou Senha incorretos.</div>';
    }
  } else {
    $mensagem = '<div style="color: red;">Login ou Senhaa incorretos.</div>';
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="../css/login.css" />

  <!-- Importando Font Awesome -->
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
          <input id="senhaforgotConfirm" name="senhaforgotConfirm" type="password" placeholder=" "
            minlength="6" />
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
        <?php echo $mensagem; ?>

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

  <!--<audio autoplay loop id="bgMusic">
      <source src="../utils/songs/lofi.mp3" type="audio/mp3">
     </audio>* -->
  <script>
    const music = document.getElementById("bgMusic");
    const btn = document.getElementById("musicControl");
    const icon = btn.querySelector("i");
    let isPlaying = false;

    btn.addEventListener("click", () => {
      if (isPlaying) {
        music.pause();
        icon.className = "fa-solid fa-volume-xmark"; // Ícone mute
      } else {
        music.play();
        icon.className = "fa-solid fa-volume-high"; // Ícone som
        icon.style.color = "green";
      }
      isPlaying = !isPlaying;
    });
  </script>
  <script src="../js/login.js"></script>
  <script src="../js/validacoes.js"></script>
</body>

</html>