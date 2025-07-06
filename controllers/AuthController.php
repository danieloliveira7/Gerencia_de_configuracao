<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($senha, $user['senha_hash'])) {
    $_SESSION['usuario_id'] = $user['id'];
    $_SESSION['usuario_nome'] = $user['nome'];
    header("Location: ../public/dashboard.php");
} else {
    $_SESSION['erro'] = "Credenciais inválidas.";
    header("Location: ../public/index.php");
}
