<?php
use PHPUnit\Framework\TestCase;

class FiltroDataTest extends TestCase
{
    public function testFiltroDataPrevista()
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM tarefa WHERE data_prevista = CURRENT_DATE");
        $stmt->execute();
        $tarefas = $stmt->fetchAll();
        $this->assertIsArray($tarefas);
    }
}
