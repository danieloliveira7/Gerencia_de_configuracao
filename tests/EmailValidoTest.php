<?php
use PHPUnit\Framework\TestCase;

class EmailValidoTest extends TestCase
{
    public function testEmailValido()
    {
        $email = "teste@exemplo.com";
        $this->assertMatchesRegularExpression('/^[^@\s]+@[^@\s]+\.[^@\s]+$/', $email);
    }
}
