<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <link rel="shortcut icon" href="../images/logotipocw.png" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cursos.css">
</head>

<body>
    <div class="container">

        <?php include 'partials/header.php'; ?> <!-- Inclui o header -->

        <main>
            <section id="cursos" class="section">
                <div class="course-container">
                    <h2>Gerenciar Cursos</h2>

                    <!-- Formulário para adicionar curso -->
                    <form action="add_course.php" method="POST" enctype="multipart/form-data">
                        <label for="nome_curso">Nome do Curso:</label>
                        <input type="text" id="nome_curso" name="nome_curso" required>

                        <label for="descricao">Descrição do Curso:</label>
                        <textarea id="descricao" name="descricao" rows="4" required></textarea>

                        <label for="duracao">Duração (em horas):</label>
                        <input type="number" id="duracao" name="duracao" required>

                        <label for="imagem">Imagem do Curso:</label>
                        <label class="custom-file-upload">
                            <input type="file" id="imagem" name="imagem" accept="image/*">
                            Escolher Imagem
                        </label>

                        <label for="video_url">Link do Vídeo (URL) ou Arquivo de Vídeo:</label>
                        <input type="text" id="video_url" name="video_url" placeholder="Cole o link do vídeo">
                        <label class="custom-file-upload">
                            <input type="file" id="video_file" name="video_file" accept="video/*">
                            Escolher Vídeo
                        </label>

                        <button type="submit">Adicionar Curso</button>
                    </form>

                    <!-- Botão Listar Cursos -->
                    <button class="list-button" onclick="window.location.href='list_courses.php'">Listar Cursos</button>
                </div>
            </section>
        </main>
    </div>

</body>

</html>