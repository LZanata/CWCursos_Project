<?php
// Inclui o "autoload" do Composer, que carrega todas as bibliotecas instaladas
require_once __DIR__ . '/../lib/vendor/autoload.php';

// Carrega as variáveis de ambiente do arquivo .env que está na mesma pasta
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Estabelece a conexão com o banco de dados usando as variáveis de ambiente definidas no arquivo .env
$servidor = $_ENV['DB_HOST']; // Define o hostname do servidor de banco de dados
$usuario = $_ENV['DB_USERNAME']; // Define o nome de usuário do banco de dados
$senha = $_ENV['DB_PASSWORD']; // Define a senha do banco de dados
$dbname = $_ENV['DB_DATABASE']; // Define o nome do banco de dados

// Cria uma nova conexão com o banco de dados usando as credenciais fornecidas
$conexao = new mysqli($servidor, $usuario, $senha, $dbname);

// Verifica se houve erro ao conectar ao banco de dados e retorna a mensagem de erro para tratamento posterior
if($conexao->connect_errno) {
    die("Erro ao conectar ao banco de dados: " . $conexao->connect_error); // Termina o script se houver um erro
}

return $conexao; // <-- ESSA LINHA é essencial!

// A conexão é estabelecida sem mensagens na tela; qualquer tratamento de sucesso ou falha deve ser feito no script que utiliza esta conexão
?>
