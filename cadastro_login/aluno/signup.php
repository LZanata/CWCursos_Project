<?php
// Verifica se o formulário foi submetido
if (isset($_POST['submit'])) {
    include_once('config.php'); // Inclui o arquivo de configuração

    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confisenha = $_POST['confirmSenha'];
    $dataNascimento = $_POST['dataNascimento']; // Nova variável para a data de nascimento

    // Verifica se as senhas coincidem
    if ($senha !== $confisenha) {
        echo "<script>alert('As senhas não coincidem!');</script>";
        exit;
    }

    // Verifica se o usuário ou e-mail já estão cadastrados
    $checkQuery = "SELECT * FROM usuarios WHERE usuario = ? OR email = ?";
    $stmt = $conexao->prepare($checkQuery);
    $stmt->bind_param("ss", $usuario, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Se o nome de usuário já existe, exibe uma mensagem de erro
        echo "<script>alert('O nome de usuário já existe. Escolha outro.');</script>";
    } else {
        // Hash da senha para segurança
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // Insere os dados no banco de dados
        $insertQuery = "INSERT INTO usuarios (nome, usuario, email, senha, confsenha, data_nascimento) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($insertQuery);
        $stmt->bind_param("ssssss", $nome, $usuario, $email, $senhaHash, $confisenha, $dataNascimento);

        if ($stmt->execute()) {
            // Aguarda um momento para garantir que o banco de dados seja atualizado corretamente
            sleep(1); // Adiciona uma pequena pausa para garantir a atualização do banco

            // Exibe mensagem de sucesso e redireciona para home.html
            echo "<script>
                    alert('Usuário cadastrado com sucesso!');
                    window.location.href = 'TelaInicial/index.html';
                    </script>";
        } else {
            echo "<script>alert('Erro ao cadastrar o usuário.');</script>";
        }
    }

    // Fecha as conexões
    $stmt->close();
    $conexao->close();
}
?>


<!DOCTYPE html>
<html lang="pt-BR"> 
<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="signup.css">
</head>
<body>   
    <!-- Container principal -->
    <div class="container">
        <form action="signup.php" method="POST"> <!-- Formulário de cadastro -->
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

                <!-- Botão de submit centralizado -->
                <div class="justify-center">
                    <button type="submit" name="submit">Cadastrar</button> 
                </div>
            </div>
        </form> 
    </div>
</body>
</html>
