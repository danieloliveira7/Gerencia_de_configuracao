<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID da tarefa não informado.";
    exit;
}

// Busca a tarefa do usuário logado
$stmt = $pdo->prepare("SELECT * FROM tarefa WHERE id = :id AND usuario_id = :usuario_id");
$stmt->execute(['id' => $id, 'usuario_id' => $usuario_id]);
$tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tarefa) {
    echo "Tarefa não encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <h2>Editar Tarefa</h2>
    <form action="../controllers/TarefaController.php" method="POST">
        <input type="hidden" name="acao" value="atualizar">
        <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">

        <label>Descrição:<br>
            <textarea name="descricao" required><?= htmlspecialchars($tarefa['descricao']) ?></textarea>
        </label><br><br>

        <label>Data Prevista:<br>
            <input type="date" name="data_prevista" value="<?= $tarefa['data_prevista'] ?>">
        </label><br><br>

        <label>Data Encerramento:<br>
            <input type="date" name="data_encerramento" value="<?= $tarefa['data_encerramento'] ?>">
        </label><br><br>

        <label>Situação:<br>
            <select name="situacao">
                <option value="pendente" <?= $tarefa['situacao'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                <option value="concluida" <?= $tarefa['situacao'] === 'concluida' ? 'selected' : '' ?>>Concluída</option>
            </select>
        </label><br><br>

        <button type="submit">Atualizar</button>
        <a href="dashboard.php">Cancelar</a>
    </form>
</body>
</html>
