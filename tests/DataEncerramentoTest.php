<?php
use PHPUnit\Framework\TestCase;

class DataEncerramentoTest extends TestCase
{
    public function testTarefaEncerradaComData()
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT data_encerramento FROM tarefa WHERE situacao = 'concluida' LIMIT 1");
        $stmt->execute();
        $data = $stmt->fetchColumn();
        $this->assertNotEmpty($data);
    }
}
