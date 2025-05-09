<?php
use PHPUnit\Framework\TestCase;

class TarefaTest extends TestCase
{
    private $pdo;
    private $usuario_id;

    protected function setUp(): void
    {
        $this->pdo = $GLOBALS['pdo'];

        $stmt = $this->pdo->query("SELECT id FROM usuarios LIMIT 1");
        $this->usuario_id = $stmt->fetchColumn();

        // Se não houver usuário, cria um temporário
        if (!$this->usuario_id) {
            $stmt = $this->pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES ('Teste', 'teste@teste.com', '123')");
            $stmt->execute();
            $this->usuario_id = $this->pdo->lastInsertId();
        }
    }

    public function testCriarTarefa()
    {
        $stmt = $this->pdo->prepare("INSERT INTO tarefa (descricao, usuario_id, situacao, data_criacao) VALUES (?, ?, 'pendente', NOW())");
        $result = $stmt->execute(['Tarefa Teste', $this->usuario_id]);

        $this->assertTrue($result);
    }

    public function testBuscarTarefas()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tarefa WHERE usuario_id = ?");
        $stmt->execute([$this->usuario_id]);
        $tarefas = $stmt->fetchAll();

        $this->assertIsArray($tarefas);
    }
}
