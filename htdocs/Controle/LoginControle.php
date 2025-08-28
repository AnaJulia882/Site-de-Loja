<?php
// Inclui o arquivo de configuração
@include_once 'config/config.php';
// Inclui o arquivo do modelo de autenticação
include_once 'model/ModeloAutenticacao.php';

// Inicia a sessão, se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cria uma instância do modelo de autenticação
$modelo = new ModeloAutenticacao($conn);
$mensagens = [];

// Processa o login quando o formulário é enviado
// Processa o login quando o formulário é enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $senha    = mysqli_real_escape_string($conn, $_POST['senha']);

    // Busca o usuário pelas credenciais
    $usuario = $modelo->getUsuarioByCredenciais($email, $senha);

    if ($usuario) {
        if ($usuario['tipo_usuario'] === 'admin') {
            $_SESSION['id_admin']   = $usuario['id'];
            $_SESSION['nome_usuario']  = $usuario['nome'];    
            $_SESSION['email_usuario'] = $usuario['email'];
            header('Location: index.php?page=painel-admin');
        } else {
            $_SESSION['id_usuario']    = $usuario['id'];
            $_SESSION['nome_usuario']  = $usuario['nome'];    
            $_SESSION['email_usuario'] = $usuario['email'];
            header('Location: index.php?page=home');
        }
        exit;
    } else {
        $mensagens[] = 'Email ou senha incorretos!';
    }
}

// Inclui a view de login
include 'view/user/login.view.php';
?>
