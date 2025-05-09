<?php
$host = 'localhost';
$dbname = 'postgres';
$user = 'postgres';
$password = 'postgres';
$port = '5433';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    // Torna acessível globalmente nos testes
    $GLOBALS['pdo'] = $pdo;
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
