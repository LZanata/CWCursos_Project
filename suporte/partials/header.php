 <!-- Cabeçalho da página com título e navegação -->
 <div class="nav-header">
     <div class="logo"><a href="#">
             <img src="../images/logocwbranco_transparente.png" alt="Logo da CW Cursos" />
         </a></div>

     <nav class="nav-support">
         <ul>
             <li><a href="suporte.php">Início</a></li>
             <li><a href="#">Artigos</a></li>
             <li><a href="ticket.php">Abrir um Ticket</a></li>
         </ul>
     </nav>

     <nav class="nav-botoes">
         <?php if (isset($_SESSION['id']) && $_SESSION['tipo'] === 'aluno'): ?>
             <div class="btn-alunos">
                 <a href="../aluno/areadoaluno.php">
                     Área do Aluno</
                         </a>
             </div>
         <?php else: ?>
             <a href="../cadastro_login/aluno/signin.php" class="planos-btn">Entrar</a>
             <a href="../cadastro_login/aluno/signup.php" class="planos-btn">Cadastrar-se</a>
         <?php endif; ?>
     </nav>
 </div>

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
             buttonBg: '#F1F3F4' /* chat button background color */
         }
     };
 </script>
 <!-- /Chatra {/literal} -->