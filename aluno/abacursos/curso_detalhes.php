<?php
include_once('../../funcoes/conexao.php');

$conexao = new mysqli($host, $user, $pass, $db);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

$id = intval($_GET['id']);
$sql = "SELECT id, nome_curso AS titulo, descricao, imagem, video_url FROM cursos WHERE id = $id";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    $curso = $result->fetch_assoc();
    echo json_encode($curso);
} else {
    echo json_encode([]);
}

$conexao->close();
?>
