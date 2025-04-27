<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica se o formulário foi submetido
if (isset($_POST['submit'])) {
    include_once('../../funcoes/conexao.php'); // Inclui o arquivo de conexão com o banco de dados

    // Obtém os dados do formulário
    $nome = trim($_POST['nome']);
    $usuario = trim($_POST['usuario']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confisenha = $_POST['confirmSenha'];
    $dataNascimento = $_POST['dataNascimento'];
    $defaultPhoto = 'images/default_profile.jpg'; // Foto padrão

    // Verifica se o campo tipoUsuario foi enviado
    if (isset($_POST['tipoUsuario'])) {
        $tipoUsuario = $_POST['tipoUsuario']; // 'professor' ou 'administrador'
    } else {
        echo "<script>alert('Por favor, selecione o tipo de usuário!'); window.history.back();</script>";
        exit;
    }

    // Verifica se as senhas coincidem
    if ($senha !== $confisenha) {
        echo "<script>alert('As senhas não coincidem!'); window.history.back();</script>";
        exit;
    }

    // Verifica se o usuário ou e-mail já estão cadastrados
    $checkQuery = "SELECT * FROM usuarios WHERE usuario = ? OR email = ?";
    $stmt = $conexao->prepare($checkQuery);
    $stmt->bind_param("ss", $usuario, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Usuário ou e-mail já cadastrado!'); window.history.back();</script>";
        exit;
    }

    // Tudo certo, agora vamos cadastrar
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT); // Hash da senha

    $insertQuery = "INSERT INTO usuarios (nome, usuario, email, senha, data_nascimento, tipo, status, photo) 
                    VALUES (?, ?, ?, ?, ?, ?, 'ativo', ?)";

    $stmt = $conexao->prepare($insertQuery);
    $stmt->bind_param("sssssss", $nome, $usuario, $email, $senhaHash, $dataNascimento, $tipoUsuario, $defaultPhoto);

    if ($stmt->execute()) {
        echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href='http://localhost/AAP-CW_Cursos/adm/index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Erro ao cadastrar o usuário!'); window.history.back();</script>";
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR"> 
<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="cadastroAdmTeacher.css">
</head>
<body>
    <!-- Link para voltar à página inicial -->
    <a href="adm.html">Voltar</a>
    
    <!-- Container principal -->
    <div class="container">
    <form action="cadastroAdmTeacher.php" method="POST"> <!-- Formulário de cadastro -->
            <div class="card">
                <h1>Cadastrar</h1> <!-- Título do formulário -->

                <div id="msgError"></div> <!-- Mensagem de erro -->
                <div id="msgSuccess"></div> <!-- Mensagem de sucesso -->

                <!-- Campo de nome com label flutuante -->
                <div class="label-float">
                    <input type="text" name="nome" id="nome" placeholder=" " required /> 
                    <label id="labelNome" for="nome">Nome</label>
                </div>

                <!-- Campo de usuário com label flutuante -->
                <div class="label-float">
                    <input type="text" name="usuario" id="usuario" placeholder=" " required /> 
                    <label id="labelUsuario" for="usuario">Usuario</label>
                </div>

                <!-- Campo de e-mail com label flutuante -->
                <div class="label-float">
                    <input type="email" name="email" required placeholder=" " />
                    <label for="email">E-mail</label>
                </div>

                <!-- Campo de data de nascimento com label flutuante -->
                <div class="label-float">
                    <input type="date" name="dataNascimento" id="dataNascimento" placeholder=" " required /> 
                    <label id="labelDataNascimento" for="dataNascimento">Data de Nascimento</label>
                </div>

                <!-- Campo de senha com label flutuante -->
                <div class="label-float">
                    <input type="password" name="senha" id="senha" placeholder=" " required /> 
                    <label id="labelSenha" for="senha">Senha</label>
                    <i id="verSenha" class="fa fa-eye" aria-hidden="true"></i> <!-- Ícone de olho -->
                </div>

                <!-- Campo de confirmação de senha com label flutuante -->
                <div class="label-float">
                    <input type="password" name="confirmSenha" id="confirmSenha" placeholder=" " required /> 
                    <label id="labelConfirmSenha" for="confirmSenha">Confirmar Senha</label>
                    <i id="verConfirmSenha" class="fa fa-eye" aria-hidden="true"></i> <!-- Ícone de olho -->
                </div>

                <!-- Campo de tipo de usuário com label flutuante -->
                <div class="label-float">
                    <select name="tipoUsuario" id="tipoUsuario" required>
                        <option value="" disabled selected></option>
                        <option value="professor">Professor</option>
                        <option value="administrador">Administrador</option>
                    </select>
                    <label for="tipoUsuario">Tipo de Usuário</label>
                </div>

                <!-- Botão de submit centralizado -->
                <div class="justify-center">
                    <button type="submit" name="submit">Cadastrar</button> 
                </div>
            </div>
        </form> 
    </div>
</body>
</html>
