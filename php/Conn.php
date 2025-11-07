<?php
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'nexus_database');
define('DB_USER', 'root');
define('DB_PASS', '');

session_start();

function getDbConnection()
{
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        return $pdo;
    } catch (PDOException $e) {
        // Em um ambiente de produção, logar o erro e mostrar uma mensagem genérica
        die("Erro de Conexão com o Banco de Dados: " . $e->getMessage());
    }
}
