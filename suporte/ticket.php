<?php
session_start();
include_once('../funcoes/conexao.php');

// Inicializa variáveis
$nome = '';
$email = '';

// Se o usuário estiver logado, busca nome e email
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $sql = "SELECT nome, email FROM usuarios WHERE usuario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($nome, $email);
    $stmt->fetch();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CW Cursos - Suporte</title>
    <link rel="shortcut icon" href="../images/logotipocw.png" />
    <link rel="stylesheet" href="partials/style.css">
    <link rel="stylesheet" href="css/ticket.css">
    <!--BOOTSTRAPS inicio-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <!--BOOTSRAPS FIM-->
</head>

<body>
    <header class="navbar">
        <?php include 'partials/header.php'; ?>
    </header>
    <main>
        <section id="contact">
            <h2>Contato</h2>
            <form id="contact-form" action="funcoes/processa_ticket.php" method="post">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($nome); ?>">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>">

                <label for="subject">Assunto:</label>
                <select id="subject" name="subject" required>
                    <option value="" disabled selected>Selecione um assunto</option>
                    <option value="Problema de Login">Problema de Login</option>
                    <option value="Dúvida sobre Curso">Dúvida sobre Curso</option>
                    <option value="Problema de Acesso ao Cursos">Problema de Acesso ao Cursos</option>
                    <option value="Outros">Outros</option>
                </select>

                <label for="message">Mensagem:</label>
                <textarea id="message" name="message" required></textarea>

                <button type="submit" class="btn-submit">Enviar</button>
            </form>
            <div id="response-message" class="hidden success-message">
                <i class="bi bi-check-circle"></i> Sua mensagem foi enviada!
            </div>
        </section>
    </main>
    <?php include 'partials/footer.php'; ?>
</body>

</html>