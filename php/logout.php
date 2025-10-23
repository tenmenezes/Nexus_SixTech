<?php
// 1. Inicia a sessão (necessário para acessar as variáveis de sessão)
session_start();

// 2. Limpa todas as variáveis de sessão
$_SESSION = array();

// 3. Se a sessão for baseada em cookies, destrói o cookie de sessão também.
// Nota: Isso irá destruir a sessão, e não apenas os dados de sessão!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// 4. Destrói a sessão.
session_destroy();

// 5. Redireciona o usuário para a página de login
// Mantenha o nome do arquivo que você usa para login.
header("Location: Index.php");
exit;
