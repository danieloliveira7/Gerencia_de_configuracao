<?php
use PHPUnit\Framework\TestCase;

class UsuarioTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = $GLOBALS['pdo'];
    }

    public function testCadastroUsuario()
    {
        $senhaHash = password_hash('123456', PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nome, email, senha_hash) VALUES (?, ?, ?)");
        $result = $stmt->execute(['Usuário Teste', 'teste_' . rand(1000, 9999) . '@teste.com', $senhaHash]);

        $this->assertTrue($result);
    }

    public function testUsuarioExiste()
    {
        $stmt = $this->pdo->query("SELECT * FROM usuarios LIMIT 1");
        $usuario = $stmt->fetch();

        $this->assertIsArray($usuario);
    }
}
