<?php
// responderTicket.php

// Permite resposta JSON
header('Content-Type: application/json');

// Inclui a conexão com o banco
$conexao = require_once '../../funcoes/conexao.php';

// Pega os dados enviados via POST
$ticketId = $_POST['ticketId'] ?? null;
$resposta = $_POST['resposta'] ?? null;

if (!$ticketId || !$resposta) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados incompletos']);
    exit;
}

// Insere a resposta na tabela de respostas
$stmt = $conexao->prepare("INSERT INTO respostas_tickets (ticket_id, resposta) VALUES (?, ?)");
$stmt->bind_param("is", $ticketId, $resposta);

if ($stmt->execute()) {
    echo json_encode(['status' => 'sucesso', 'mensagem' => 'Resposta enviada com sucesso!']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao enviar resposta.']);
}

$stmt->close();
$conexao->close();
?>
