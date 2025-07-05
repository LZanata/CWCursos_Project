<?php
session_start();
session_destroy(); // Destroi a sessão
header('Location: ../../TelaInicial/index.php'); // Redireciona para a página de login
exit();
?>
