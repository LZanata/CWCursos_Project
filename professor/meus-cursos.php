<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meus Cursos - CW Cursos</title>
    <link rel="shortcut icon" href="../images/logotipocw.png" />
    <link rel="stylesheet" href="partials/style.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

    <?php include 'partials/header.php'; ?> <!-- Inclui o header -->

    <div class="container">
        <div class="welcome-text">
            <h1>Meus Cursos</h1>
            <p>Gerencie os cursos que você criou 📚</p>
        </div>
        <section class="list-section">

            <div class="course-card">
                <h3>Programação Web do Zero</h3>
                <p>Categoria: Tecnologia</p>
                <p>Dificuldade: Iniciante</p>
                <button class="btn-publicar">Editar Curso</button>
            </div>

            <div class="course-card">
                <h3>Design Gráfico Moderno</h3>
                <p>Categoria: Design</p>
                <p>Dificuldade: Intermediário</p>
                <button class="btn-publicar">Editar Curso</button>
            </div>

            <!-- + Outros cursos que o professor criar -->
        </section>
    </div>

    <?php include 'partials/footer.php'; ?> <!-- Inclui o footer -->
</body>

</html>