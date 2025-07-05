<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Filtros (opcionais)
$data_inicio = $_GET['data_inicio'] ?? '';
$data_fim = $_GET['data_fim'] ?? '';
$situacao = $_GET['situacao'] ?? '';

$query = "SELECT * FROM tarefa WHERE usuario_id = :usuario_id";
$params = ['usuario_id' => $usuario_id];

if (!empty($data_inicio)) {
    $query .= " AND data_criacao >= :data_inicio";
    $params['data_inicio'] = $data_inicio;
}

if (!empty($data_fim)) {
    $query .= " AND data_criacao <= :data_fim";
    $params['data_fim'] = $data_fim;
}

if (!empty($situacao)) {
    $query .= " AND situacao = :situacao";
    $params['situacao'] = $situacao;
}

$query .= " ORDER BY data_criacao DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Minhas Tarefas</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <h2>Bem-vindo, <?= $_SESSION['usuario_nome'] ?></h2>
    <a href="logout.php">Sair</a> | <a href="nova_tarefa.php">Nova Tarefa</a> | <a href="../pdf/gerar_pdf.php">Exportar PDF</a>
    
    <h3>Filtrar Tarefas</h3>
    <form method="GET">
        Data Início: <input type="date" name="data_inicio" value="<?= $data_inicio ?>">
        Data Fim: <input type="date" name="data_fim" value="<?= $data_fim ?>">
        Situação:
        <select name="situacao">
            <option value="">Todas</option>
            <option value="pendente" <?= $situacao == 'pendente' ? 'selected' : '' ?>>Pendente</option>
            <option value="concluida" <?= $situacao == 'concluida' ? 'selected' : '' ?>>Concluída</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <h3>Lista de Tarefas</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Data Criação</th>
            <th>Data Prevista</th>
            <th>Data Encerramento</th>
            <th>Situação</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($tarefas as $t): ?>
        <tr>
            <td><?= $t['id'] ?></td>
            <td><?= $t['descricao'] ?></td>
            <td><?= date('d/m/Y', strtotime($t['data_criacao'])) ?></td>
            <td><?= $t['data_prevista'] ? date('d/m/Y', strtotime($t['data_prevista'])) : '---' ?></td>
            <td><?= $t['data_encerramento'] ? date('d/m/Y', strtotime($t['data_encerramento'])) : '---' ?></td>
            <td><?= ucfirst($t['situacao']) ?></td>
            <td>
                <a href="editar_tarefa.php?id=<?= $t['id'] ?>">Editar</a> |
                <a href="../controllers/TarefaController.php?acao=deletar&id=<?= $t['id'] ?>" onclick="return confirm('Excluir tarefa?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
