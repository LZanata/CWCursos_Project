<?php
include '../../funcoes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validação básica
    $nome = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $assunto = trim($_POST['subject'] ?? '');
    $mensagem = trim($_POST['message'] ?? '');

    if (empty($nome) || empty($email) || empty($assunto) || empty($mensagem)) {
        echo "<div style='padding:20px; background-color: #f8d7da; border-radius:10px; margin:20px 0;'>
                <i class='bi bi-x-circle-fill'></i> Todos os campos são obrigatórios.
              </div>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div style='padding:20px; background-color: #f8d7da; border-radius:10px; margin:20px 0;'>
                <i class='bi bi-x-circle-fill'></i> E-mail inválido.
              </div>";
        exit;
    }

    // Sanitização para evitar XSS
    $nome = htmlspecialchars($nome);
    $email = htmlspecialchars($email);
    $assunto = htmlspecialchars($assunto);
    $mensagem = htmlspecialchars($mensagem);

    $stmt = $conexao->prepare("INSERT INTO tickets (nome, email, assunto, mensagem) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $email, $assunto, $mensagem);

    if ($stmt->execute()) {
        $ticket_id = $stmt->insert_id;
        echo "<div style='padding:20px; background-color: #d4edda; border-radius:10px; margin:20px 0;'>
                <i class='bi bi-check-circle-fill'></i> Ticket criado com sucesso!<br>
                Número do seu ticket: <strong>#{$ticket_id}</strong><br>
                Nossa equipe responderá em breve.
              </div>";
    } else {
        // Em produção, remova o erro detalhado
        echo "<div style='padding:20px; background-color: #f8d7da; border-radius:10px; margin:20px 0;'>
                <i class='bi bi-x-circle-fill'></i> Erro ao enviar ticket. Tente novamente mais tarde.<br>
                <small>Erro: {$stmt->error}</small>
              </div>";
    }

    $stmt->close();
    $conexao->close();
} else {
    header("Location: ../ticket.php");
    exit();
}
?>