<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Venha ensinar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../images/logotipocw.png" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="signin.css">
    <link rel="stylesheet" href="partials/style.css">
</head>

<body>
    <div class="container">

        <div class="header-main">
            <?php include 'partials/header.php'; ?> <!-- Inclui o header -->
        </div>
        <div class="container-main">
            <div class="container-card">
                <div class="card">
                    <h1>Venha dar aulas com a gente</h1>
                    <p>Seja um professor da CW e transforme vidas ensinando</p>
                    <?php
                    if (!empty($_SESSION['msg'])) {
                        echo "<div class='error-msg'>" . $_SESSION['msg'] . "</div>";
                        unset($_SESSION['msg']);
                    }
                    ?>

                    <div class="justify-center">
                        <a href="forms.php" class="inputSubmit" style="text-align: center;">Começar agora</a>
                    </div>
                </div>
            </div>
            <div class="card-image">
                <img src="../../images/mulher-sorrindo.png" alt="Mulher de oculos sorrindo">
            </div>
        </div>
        <?php include 'partials/footer.php'; ?> <!-- Inclui o footer -->

    </div>
</body>

</html>