<?php
use PHPUnit\Framework\TestCase;

class FiltroSituacaoTest extends TestCase
{
    public function testFiltroSituacaoPendente()
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM tarefa WHERE situacao = 'pendente'");
        $stmt->execute();
        $tarefas = $stmt->fetchAll();
        $this->assertIsArray($tarefas);
    }
}
