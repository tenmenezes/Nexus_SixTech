<?php
header('Content-Type: application/json');
require_once 'Conn.php';

// Inicia sessão se ainda não foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Usuário não autenticado']);
    exit;
}

// Recebe os dados do carrinho
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['itens']) || empty($input['itens'])) {
    echo json_encode(['success' => false, 'error' => 'Carrinho vazio']);
    exit;
}

$pdo = getDbConnection();

try {
    // Inicia transação
    $pdo->beginTransaction();

    $user_id = $_SESSION['user_id'];
    $itens = $input['itens'];
    $valor_total = 0;

    // Busca os dados dos jogos do banco de dados
    $game_ids = array_column($itens, 'game_id');
    $placeholders = str_repeat('?,', count($game_ids) - 1) . '?';
    $stmt = $pdo->prepare("SELECT id, preco, estoque FROM games WHERE id IN ($placeholders)");
    $stmt->execute($game_ids);
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Cria um array associativo para fácil acesso
    $games_data = [];
    foreach ($games as $game) {
        $games_data[$game['id']] = $game;
    }

    // Valida estoque e calcula valor total
    foreach ($itens as $item) {
        $game_id = $item['game_id'];
        $quantidade = $item['quantidade'];

        if (!isset($games_data[$game_id])) {
            throw new Exception("Jogo ID {$game_id} não encontrado");
        }

        $game = $games_data[$game_id];

        if ($game['estoque'] < $quantidade) {
            throw new Exception("Estoque insuficiente para o jogo ID {$game_id}");
        }

        $valor_total += $game['preco'] * $quantidade;
    }

    // Cria o pedido (order)
    $stmt = $pdo->prepare("
        INSERT INTO orders (user_id, data_pedido, status, valor_total) 
        VALUES (:user_id, NOW(), 'Pendente', :valor_total)
    ");
    $stmt->execute([
        'user_id' => $user_id,
        'valor_total' => $valor_total
    ]);

    $order_id = $pdo->lastInsertId();

    // Cria os itens do pedido (order_items) e atualiza o estoque
    $stmt_item = $pdo->prepare("
        INSERT INTO order_items (order_id, game_id, quantidade, preco_unitario) 
        VALUES (:order_id, :game_id, :quantidade, :preco_unitario)
    ");

    $stmt_estoque = $pdo->prepare("
        UPDATE games SET estoque = estoque - :quantidade WHERE id = :game_id
    ");

    foreach ($itens as $item) {
        $game_id = $item['game_id'];
        $quantidade = $item['quantidade'];
        $preco_unitario = $games_data[$game_id]['preco'];

        // Insere o item do pedido
        $stmt_item->execute([
            'order_id' => $order_id,
            'game_id' => $game_id,
            'quantidade' => $quantidade,
            'preco_unitario' => $preco_unitario
        ]);

        // Atualiza o estoque
        $stmt_estoque->execute([
            'quantidade' => $quantidade,
            'game_id' => $game_id
        ]);
    }

    // Confirma a transação
    $pdo->commit();

    echo json_encode([
        'success' => true,
        'order_id' => $order_id,
        'valor_total' => number_format($valor_total, 2, ',', '.'),
        'message' => 'Pedido realizado com sucesso!'
    ]);
} catch (Exception $e) {
    // Reverte a transação em caso de erro
    $pdo->rollBack();
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
