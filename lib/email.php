<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviarEmail($nome, $usuario_id, $acao, $descricao) {
    global $pdo;

    $stmt = $pdo->prepare("SELECT email FROM usuarios WHERE id = :id");
    $stmt->execute(['id' => $usuario_id]);
    $email = $stmt->fetchColumn();

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';     // Altere para seu servidor
        $mail->SMTPAuth = true;
        $mail->Username = 'daniel.oliveira1@universo.univates.br';
        $mail->Password = 'qqfp luri nopq fvqm';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('daniel.oliveira1@universo.univates.br', 'Sistema de Tarefas');
        $mail->addAddress($email, $nome);

        $mail->isHTML(true);
        $mail->Subject = "Tarefa $acao com sucesso!";
        $mail->Body = "Olá <b>$nome</b>,<br>Sua tarefa foi <b>$acao</b> com sucesso:<br><br><i>$descricao</i>";

        $mail->send();
    } catch (Exception $e) {
        error_log("Erro ao enviar e-mail: {$mail->ErrorInfo}");
    }
}
