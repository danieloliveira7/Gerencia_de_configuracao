<?php
use PHPUnit\Framework\TestCase;

class IdGeradoTest extends TestCase
{
    public function testTarefaComId()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT id FROM tarefa ORDER BY id DESC LIMIT 1");
        $id = $stmt->fetchColumn();
        $this->assertIsNumeric($id);
    }
}
