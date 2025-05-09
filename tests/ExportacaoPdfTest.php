<?php
use PHPUnit\Framework\TestCase;

class ExportacaoPdfTest extends TestCase
{
    public function testArquivoPdfGerado()
    {
        $caminho = __DIR__ . '/../pdf/tarefas.pdf';
        if (file_exists($caminho)) unlink($caminho);
        include __DIR__ . '/../pdf/gerar_pdf.php';
        $this->assertFileExists($caminho);
    }
}
