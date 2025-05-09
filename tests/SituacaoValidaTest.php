<?php
use PHPUnit\Framework\TestCase;

class SituacaoValidaTest extends TestCase
{
    public function testSituacaoValida()
    {
        $situacao = 'pendente';
        $validas = ['pendente', 'concluida', 'atrasada'];
        $this->assertContains($situacao, $validas);
    }
}
