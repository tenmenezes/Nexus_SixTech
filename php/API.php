<?php
header("Content-Type: application/json");
require 'conn.php';

$table = $_GET['table'] ?? '';
$action = $_GET['action'] ?? '';

if (!$table) {
    echo json_encode(['error' => 'Tabela não especificada']);
    exit;
}

switch ($action) {
    case 'read':
        $stmt = $pdo->query("SELECT * FROM `$table`");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;

    case 'create':
        $data = json_decode(file_get_contents("php://input"), true);
        $fields = array_keys($data);
        $values = array_map(fn($v) => ":$v", $fields);
        $sql = "INSERT INTO `$table` (" . implode(",", $fields) . ") VALUES (" . implode(",", $values) . ")";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
        break;

    case 'update':
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'] ?? null;
        if (!$id) { echo json_encode(['error' => 'ID não informado']); exit; }
        unset($data['id']);
        $set = implode(",", array_map(fn($f) => "$f = :$f", array_keys($data)));
        $sql = "UPDATE `$table` SET $set WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $data['id'] = $id;
        $stmt->execute($data);
        echo json_encode(['success' => true]);
        break;

    case 'delete':
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'] ?? null;
        if (!$id) { echo json_encode(['error' => 'ID não informado']); exit; }
        $stmt = $pdo->prepare("DELETE FROM `$table` WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true]);
        break;

    default:
        echo json_encode(['error' => 'Ação inválida']);
}
?>
