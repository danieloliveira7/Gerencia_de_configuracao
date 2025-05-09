<?php
use PHPUnit\Framework\TestCase;

class AtualizacaoTarefaTest extends TestCase
{
    public function testAtualizarDescricao()
    {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE tarefa SET descricao = 'Tarefa Atualizada' WHERE descricao = 'Tarefa Teste'");
        $success = $stmt->execute();
        $this->assertTrue($success);
    }
}
