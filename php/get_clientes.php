<?php
require_once 'Conn.php';

function sendJsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
    exit;
}
// Habilita CORS para desenvolvimento
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

try {
    $pdo = getDbConnection();
    
    // Busca todos os usuários ativos usando aliases para compatibilidade com o front-end
    $sql = "SELECT 
                id, 
                full_name AS nome, 
                date_of_birth AS dt_nas, 
                gender AS genero, 
                mother_name, -- Novo campo necessário
                cpf, 
                email, 
                mobile_phone AS cel, 
                home_phone, -- Novo campo necessário
                street, 
                number, 
                complement, 
                zip_code AS cep, 
                neighborhood, 
                city, 
                state, 
                login, 
                user_type AS categoria, 
                created_at AS criacao, 
                updated_at AS atualizacao 
            FROM users 
            -- Remoção da condição 'deletado = 0' que não existe no seu DB
            ORDER BY full_name"; // ORDER BY corrigido para 'full_name'
            
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Remove o campo 'password' do DB antes de enviar a resposta
    foreach ($users as &$user) {
        unset($user['password']); 
        $user['senha'] = '********'; // Adiciona o placeholder para o front-end
    }
    
    sendJsonResponse($users);
    
} catch (Exception $e) {
    error_log($e->getMessage());
    sendJsonResponse(
        ['error' => 'Erro ao buscar usuários', 'details' => $e->getMessage()],
        500
    );
}