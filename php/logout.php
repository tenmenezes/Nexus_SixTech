<?php
// 1. Inicia a sessão (necessário para acessar as variáveis de sessão)
session_start();

// Registra o logout na tabela session_logs
if (isset($_SESSION['session_log_id']) && isset($_SESSION['user_id'])) {
    try {
        require_once 'Conn.php';
        $pdo = getDbConnection();

        $stmt = $pdo->prepare("UPDATE session_logs SET logout = NOW() WHERE id = :log_id AND user_id = :user_id");
        $stmt->execute([
            'log_id' => $_SESSION['session_log_id'],
            'user_id' => $_SESSION['user_id']
        ]);
    } catch (Exception $e) {
        // Se falhar ao registrar o logout, continua o processo normalmente
        error_log("Erro ao registrar logout: " . $e->getMessage());
    }
}

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
