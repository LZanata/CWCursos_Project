<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adicionar Aula - CW Cursos</title>
    <link rel="shortcut icon" href="../images/logotipocw.png" />
    <link rel="stylesheet" href="partials/style.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

    <?php include 'partials/header.php'; ?> <!-- Inclui o header -->

    <div class="container">
        <div class="welcome-text">
            <h1>Adicionar Aula</h1>
            <p>Preencha as informações para adicionar uma nova aula 📚</p>
        </div>
        <section class="form-section">
            <form class="course-form">
                <div class="form-group">
                    <label for="curso">Curso</label>
                    <input type="text" id="curso" name="curso" placeholder="Nome do curso" required>
                </div>

                <div class="form-group">
                    <label for="titulo">Título da Aula</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Ex: Introdução ao Curso" required>
                </div>

                <div class="form-group">
                    <label for="descricao-aula">Descrição da Aula</label>
                    <textarea id="descricao-aula" name="descricao-aula" rows="5" placeholder="Detalhes do conteúdo da aula..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="video">Link do Vídeo</label>
                    <input type="url" id="video" name="video" placeholder="URL do vídeo (YouTube, Vimeo...)" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-publicar">Adicionar Aula</button>
                </div>
            </form>
        </section>
    </div>

    <?php include 'partials/footer.php'; ?> <!-- Inclui o footer -->

</body>

</html>