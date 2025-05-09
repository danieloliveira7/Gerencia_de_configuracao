<?php
use PHPUnit\Framework\TestCase;

class DataPrevistaPassadoTest extends TestCase
{
    public function testDataPrevistaNoPassado()
    {
        $data = '2020-01-01';
        $this->assertLessThan(date('Y-m-d'), $data);
    }
}
