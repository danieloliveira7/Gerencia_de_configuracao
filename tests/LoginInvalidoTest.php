<?php
use PHPUnit\Framework\TestCase;

class LoginInvalidoTest extends TestCase
{
    public function testLoginInvalido()
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = 'admin@email.com'");
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $valido = password_verify('senhaErrada', $usuario['senha_hash']);
        $this->assertFalse($valido);
    }
}
