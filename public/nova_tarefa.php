<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Nova Tarefa</title>
    <link rel="stylesheet" href="/css/style.css">

</head>
<body>
    <h2>Criar Nova Tarefa</h2>
    <form action="../controllers/TarefaController.php" method="POST">
        <input type="hidden" name="acao" value="criar">
        <label>Descrição:<br>
            <textarea name="descricao" required></textarea>
        </label><br><br>

        <label>Data Prevista:<br>
            <input type="date" name="data_prevista">
        </label><br><br>

        <label>Situação:<br>
            <select name="situacao">
                <option value="pendente">Pendente</option>
                <option value="concluida">Concluída</option>
            </select>
        </label><br><br>

        <button type="submit">Salvar</button>
        <a href="dashboard.php">Cancelar</a>
    </form>
</body>
</html>
