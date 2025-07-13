<?php
session_start();
session_destroy(); // Destroi a sessão
header('Location: ../../suporte/cadastro_login/signin.php'); // Redireciona para a página de login
exit();
?>