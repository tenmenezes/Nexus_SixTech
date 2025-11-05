<?php
session_start();

require_once 'Conn.php'; 

// 1. Verifica se a coluna de segurança e a resposta do usuário existem
if (!isset($_SESSION['2fa_column']) || !isset($_POST['resposta_usuario'])) {
    // Se a sessão expirou ou o formulário não foi enviado corretamente, volta para o login.
    $_SESSION['error_message'] = "Sessão de verificação expirada. Faça login novamente.";
    header("Location: login.php");
    exit();
}

$coluna_escolhida = $_SESSION['2fa_column'];
$resposta_usuario = $_POST['resposta_usuario'];

// Limpar a coluna da sessão IMEDIATAMENTE por segurança (para evitar reuso e ataques)
unset($_SESSION['2fa_column']);

// Supondo que o ID do usuário logado esteja na sessão
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = "Erro: Usuário não autenticado.";
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];

// Obtém a conexão PDO usando a função do Conn.php
$pdo = getDbConnection();

$sql = "SELECT {$coluna_escolhida} FROM users WHERE id = :user_id"; 

try {
    $stmt = $pdo->prepare($sql);
    
    // Liga o parâmetro 'user_id' e executa

    $stmt->execute(['user_id' => $user_id]);
    
    // Busca a linha (fetch)
    $linha = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($linha) {
        
        $valor_correto = $linha[$coluna_escolhida]; 

        // 3. COMPARAÇÃO
        $resposta_tratada = trim($resposta_usuario);
        $valor_tratado = trim($valor_correto);
        
        // Adiciona lógica de normalização para o nome da mãe (mother_name)
        if ($coluna_escolhida === 'mother_name') {
            // Compara nomes sem case-sensitive
            $resposta_tratada = strtolower($resposta_tratada);
            $valor_tratado = strtolower($valor_tratado);
        }
        
        if ($resposta_tratada === $valor_tratado) {
            // Marca o usuário como verificado e redireciona para a página principal.
            $_SESSION['2fa_verified'] = true;
            header("Location: index.php");
            exit();
        } else {
            // FALHA NA VERIFICAÇÃO
            // Redireciona de volta para o login.php com a flag de mostrar o modal.
            $_SESSION['error_message'] = "Código de verificação incorreto. Tente novamente.";
            header("Location: login.php?show_2fa=1"); 
            exit();
        }
    } else {
        // Usuário não encontrado, erro grave.
        $_SESSION['error_message'] = "Erro fatal: Usuário não encontrado no DB para 2FA.";
        header("Location: login.php");
        exit();
    }

} catch (PDOException $e) {
    // Trata erros de preparação ou execução do PDO
    $_SESSION['error_message'] = "Erro interno: Falha na consulta de verificação 2FA.";
    header("Location: login.php");
    exit();
}

?>