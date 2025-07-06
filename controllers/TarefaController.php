<?php
session_start();
require_once '../config/db.php';
require_once '../lib/email.php'; // vamos criar esse depois

$acao = $_POST['acao'] ?? $_GET['acao'] ?? '';
$usuario_id = $_SESSION['usuario_id'] ?? null;

// Criar nova tarefa
if ($acao === 'criar' && $usuario_id) {
    $descricao = $_POST['descricao'];
    $data_prevista = $_POST['data_prevista'] ?: null;
    $situacao = $_POST['situacao'];

    $stmt = $pdo->prepare("INSERT INTO tarefa (descricao, data_prevista, situacao, usuario_id) 
                           VALUES (:descricao, :data_prevista, :situacao, :usuario_id)");
    $stmt->execute([
        'descricao' => $descricao,
        'data_prevista' => $data_prevista,
        'situacao' => $situacao,
        'usuario_id' => $usuario_id
    ]);

    // Envia e-mail
    enviarEmail($_SESSION['usuario_nome'], $_SESSION['usuario_id'], 'criada', $descricao);

    header("Location: /dashboard.php");
    exit;
}
// Atualizar tarefa
if ($acao === 'atualizar' && $usuario_id) {
    $id = $_POST['id'];
    $descricao = $_POST['descricao'];
    $data_prevista = $_POST['data_prevista'] ?: null;
    $situacao = $_POST['situacao'];

    // Se a situação for "concluída", define a data de encerramento
    if ($situacao === 'concluida') {
        $data_encerramento = date('Y-m-d');  // Define a data de encerramento como a data atual
    } else {
        $data_encerramento = null;  // Mantém como null se não for concluída
    }

    // Prepare a atualização da tarefa
    $stmt = $pdo->prepare("UPDATE tarefa 
                           SET descricao = :descricao, 
                               data_prevista = :data_prevista, 
                               data_encerramento = :data_encerramento,
                               situacao = :situacao 
                           WHERE id = :id AND usuario_id = :usuario_id");

    // Executa a query com os dados da tarefa
    $stmt->execute([
        'descricao' => $descricao,
        'data_prevista' => $data_prevista,
        'data_encerramento' => $data_encerramento,
        'situacao' => $situacao,
        'id' => $id,
        'usuario_id' => $usuario_id
    ]);

    // Envia e-mail
    enviarEmail($_SESSION['usuario_nome'], $usuario_id, 'atualizada', $descricao);

    header("Location: /dashboard.php");
    exit;
}



// Deletar tarefa
if ($acao === 'deletar' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM tarefa WHERE id = :id AND usuario_id = :usuario_id");
    $stmt->execute(['id' => $id, 'usuario_id' => $usuario_id]);

    header("Location: /dashboard.php");
    exit;
}
