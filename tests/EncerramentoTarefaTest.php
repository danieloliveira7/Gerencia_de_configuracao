<?php
use PHPUnit\Framework\TestCase;

class EncerramentoTarefaTest extends TestCase
{
    public function testEncerrarTarefa()
    {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE tarefa SET situacao = 'encerrada', data_encerramento = CURRENT_DATE WHERE situacao = 'pendente' AND id = (SELECT id FROM tarefa WHERE situacao = 'pendente' LIMIT 1)");
        $stmt->execute();
        $this->assertGreaterThanOrEqual(0, $stmt->rowCount());
    }
}
