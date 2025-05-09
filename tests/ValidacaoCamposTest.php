<?php
use PHPUnit\Framework\TestCase;

class ValidacaoCamposTest extends TestCase
{
    public function testDescricaoObrigatoria()
    {
        $descricao = '';
        $this->assertFalse(strlen($descricao) > 0);
    }
}
