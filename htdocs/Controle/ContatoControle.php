<?php
// Inclui o arquivo de configuração
@include_once 'config/config.php';
// Inclui o arquivo com a classe do modelo de contatos
include_once 'model/ContatoModelo.php';

// Inicia a sessão, se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se o usuário não estiver logado, redireciona para a página de login
if (!isset($_SESSION['id_usuario'])) {
    header('Location: /login');
    exit;
}

$id_usuario = $_SESSION['id_usuario']; // ID do usuário logado
$modelo = new ContatoModelo($conn); // Instancia o modelo de contato
$mensagens = []; // Array para armazenar mensagens de retorno

// Se o formulário foi enviado via POST e o botão "enviar" existe
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
    // Protege contra SQL Injection
    $nome    = mysqli_real_escape_string($conn, $_POST['nome']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $numero  = mysqli_real_escape_string($conn, $_POST['numero']);
    $mensagem_form = mysqli_real_escape_string($conn, $_POST['mensagem']);

    // Verifica se a mensagem já foi enviada antes
    if ($modelo->mensagemExiste($nome, $email, $numero, $mensagem_form)) {
        $mensagens[] = 'Mensagem já enviada anteriormente!';
    } else {
        // Salva a nova mensagem no banco
        $modelo->salvarMensagem($id_usuario, $nome, $email, $numero, $mensagem_form);
        $mensagens[] = 'Mensagem enviada com sucesso!';
    }
}

// Inclui a view responsável por exibir o formulário de contato
include 'view/user/contato.view.php';
?>
