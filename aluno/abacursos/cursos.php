<?php
// Conexão com o banco de dados principal
include_once('../../funcoes/conexao.php');

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Consulta para buscar os cursos com imagem e vídeo
$sql = "SELECT nome_curso AS titulo, descricao, imagem, video_url FROM cursos";
$result = $conexao->query($sql);

$cursos = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cursos[] = $row;
    }
}

// Retorna os dados em formato JSON
echo json_encode($cursos);

$conexao->close();
?>
