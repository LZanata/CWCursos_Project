<!DOCTYPE html>
<html lang="pt-br"> 
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="signin.css">
    <title>Sign-in</title> 
</head>
<body>     
    <!-- Container principal -->
    <div class="container">
        <div class="card">
            <h1>Entrar</h1> <!-- Título do formulário -->
            <form action="testeLogin.php" method="POST"> <!-- Formulário de login -->
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
                    <i class="fa fa-eye" aria-hidden="true"></i> <!-- Ícone de olho -->
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
</body>
</html>

