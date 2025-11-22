<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'conn.php';

try {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare('SELECT SL.id AS id, SL.user_id AS user_id, SL.entry_time AS entry_time, SL.exit_time as exit_time, u.full_name AS full_name FROM session_logs SL JOIN users u ON SL.user_id=u.id ORDER BY entry_time DESC');
    $stmt->execute();
    $rows = $stmt->fetchAll();
    echo json_encode($rows);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'DB error', 'message' => $e->getMessage()]);
}

?>
