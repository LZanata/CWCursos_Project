<?php
session_start();
include_once('../../funcoes/conexao.php');

if (!isset($_SESSION)) session_start();

if (isset($_POST['submit'])) {
    $login = trim($_POST['login']);
    $senha = $_POST['senha'];

    $query = "SELECT * FROM usuarios WHERE (usuario = ? OR email = ?) AND tipo = 'professor'";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("ss", $login, $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['usuario'] = $user['usuario'];
            unset($_SESSION['msg']);
            header('Location: Painel professor/index.html');
            exit();
        } else {
            $_SESSION['msg'] = 'Senha incorreta!';
        }
    } else {
        $_SESSION['msg'] = 'Usuário ou e-mail inválido!';
    }

    $stmt->close();
    $conexao->close();

    header("Location: loginprof.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login Professor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="signin.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Entrar como Professor</h1>
            <?php
            if (!empty($_SESSION['msg'])) {
                echo "<div class='error-msg'>" . $_SESSION['msg'] . "</div>";
                unset($_SESSION['msg']);
            }
            ?>
            <form method="POST" action="">
                <div class="label-float">
                    <input type="text" name="login" id="login" placeholder=" " required>
                    <label for="login">Usuário ou E-mail</label>
                </div>
                <div class="label-float">
                    <input type="password" name="senha" id="senha" placeholder=" " required>
                    <label for="senha">Senha</label>
                    <span class="mostrar-senha" onclick="toggleSenha('senha', this)">
                        <i class="bi bi-eye" aria-hidden="true"></i>
                    </span> <!-- Ícone de olho -->
                </div>
                <div class="justify-center">
                    <input class="inputSubmit" type="submit" name="submit" value="Entrar">
                </div>
            </form>
            <p>Não mandou o formulário para cadastro?<a href="inscricoes/forms.php"> Clique aqui</a></p>
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