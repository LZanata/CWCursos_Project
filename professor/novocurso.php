<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Criar Novo Curso - CW Cursos</title>
  <link rel="shortcut icon" href="../images/logotipocw.png" />
  <link rel="stylesheet" href="partials/style.css">
</head>

<body>

  <header>
    <div class="header-content">
      <div class="top-bar">
        <div class="welcome-text">
          <h1>Criar Novo Curso</h1>
          <p>Preencha as informações para publicar seu curso 🚀</p>
        </div>
        <button class="menu-toggle" id="menu-toggle">☰</button>
      </div>
      <?php include 'partials/header.php'; ?> <!-- Inclui o header -->
    </div>
  </header>

  <div class="container">
    <section class="form-section">
      <form class="course-form" id="course-form">
        <div class="form-group">
          <label for="nome-curso">Nome do Curso</label>
          <input type="text" id="nome-curso" name="nome-curso" placeholder="Ex: Programação para Iniciantes" required>
        </div>

        <div class="form-group">
          <label for="categoria">Categoria</label>
          <input type="text" id="categoria" name="categoria" placeholder="Ex: Tecnologia, Design, Negócios" required>
        </div>

        <div class="form-group">
          <label for="descricao">Descrição</label>
          <textarea id="descricao" name="descricao" rows="5" placeholder="Descreva o que o aluno aprenderá..." required></textarea>
        </div>

        <div class="form-group">
          <label for="imagem">Imagem de Capa</label>
          <input type="file" id="imagem" name="imagem" accept="image/*" required>
        </div>

        <div class="form-group">
          <label for="dificuldade">Dificuldade</label>
          <select id="dificuldade" name="dificuldade" required>
            <option value="">Selecione</option>
            <option value="iniciante">Iniciante</option>
            <option value="intermediario">Intermediário</option>
            <option value="avancado">Avançado</option>
          </select>
        </div>

        <div class="form-group">
          <button type="submit" class="btn-publicar">Publicar Curso</button>
        </div>
      </form>
    </section>
  </div>

  <?php include 'partials/footer.php'; ?> <!-- Inclui o footer -->

  <script src="script.js"></script>
</body>

</html>