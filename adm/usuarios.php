<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <link rel="shortcut icon" href="../images/logotipocw.png" />
    <link rel="stylesheet" href="partials/style.css">
    <link rel="stylesheet" href="css/usuarios.css">
</head>

<body>
    <?php include 'partials/header.php'; ?> <!-- Inclui o header -->
    <div class="container">

        <main>
            <section id="usuarios" class="section">
                <h2>Gerenciar Usuários</h2>

                <h3>Alunos</h3>
                <button onclick="window.location.href='../signup.php?type=aluno'">Adicionar Aluno</button>
                <button onclick="window.location.href='list_users.php?type=aluno'">Listar Alunos</button>

                <h3>Professores Pendentes</h3>
                <button onclick="window.location.href='cadastro/cadastroAdmTeacher.php?type=professor'">Adicionar Professor</button>
                <button onclick="window.location.href='list_users.php?type=professor&status=pendente'">Listar Professores</button>

                <h3>Administradores</h3>
                <button onclick="window.location.href='cadastroAdmTeacher.php?type=administrador'">Adicionar Administrador</button>
                <button onclick="window.location.href='list_users.php?type=administrador'">Listar Administradores</button>
            </section>
        </main>
    </div>
    <?php include 'partials/footer.php'; ?> <!-- Inclui o footer -->
</body>

</html>