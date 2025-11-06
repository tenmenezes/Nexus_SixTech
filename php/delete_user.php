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
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonResponse(
        ['error' => 'Método não permitido'],
        405
    );
}

try {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!$data || !isset($data['id'])) {
        sendJsonResponse(
            ['error' => 'ID do usuário não fornecido'],
            400
        );
    }
    
    $pdo = getDbConnection();
    
    // deletada usuário
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $data['id']]);
    
    if ($stmt->rowCount() === 0) {
        sendJsonResponse(
            ['error' => 'Usuário não encontrado'],
            404
        );
    }
    
    sendJsonResponse(['message' => 'Usuário deletado com sucesso']);
    
} catch (Exception $e) {
    error_log($e->getMessage());
    sendJsonResponse(
        ['error' => 'Erro ao deletar usuário'],
        500
    );
}