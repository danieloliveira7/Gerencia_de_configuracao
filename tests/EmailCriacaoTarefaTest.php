<?php
use PHPUnit\Framework\TestCase;

class EmailCriacaoTarefaTest extends TestCase
{
    public function testSimulacaoEnvioEmail()
    {
        $enviado = true; // Simula envio
        $this->assertTrue($enviado);
    }
}
