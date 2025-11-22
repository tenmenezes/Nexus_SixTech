<?php
require_once 'Conn.php';

function redirectWithMsg($url, $msg = null) {
    if ($msg) {
        header("Location: $url?msg=" . urlencode($msg));
    } else {
        header("Location: $url");
    }
    exit;
}

try {
    // Usa $_POST (form-encoded)
    $data = $_POST;

    if (!$data) {
        throw new Exception('Dados inválidos (nenhum POST recebido).');
    }

    // Mesma mapa de campos do save_user.php
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

    $requiredFields = ['nome', 'email', 'cpf', 'mother_name', 'street', 'neighborhood', 'city', 'state', 'login'];
    // se for insert, senha também é obrigatória; se for update, senha pode ficar vazia para manter atual
    $isUpdate = !empty($data['id']);

    foreach ($requiredFields as $field) {
        if (empty($data[$field])) {
            throw new Exception("Campo {$field} é obrigatório.");
        }
    }

    if (!$isUpdate && empty($data['senha'])) {
        throw new Exception('Senha é obrigatória para novo usuário.');
    }

    $pdo = getDbConnection();

    // Converte keys para colunas DB
    $dbParams = [];
    foreach ($data as $k => $v) {
        if (isset($fieldMap[$k])) {
            $dbParams[$fieldMap[$k]] = $v;
        }
    }

    if ($isUpdate) {
        $dbParams['id'] = (int)$data['id'];
    }

    // Hash da senha (se foi enviada)
    if (isset($dbParams['password'])) {
        $senha = $dbParams['password'];
        if (!preg_match('/^\$2y\$/', $senha)) {
            $dbParams['password'] = password_hash($senha, PASSWORD_DEFAULT);
        }
    } else if ($isUpdate) {
        unset($dbParams['password']);
    }

    if ($isUpdate) {
        $set = [];
        $params = [];
        foreach ($dbParams as $col => $val) {
            if ($col === 'id') continue;
            $set[] = "$col = :$col";
            $params[$col] = $val;
        }
        $params['id'] = $dbParams['id'];
        $sql = "UPDATE users SET " . implode(', ', $set) . ", updated_at=NOW() WHERE id = :id";
    } else {
        $cols = implode(', ', array_keys($dbParams));
        $vals = implode(', ', array_map(fn($c) => ":$c", array_keys($dbParams)));
        $sql = "INSERT INTO users ($cols, created_at, updated_at) VALUES ($vals, NOW(), NOW())";
        $params = $dbParams;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params ?? []);

    // Redireciona de volta à página de relatórios (altere o caminho se necessário)
    redirectWithMsg('../Master/reports/userReports.html', 'ok');

} catch (Exception $e) {
    // Em produção você pode logar e redirecionar com erro
    redirectWithMsg('../Master/reports/userReports.html', 'error:' . $e->getMessage());
}
