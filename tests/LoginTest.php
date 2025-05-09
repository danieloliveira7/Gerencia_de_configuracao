<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    public function testLoginValido()
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = 'daniel63japa@gmail.com'");
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $valido = password_verify('teste123', $usuario['senha_hash']);
        $this->assertTrue($valido);
    }
}
