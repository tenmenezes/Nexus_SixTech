<?php
require_once 'Conn.php';

function sendJsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
    exit;
}

// Habilita CORS (para desenvolvimento)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonResponse(['error' => 'Método não permitido'], 405);
}

try {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        sendJsonResponse(['error' => 'Dados inválidos'], 400);
    }

    // Mapeamento de campos
    $fieldMap = [
        'nome' => 'full_name',
        'dt_nas' => 'date_of_birth',
        'genero' => 'gender',
        'mother_name' => 'mother_name',
        'cpf' => 'cpf',
        'email' => 'email',
        'cel' => 'mobile_phone',
        'home_phone' => 'home_phone',
        'street' => 'street',
        'number' => 'number',
        'complement' => 'complement',
        'cep' => 'zip_code',
        'neighborhood' => 'neighborhood',
        'city' => 'city',
        'state' => 'state',
        'login' => 'login',
        'senha' => 'password',
        'categoria' => 'user_type'
    ];

    // Campos obrigatórios
    $requiredFields = ['nome', 'email', 'cpf', 'mother_name', 'street', 'neighborhood', 'city', 'state', 'login', 'senha'];
    foreach ($requiredFields as $field) {
        if (empty($data[$field]) && empty($data['id'])) {
            sendJsonResponse(['error' => "Campo **{$field}** é obrigatório"], 400);
        }
    }

    $pdo = getDbConnection();

    // Converte campos
    $dbParams = [];
    foreach ($data as $key => $value) {
        if (isset($fieldMap[$key])) {
            $dbParams[$fieldMap[$key]] = $value;
        }
    }

    // Adiciona ID se existir
    $isUpdate = isset($data['id']) && !empty($data['id']);
    if ($isUpdate) {
        $dbParams['id'] = (int)$data['id'];
    }

    // Hash da senha
    if (isset($dbParams['password'])) {
        $senha = $dbParams['password'];
        // Se não parecer um hash, cria um novo
        if (!preg_match('/^\$2y\$/', $senha)) {
            $dbParams['password'] = password_hash($senha, PASSWORD_DEFAULT);
        }
    } else if ($isUpdate) {
        // Se for update e senha não foi enviada, mantém a existente
        unset($dbParams['password']);
    }

    if ($isUpdate) {
        // Atualização
        $setClauses = [];
        $params = [];

        foreach ($dbParams as $col => $val) {
            if ($col !== 'id') {
                $setClauses[] = "$col = :$col";
                $params[$col] = $val;
            }
        }

        $params['id'] = $dbParams['id'];

        $sql = "UPDATE users SET 
                    " . implode(', ', $setClauses) . ",
                    updated_at = NOW()
                WHERE id = :id";

    } else {
        // Inserção
        $cols = implode(', ', array_keys($dbParams));
        $vals = implode(', ', array_map(fn($col) => ":$col", array_keys($dbParams)));

        $sql = "INSERT INTO users 
                    ($cols, created_at, updated_at) 
                VALUES 
                    ($vals, NOW(), NOW())";

        $params = $dbParams;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $id = $isUpdate ? $dbParams['id'] : $pdo->lastInsertId();

    // Retorna o usuário atualizado/criado
    $sql = "SELECT 
                id,
                full_name AS nome,
                date_of_birth AS dt_nas,
                gender AS genero,
                mother_name,
                cpf,
                email,
                mobile_phone AS cel,
                home_phone,
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
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        throw new Exception("Erro ao recuperar usuário após salvar");
    }

    $user['senha'] = '********';

    sendJsonResponse($user);

} catch (Exception $e) {
    error_log($e->getMessage());
    sendJsonResponse(['error' => 'Erro ao salvar usuário', 'details' => $e->getMessage()], 500);
}