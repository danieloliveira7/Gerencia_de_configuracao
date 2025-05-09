<?php
require_once '../config/db.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

// Verifica se o e-mail já está cadastrado
$stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
$stmt->execute(['email' => $email]);
$existe = $stmt->fetchColumn();

if ($existe > 0) {
    echo "<script>alert('E-mail já cadastrado!'); window.location.href = '../public/cadastrar_usuario.php';</script>";
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha_hash) VALUES (:nome, :email, :senha_hash)");
    $stmt->execute([
        'nome' => $nome,
        'email' => $email,
        'senha_hash' => $senha_hash
    ]);
    echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href = '../public/index.php';</script>";
} catch (PDOException $e) {
    echo "Erro ao cadastrar: " . $e->getMessage();
}
