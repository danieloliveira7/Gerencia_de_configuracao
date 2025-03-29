<?php
header('Content-Type: application/json');

$host = 'localhost';
$dbname = 'postgres';
$user = 'postgres';
$password = 'postgres';

try {
    $pdo = new PDO("pgsql:host=$host;port=5433;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $stmt = $pdo->query("SELECT id, descricao, data_criacao, data_prevista, data_encerramento, situacao FROM tarefa");
    $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($tarefas);
} catch (PDOException $e) {
    echo json_encode(['erro' => $e->getMessage()]);
}
?>
