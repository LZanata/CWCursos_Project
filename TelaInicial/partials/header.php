<header class="navbar">
    <div class="nav-header">
        <div class="logo"><a href="#">
                <img src="../images/logocwpreto_transparente.png" alt="Logo da CW Cursos" />
            </a></div>
        <div class="search-bar">
            <input type="text" placeholder="O que você gostaria de aprender?">
        </div>

        <nav class="nav-botoes">
            <?php if (isset($_SESSION['id']) && $_SESSION['tipo'] === 'aluno'): ?>
                <div class="btn-alunos">
                    <a href="../aluno/areadoaluno.php">
                        <button>Área do Aluno</button>
                    </a>
                </div>
            <?php else: ?>
                <a href="../cadastro_login/professor/signin.php" class="planos-btn">Seja um Professor</a>
                <a href="../cadastro_login/aluno/signin.php" class="planos-btn">Entrar</a>
                <a href="../cadastro_login/aluno/signup.php" class="planos-btn">Cadastrar-se</a>
            <?php endif; ?>
        </nav>
    </div>

    <div class="nav-main">
        <nav class="menu-desktop">
            <div class="menu-container">
                <div class="menu-toggle" id="menuToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <div class="menu-items" id="menuItems">
                    <div class="main-container">
                        <div class="main-content">
                            <a href="index.php"> Início </a>
                        </div>
                    </div>

                    <div class="main-container">
                        <div class="main-content">
                            <a href="cursos.php">Cursos</a>
                        </div>
                    </div>

                    <div class="main-container">
                        <div class="main-content">
                            <a href="sobre.php">Sobre</a>
                        </div>
                    </div>

                    <div class="main-container">
                        <div class="main-content">
                            <a href="ajuda.php">Ajuda</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<!-- Chatra {literal} -->
<script>
    (function(d, w, c) {
        w.ChatraID = 'igHEh7N4PEvoDEkR7';
        var s = d.createElement('script');
        w[c] = w[c] || function() {
            (w[c].q = w[c].q || []).push(arguments);
        };
        s.async = true;
        s.src = 'https://call.chatra.io/chatra.js';
        if (d.head) d.head.appendChild(s);
    })(document, window, 'Chatra');
    window.ChatraSetup = {
        colors: {
            buttonText: '#202124',
            /* chat button text color */
            buttonBg: '#1A73E8' /* chat button background color */
        }
    };
</script>
<!-- /Chatra {/literal} -->