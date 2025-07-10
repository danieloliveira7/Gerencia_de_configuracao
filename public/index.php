<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt">
<head><meta charset="UTF-8"><title>Login</title>
<link rel="stylesheet" href="/css/style.css">
</head>
<body>
<h2>Login</h2>
<form action="../controllers/AuthController.php" method="POST">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="senha" placeholder="Senha" required><br>
    <button type="submit">Entrar</button>
</form>
<p>Não tem conta teste? <a href="cadastrar_usuario.php">Cadastre-se aqui</a></p>
<?php if (isset($_SESSION['erro'])): ?>
<p style="color:red"><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></p>
<?php endif; ?>
</body>
</html>
