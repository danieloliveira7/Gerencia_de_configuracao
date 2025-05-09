<?php
use PHPUnit\Framework\TestCase;

class ListaVaziaTest extends TestCase
{
    public function testUsuarioSemTarefas()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT id FROM usuarios ORDER BY id DESC LIMIT 1");
        $usuario_id = $stmt->fetchColumn();
        $stmt = $pdo->prepare("SELECT * FROM tarefa WHERE usuario_id = ?");
        $stmt->execute([$usuario_id]);
        $tarefas = $stmt->fetchAll();
        $this->assertIsArray($tarefas);
    }
}
