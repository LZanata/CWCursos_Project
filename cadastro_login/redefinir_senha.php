<?php
// Mensagem de retorno para o usuário
$mensagem = "";
$classeMensagem = "";

// Recupera o token da URL
$token = $_GET["token"] ?? '';
$token_hash = hash("sha256", $token);

// Conexão com o banco de dados
$conexao = require __DIR__ . "/../funcoes/conexao.php";

// Consulta para buscar o usuário com base no hash do token
$sql = "SELECT * FROM usuarios WHERE reset_token_hash = ?";
$stmt = $conexao->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $token_hash);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
    $stmt->close();

    // Verifica se encontrou o usuário e se o token ainda está válido
    if (!$usuario) {
        $mensagem = "Token inválido ou inexistente.";
        $classeMensagem = "erro";
    } elseif (strtotime($usuario["reset_token_expires_at"]) <= time()) {
        $mensagem = "Token expirado. Solicite uma nova recuperação.";
        $classeMensagem = "erro";
    }
} else {
    $mensagem = "Erro ao consultar o banco de dados.";
    $classeMensagem = "erro";
}

// Se o formulário foi enviado e o token é válido
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($usuario)) {
    $novaSenha = $_POST["new_password"];
    $confirmacaoSenha = $_POST["confirm_password"];

    // Verifica se as senhas coincidem
    if ($novaSenha === $confirmacaoSenha) {
        // Criptografa a nova senha
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

        // Atualiza a senha e limpa o token
        $updateSql = "UPDATE usuarios SET senha = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE id = ?";
        $updateStmt = $conexao->prepare($updateSql);

        if ($updateStmt) {
            $updateStmt->bind_param("si", $senhaHash, $usuario['id']);
            $updateStmt->execute();

            if ($updateStmt->affected_rows > 0) {
                $mensagem = "Senha alterada com sucesso! Redirecionando para login...";
                $classeMensagem = "sucesso";
                header("refresh:3;url=http://localhost/AAP-CW_Cursos/index.php");
            } else {
                $mensagem = "Erro ao atualizar a senha. Tente novamente.";
                $classeMensagem = "erro";
            }

            $updateStmt->close();
        } else {
            $mensagem = "Erro ao preparar atualização: " . $conexao->error;
            $classeMensagem = "erro";
        }
    } else {
        $mensagem = "As senhas não coincidem.";
        $classeMensagem = "erro";
    }
}
?>


<!-- HTML da página de redefinição de senha -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .mensagem {
            margin: 10px 0;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }

        .sucesso {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .erro {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .forca-senha {
            font-size: 0.9em;
            margin-top: 4px;
        }

        .fraca {
            color: red;
        }

        .media {
            color: orange;
        }

        .forte {
            color: green;
        }

        .mostrar-senha {
            cursor: pointer;
            font-size: 14px;
            color: #007bff;
            margin-top: -10px;
            margin-bottom: 10px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <form method="POST" class="formLogin">
                <div class="titulo">
                    <h1>Redefinir Senha</h1>
                </div>
                <!-- Exibe mensagens de sucesso ou erro -->
                <?php if ($mensagem): ?>
                    <div class="mensagem <?= $classeMensagem ?>">
                        <?= $mensagem ?>
                    </div>
                <?php endif; ?>
                <div class="label-float">
                    <input type="password" name="new_password" id="new_password" maxlength="15" required />
                    <label for="new_password">Nova senha</label>
                    <div class="mostrar-senha" onclick="toggleSenha('new_password')">👁️ Mostrar senha</div>
                    <div id="forcaSenha" class="forca-senha"></div>
                </div>
                <div class="label-float">
                    <input type="password" name="confirm_password" id="confirm_password" maxlength="15" required />
                    <label for="confirm_password">Confirme a nova senha</label>
                    <div class="mostrar-senha" onclick="toggleSenha('confirm_password')">👁️ Mostrar senha</div>
                </div>
                <div class="justify-center">
                    <input class="inputSubmit" type="submit" value="Alterar Senha" name="Alterar Senha" />
                </div>
            </form>
        </div>
    </div>

    <script>
        // Alterna o tipo do campo de senha entre "password" e "text"
        function toggleSenha(id) {
            const input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }

        // Analisa a força da senha digitada
        document.getElementById("new_password").addEventListener("input", function() {
            const valor = this.value;
            const forca = document.getElementById("forcaSenha");

            let nivel = 0;
            if (valor.length >= 6) nivel++;
            if (/[A-Z]/.test(valor)) nivel++;
            if (/[0-9]/.test(valor)) nivel++;
            if (/[^A-Za-z0-9]/.test(valor)) nivel++;

            if (nivel <= 1) {
                forca.textContent = "Senha fraca";
                forca.className = "forca-senha fraca";
            } else if (nivel === 2 || nivel === 3) {
                forca.textContent = "Senha média";
                forca.className = "forca-senha media";
            } else if (nivel >= 4) {
                forca.textContent = "Senha forte";
                forca.className = "forca-senha forte";
            } else {
                forca.textContent = "";
            }
        });
    </script>
</body>

</html>