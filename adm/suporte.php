<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/suporte.css">
</head>

<body>
    <div class="container">

        <?php include 'partials/header.php'; ?> <!-- Inclui o header -->

        <main>

            <section id="suporte" class="section">
                <h2>Suporte</h2>
                <button onclick="listMessages()">Listar Mensagens</button>
                <div id="messageList" class="list"></div>
            </section>

        </main>
    </div>

</body>

</html>