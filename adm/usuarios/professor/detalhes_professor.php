<?php
session_start();
require '../../../funcoes/conexao.php';

if (!isset($_GET['id'])) {
    echo "ID do professor não fornecido.";
    exit;
}

$id = intval($_GET['id']);

// Buscar dados do professor na tabela temporária
$stmt = $conexao->prepare("SELECT * FROM professores_voluntarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Professor não encontrado.";
    exit;
}

$professor = $result->fetch_assoc();

// Se clicou no botão de aprovação
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aprovar'])) {
    $nome = $professor['nome'];
    $data_nascimento = $professor['data_nascimento'];

    // Gerar e-mail único no formato base + número aleatório
    $base_email = preg_replace('/[^a-z0-9]/i', '', strtolower(explode('@', $professor['email'])[0]));
    do {
        $numero = rand(100, 999);
        $email_cw = $base_email . $numero . '@cwprof.com';

        // Verifica se o e-mail já existe na tabela usuarios
        $check_email = $conexao->prepare("SELECT id FROM usuarios WHERE email = ?");
        $check_email->bind_param("s", $email_cw);
        $check_email->execute();
        $check_email->store_result();
    } while ($check_email->num_rows > 0);

    // Gerar hash da senha padrão
    $senha_padrao = password_hash("cwprof1234", PASSWORD_DEFAULT);

    // Inserir novo professor na tabela de usuários
    $usuario = $base_email . $numero;

    $insert = $conexao->prepare("INSERT INTO usuarios (nome, usuario, email, senha, data_nascimento, tipo, status) VALUES (?, ?, ?, ?, ?, 'professor', 'ativo')");
    $insert->bind_param("sssss", $nome, $usuario, $email_cw, $senha_padrao, $data_nascimento);


    if ($insert->execute()) {
        // Excluir da tabela de voluntários
        $delete = $conexao->prepare("DELETE FROM professores_voluntarios WHERE id = ?");
        $delete->bind_param("i", $id);
        $delete->execute();

        $mensagem = "✅ Professor aprovado com sucesso!<br>E-mail: <strong>$email_cw</strong><br>Usuário: <strong>$usuario</strong>";
    } else {
        $erro = "❌ Erro ao cadastrar professor: " . $insert->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Detalhes do Professor</title>
    <link rel="shortcut icon" href="../../images/logotipocw.png" />
    <link rel="stylesheet" href="css/detalhes_professor.css">
    <link rel="stylesheet" href="../partials/style.css">
</head>

<body>
    <?php include '../partials/header.php'; ?>
    <div class="container">
        <div class="detail-header">
            <h2>Detalhes do Professor</h2>

            <?php if (isset($mensagem)): ?>
                <p style="color:green;"><?= $mensagem ?></p>
            <?php endif; ?>

            <?php if (isset($erro)): ?>
                <p style="color:red;"><?= $erro ?></p>
            <?php endif; ?>
        </div>
        <div class="detail-main">
            <ul>
                <li><strong>Nome:</strong> <?= htmlspecialchars($professor['nome']) ?></li>
                <li><strong>CPF:</strong> <?= htmlspecialchars($professor['cpf']) ?></li>
                <li><strong>RG:</strong> <?= htmlspecialchars($professor['rg']) ?></li>
                <li><strong>Data de Nascimento:</strong> <?= date('d/m/Y', strtotime($professor['data_nascimento'])) ?></li>
                <li><strong>Endereço:</strong> <?= htmlspecialchars($professor['endereco']) ?></li>
                <li><strong>Email:</strong> <?= htmlspecialchars($professor['email']) ?></li>
                <li><strong>Telefone:</strong> <?= htmlspecialchars($professor['telefone']) ?></li>
                <li><strong>LinkedIn:</strong> <a href="<?= htmlspecialchars($professor['linkedin']) ?>" target="_blank"><?= htmlspecialchars($professor['linkedin']) ?></a></li>
                <li><strong>Área de Conhecimento:</strong> <?= htmlspecialchars($professor['area_conhecimento']) ?></li>
                <li><strong>Disponibilidade:</strong> <?= htmlspecialchars($professor['disponibilidade']) ?></li>
                <li><strong>Experiência:</strong><br> <?= nl2br(htmlspecialchars($professor['experiencia'])) ?></li>
                <li><strong>Currículo (PDF):</strong>
                    <?php if (!empty($professor['curriculo'])): ?>
                        <a href="../../../uploads/<?= $professor['curriculo'] ?>" target="_blank">Visualizar Currículo</a>
                    <?php else: ?>
                        Não enviado
                    <?php endif; ?>
                </li>
            </ul>
        </div>
        <div class="detail-button">
            <?php if (!isset($mensagem)): ?>
                <form method="post" onsubmit="return confirmarAprovacao()">
                    <button type="submit" name="aprovar">Aprovar e Cadastrar</button>
                </form>
            <?php endif; ?>
            <a href="add_professor.php?type=professor&status=pendente" class="btn-voltar">Voltar</a>
        </div>
    </div>
    <?php include '../partials/footer.php'; ?>
    <script>
        function confirmarAprovacao() {
            return confirm("Tem certeza que deseja aprovar este professor e cadastrá-lo na plataforma?");
        }
    </script>

</body>

</html>