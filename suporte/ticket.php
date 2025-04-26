<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte - Plataforma de Cursos</title>
    <link rel="stylesheet" href="partials/style.css">
    <link rel="stylesheet" href="css/ticket.css">
    <!--BOOTSTRAPS inicio-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <!--BOOTSRAPS FIM-->
    <style>
        .hidden {
            display: none;
        }

        #contact-form button {
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <?php include 'partials/header.php'; ?> <!-- Inclui o header -->
    </header>

    <main>
        <!-- Seção de contato -->
        <section id="contact">
            <h2>Contato</h2> <!-- Subtítulo da seção -->
            <form id="contact-form" action="#" method="post"> <!-- Formulário de contato -->
                <label for="name">Nome:</label> <!-- Rótulo para o campo nome -->
                <input type="text" id="name" name="name" required> <!-- Campo de entrada para o nome -->
                <label for="email">Email:</label> <!-- Rótulo para o campo email -->
                <input type="email" id="email" name="email" required> <!-- Campo de entrada para o email -->
                <label for="message">Mensagem:</label> <!-- Rótulo para o campo mensagem -->
                <textarea id="message" name="message" required></textarea> <!-- Área de texto para a mensagem -->
                <button type="submit">Enviar</button> <!-- Botão para enviar o formulário -->
            </form>
            <!-- Mensagem de resposta oculta -->
            <div id="response-message" class="hidden">Sua mensagem foi enviada! O prazo de resposta pode variar de 10 a 30 dias. Caso tenha alguma dúvida mais Urgente, ligue para 11999024689 e fale com nossa Central!</div>
        </section>
    </main>
    <?php include 'partials/footer.php'; ?> <!-- Inclui o footer -->
    <script src="scripts.js"></script> <!-- Link para o arquivo de script JavaScript externo -->
</body>

</html>