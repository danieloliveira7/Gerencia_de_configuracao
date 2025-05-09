<?php
use PHPUnit\Framework\TestCase;

class ConexaoBancoTest extends TestCase
{
    public function testConexaoValida()
    {
        global $pdo;
        $this->assertInstanceOf(PDO::class, $pdo);
    }
}
