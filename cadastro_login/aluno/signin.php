<?php
// Inicia a sessão para poder usar variáveis de sessão
session_start();

// Inclui o arquivo de conexão com o banco de dados
include_once('../../funcoes/conexao.php');

// Verifica se o formulário foi enviado via POST e se o botão de submit foi clicado
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {

    // Captura os dados enviados pelo formulário
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Prepara a consulta para buscar o usuário no banco com base no usuário e e-mail informados
    $query = "SELECT * FROM usuarios WHERE usuario = ? AND email = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("ss", $usuario, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se encontrou exatamente um usuário com os dados fornecidos
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifica se a senha fornecida confere com o hash salvo no banco
        if (password_verify($senha, $user['senha'])) {

            // Se tudo estiver correto, armazena os dados do usuário na sessão
            $_SESSION['id'] = $user['id'];
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['usuario'] = $user['usuario'];
            $_SESSION['tipo'] = $user['tipo'];
            $_SESSION['status'] = $user['status'];

            // Redireciona para a tela inicial
            header("Location: http://localhost/AAP-CW_Cursos/aluno/sistema.php");
            exit;
        } else {
            // Caso a senha esteja incorreta
            echo "<script>alert('Senha incorreta.');</script>";
        }
    } else {
        // Caso o usuário ou e-mail não existam no banco
        echo "<script>alert('Usuário ou e-mail não encontrados.');</script>";
    }

    // Encerra o statement e a conexão com o banco
    $stmt->close();
    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="signin.css">
<link rel="stylesheet" href="../index.css">
<title>Sign-in</title>
</head>

<body>
    <!-- Container principal -->
    <div class="container">
        <div class="card">
            <h1>Entrar</h1> <!-- Título do formulário -->
            <form action="" method="POST"> <!-- Formulário de login -->
                <div id="msgError"></div> <!-- Mensagem de erro -->

                <!-- Campo de usuário com label flutuante -->
                <div class="label-float">
                    <input type="text" name="usuario" id="usuario" placeholder=" " required />
                    <label id="userLabel" for="usuario">Usuario</label>
                </div>

                <div class="label-float">
                    <input type="email" name="email" required placeholder=" " />
                    <label for="email">E-mail</label>
                </div>

                <!-- Campo de senha com label flutuante -->
                <div class="label-float">
                    <input type="password" name="senha" id="senha" placeholder=" " required />
                    <label id="senhaLabel" for="senha">Senha</label>
                    <span class="mostrar-senha" onclick="toggleSenha('senha', this)">
                        <i class="bi bi-eye" aria-hidden="true"></i>
                    </span> <!-- Ícone de olho -->
                </div>

                <!-- Campo de esqueci a senha com link para a página de recuperar a senha -->
                <div class="esqueci-group">
                    <div class="esqueci">
                        <a href="../recuperar_senha.php">Esqueci minha senha</a>
                    </div>
                </div>

                <!-- Botão de submit centralizado -->
                <div class="justify-center">
                    <input class="inputSubmit" type="submit" name="submit" value="Entrar">
                </div>
            </form>

            <!-- Link para a página de cadastro -->
            <p>Não tem uma conta? <a href="signup.php">Cadastre-se</a></p>
        </div>
    </div>
    <script>
        function toggleSenha(id, el) {
            const input = document.getElementById(id);
            const icon = el.querySelector('i');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }
    </script>
</body>

</html>