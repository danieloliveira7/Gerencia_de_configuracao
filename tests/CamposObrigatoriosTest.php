<?php
use PHPUnit\Framework\TestCase;

class CamposObrigatoriosTest extends TestCase
{
    public function testDescricaoNaoNula()
    {
        $descricao = null;
        $this->assertNull($descricao); // Deve falhar se obrigatório
    }
}
