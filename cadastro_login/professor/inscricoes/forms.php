<?php
// Inclui o arquivo de conexão com o banco de dados
include '../../../funcoes/conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $data_nascimento = $_POST['data_nascimento'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $linkedin = $_POST['linkedin'];
    $experiencia = $_POST['experiencia'];
    $area_conhecimento = $_POST['area_conhecimento'];
    $disponibilidade = $_POST['disponibilidade'];

    // Tratamento do upload do currículo
    $curriculo_dir = "uploads/curriculos/"; // Diretório onde o currículo será salvo
    $curriculo_path = $curriculo_dir . basename($_FILES["curriculo"]["name"]);
    $curriculo_tipo = strtolower(pathinfo($curriculo_path, PATHINFO_EXTENSION));

    // Valida se o arquivo é um PDF
    if($curriculo_tipo != "pdf") {
        die("Erro: Apenas arquivos PDF são permitidos para o currículo.");
    }

    // Verifica se o diretório existe, se não, cria o diretório
    if (!is_dir($curriculo_dir)) {
        mkdir($curriculo_dir, 0777, true);
    }

    // Tenta mover o arquivo para o servidor
    if (move_uploaded_file($_FILES["curriculo"]["tmp_name"], $curriculo_path)) {
        // Prepara a query SQL para inserir os dados
        $sql = "INSERT INTO professores_voluntarios (nome, cpf, rg, data_nascimento, endereco, email, telefone, linkedin, experiencia, area_conhecimento, disponibilidade, curriculo)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conexao->prepare($sql)) {
            // Associa os parâmetros à instrução preparada
            $stmt->bind_param("ssssssssssss", $nome, $cpf, $rg, $data_nascimento, $endereco, $email, $telefone, $linkedin, $experiencia, $area_conhecimento, $disponibilidade, $curriculo_path);
            
            if ($stmt->execute()) {
                // Se a inscrição for bem-sucedida, exibe um alert e redireciona para o formulário
                echo "<script>alert('Inscrição realizada com sucesso!'); window.location.href='forms.html';</script>";
            } else {
                echo "<script>alert('Ocorreu um erro ao enviar a inscrição. Tente novamente.'); window.location.href='forms.html';</script>";
            }

            // Fecha a instrução
            $stmt->close();
        } else {
            echo "Erro no banco de dados: Não foi possível preparar a consulta.";
        }
    } else {
        echo "Erro: Falha ao enviar o currículo. Por favor, tente novamente.";
    }

    // Fecha a conexão com o banco de dados
    $conexao->close();
} else {
    echo "Erro: Requisição inválida.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Inscrição - Professor Voluntário</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    /* Estilo geral */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: url('../images/formsfundo.jpeg') no-repeat center center fixed; /* URL da imagem */
    background-size: cover;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    filter: brightness(90%) blur(0.1px); /* Leve ajuste de brilho e desfoque */
}


/* Container do formulário com scroll */
form {
    background-color: rgba(255, 255, 255, 0.9); /* Fundo semi-transparente */
    max-width: 500px;
    width: 100%;
    padding: 30px;
    margin: 20px auto;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    overflow-y: auto;
    max-height: 70vh;
    transition: 0.3s ease;
}

form:hover {
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
}

/* Títulos internos */
h3 {
    color: #555555;
    font-size: 18px;
    margin-bottom: 10px;
}

/* Labels e campos */
label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333333;
}

input[type="text"], input[type="email"], input[type="tel"], input[type="url"], 
input[type="date"], textarea, input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #cccccc;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.2s;
}

input[type="text"]:focus, input[type="email"]:focus, input[type="tel"]:focus, 
input[type="url"]:focus, input[type="date"]:focus, textarea:focus {
    border-color: #0d6efd;
    outline: none;
}

textarea {
    resize: vertical;
}

/* Botão de envio */
button[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #0d6efd;
    border: none;
    border-radius: 5px;
    color: white;
    font-size: 16px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.2s ease;
}

button[type="submit"]:hover {
    background-color: #084bbf;
}

/* Aviso LGPD */
.lgpd {
    font-size: 14px;
    color: #666666;
    text-align: center;
    margin-top: 10px;
}

/* Responsivo */
@media (max-width: 600px) {
    form {
        padding: 20px;
    }

    h2, h3 {
        font-size: 18px;
    }

    button[type="submit"] {
        font-size: 14px;
    }
}

</style>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <!-- Seção de Dados Pessoais -->
        <h3>Dados Pessoais</h3>
        <label for="nome">Nome Completo:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" maxlength="11" pattern="\d{11}" title="Digite apenas números (11 dígitos)" required>

        <label for="rg">RG:</label>
        <input type="text" id="rg" name="rg" maxlength="9" pattern="\d{7,9}" title="Digite entre 7 e 9 dígitos numéricos" required>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required>

        <label for="endereco">Endereço Completo:</label>
        <input type="text" id="endereco" name="endereco" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone">

        <label for="linkedin">LinkedIn:</label>
        <input type="url" id="linkedin" name="linkedin">

        <!-- Seção de Perguntas -->
        <h3>Perguntas</h3>
        <label for="experiencia">Qual sua experiência com Marketing Digital?</label>
        <textarea id="experiencia" name="experiencia" rows="4" required></textarea>

        <label for="area_conhecimento">Áreas de Conhecimento em Marketing (ex.: SEO, Redes Sociais, E-mail Marketing):</label>
        <input type="text" id="area_conhecimento" name="area_conhecimento" required>

        <label for="disponibilidade">Disponibilidade de Horas por Semana para Produção de Conteúdo:</label>
        <input type="text" id="disponibilidade" name="disponibilidade">

        <!-- Envio de Currículo -->
        <h3>Envio de Currículo</h3>
        <label for="curriculo">Currículo (em PDF):</label>
        <input type="file" id="curriculo" name="curriculo" accept=".pdf" required><br><br>

        <!-- Termos de Uso LGPD -->
        <p class="lgpd">Seus dados serão tratados de acordo com a <strong>Lei Geral de Proteção de Dados Pessoais (LGPD)</strong>. Ao enviar este formulário, você concorda com o uso das informações para fins de avaliação e contato.</p>

        <button type="submit">Enviar Inscrição</button>
    </form>
</body>
</html>
