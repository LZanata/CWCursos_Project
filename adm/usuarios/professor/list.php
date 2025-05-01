<?php
session_start();
include '../../../funcoes/conexao.php';

$busca = $_GET['busca'] ?? '';
$type = $_GET['type'] ?? 'professor';

$query = "SELECT * FROM usuarios WHERE tipo = '$type'";
if (!empty($busca)) {
    $busca = mysqli_real_escape_string($conexao, $busca);
    $query .= " AND (nome LIKE '%$busca%' OR email LIKE '%$busca%' OR usuario LIKE '%$busca%')";
}
$query .= " ORDER BY nome ASC";
$result = mysqli_query($conexao, $query);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= ucfirst($type) ?>es Cadastrados</title>
    <link rel="shortcut icon" href="../../../images/logotipocw.png" />
    <link rel="stylesheet" href="css/list.css">
    <link rel="stylesheet" href="../partials/style.css">
</head>
<body>
    <?php include '../partials/header.php'; ?>

    <div class="container">
        <h2><?= ucfirst($type) ?>es Cadastrados</h2>

        <form method="GET" class="form-busca">
            <input type="hidden" name="type" value="<?= htmlspecialchars($type) ?>">
            <input type="text" name="busca" placeholder="Buscar por nome, email ou usuário..." value="<?= htmlspecialchars($busca) ?>">
            <button type="submit">Buscar</button>
        </form>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>Email</th>
                        <th>Data de Nascimento</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($row['photo']) ?>" alt="Foto" width="40" height="40" style="border-radius: 50%;"></td>
                            <td><?= htmlspecialchars($row['nome']) ?></td>
                            <td><?= htmlspecialchars($row['usuario']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= date('d/m/Y', strtotime($row['data_nascimento'])) ?></td>
                            <td><?= ucfirst($row['status']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum <?= $type ?> encontrado.</p>
        <?php endif; ?>
    </div>

    <?php include '../partials/footer.php'; ?>
</body>
</html>
