<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/db.php';


use Dompdf\Dompdf;
use Dompdf\Options;

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

$stmt = $pdo->prepare("SELECT id, descricao, data_criacao, data_prevista, data_encerramento, situacao 
                       FROM tarefa 
                       WHERE usuario_id = :usuario_id");
$stmt->execute(['usuario_id' => $usuario_id]);
$tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Monta o HTML
$html = '<h2>Lista de Tarefas</h2>';
$html .= '<table border="1" cellpadding="5" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Data Criação</th>
                    <th>Data Prevista</th>
                    <th>Data Encerramento</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <tbody>';

foreach ($tarefas as $tarefa) {
    $html .= '<tr>
                <td>' . $tarefa['id'] . '</td>
                <td>' . htmlspecialchars($tarefa['descricao']) . '</td>
                <td>' . $tarefa['data_criacao'] . '</td>
                <td>' . ($tarefa['data_prevista'] ?? 'N/A') . '</td>
                <td>' . ($tarefa['data_encerramento'] ?? 'N/A') . '</td>
                <td>' . $tarefa['situacao'] . '</td>
              </tr>';
}

$html .= '</tbody></table>';

// Configurar DomPDF
$options = new Options();
$options->set('defaultFont', 'Arial');

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Download automático
$dompdf->stream("tarefas.pdf", ["Attachment" => true]);
