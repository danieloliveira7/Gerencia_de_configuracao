<?php
use PHPUnit\Framework\TestCase;

class AutenticacaoTest extends TestCase
{
    public function testSenhaHash()
    {
        $senha = '123456';
        $hash = password_hash($senha, PASSWORD_DEFAULT);

        $this->assertTrue(password_verify('123456', $hash));
    }
}
