<?php
session_start();
include_once('../../funcoes/conexao.php');

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../cadastro_login/usuario/signin.php');
    exit();
}

$usuario_atual = $_SESSION['usuario'];

$novo_nome = trim($_POST['novo_nome']);
$novo_usuario = trim($_POST['novo_usuario']);
$novo_email = trim($_POST['novo_email']);
$nova_senha = $_POST['nova_senha'];
$confirmar_senha = $_POST['confirmar_senha'];

$erros = [];

// Verifica se deseja alterar senha
if (!empty($nova_senha) || !empty($confirmar_senha)) {
    if ($nova_senha !== $confirmar_senha) {
        $erros[] = "As senhas não coincidem.";
    } else {
        $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
    }
}

// Verificar duplicidade de e-mail
if (!empty($novo_email)) {
    $stmt = $conexao->prepare("SELECT id FROM usuarios WHERE email = ? AND usuario != ?");
    $stmt->bind_param("ss", $novo_email, $usuario_atual);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $erros[] = "Este e-mail já está em uso por outro usuário.";
    }
    $stmt->close();
}

// Verificar duplicidade de nome de usuário
if (!empty($novo_usuario)) {
    $stmt = $conexao->prepare("SELECT id FROM usuarios WHERE usuario = ? AND usuario != ?");
    $stmt->bind_param("ss", $novo_usuario, $usuario_atual);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $erros[] = "Este nome de usuário já está em uso.";
    }
    $stmt->close();
}

// Se houver erros, exibe e para o script
if (!empty($erros)) {
    foreach ($erros as $erro) {
        echo "<p style='color:red;'>$erro</p>";
    }
    exit();
}

// Monta o UPDATE
$sql = "UPDATE usuarios SET ";
$campos = [];
$parametros = [];
$tipos = "";

if (!empty($novo_nome)) {
    $campos[] = "nome = ?";
    $parametros[] = $novo_nome;
    $tipos .= "s";
}
if (!empty($novo_usuario)) {
    $campos[] = "usuario = ?";
    $parametros[] = $novo_usuario;
    $tipos .= "s";
}
if (!empty($novo_email)) {
    $campos[] = "email = ?";
    $parametros[] = $novo_email;
    $tipos .= "s";
}
if (!empty($nova_senha)) {
    $campos[] = "senha = ?";
    $parametros[] = $nova_senha_hash;
    $tipos .= "s";
}

if (count($campos) === 0) {
    header('Location: ../profile.php');
    exit();
}

$sql .= implode(", ", $campos) . " WHERE usuario = ?";
$parametros[] = $usuario_atual;
$tipos .= "s";

$stmt = $conexao->prepare($sql);
$stmt->bind_param($tipos, ...$parametros);

if ($stmt->execute()) {
    if (!empty($novo_usuario)) {
        $_SESSION['usuario'] = $novo_usuario;
        $usuario_atual = $novo_usuario;
    }
    $stmt->close();

    // Busca o tipo atualizado do usuário para redirecionar corretamente
    $stmt_tipo = $conexao->prepare("SELECT tipo FROM usuarios WHERE usuario = ?");
    $stmt_tipo->bind_param("s", $usuario_atual);
    $stmt_tipo->execute();
    $stmt_tipo->bind_result($tipo_usuario);
    $stmt_tipo->fetch();
    $stmt_tipo->close();

    // Redirecionamento conforme o tipo
    if ($tipo_usuario === 'administrador') {
        header("Location: ../../administrador/profile.php");
        exit;
    } elseif ($tipo_usuario === 'professor') {
        header("Location: ../../professor/profile.php");
        exit;
    } elseif ($tipo_usuario === 'aluno') {
        header("Location: ../../aluno/profile.php");
        exit;
    } else {
        echo "<p style='color:red;'>Tipo de usuário desconhecido.</p>";
    }
} else {
    echo "Erro ao atualizar dados: " . $stmt->error;
}
$conexao->close();
?>