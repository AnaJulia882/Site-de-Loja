<?php
@include_once 'config/config.php';
@include_once 'modelo/ModeloAutenticacao.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$modelo = new ModeloAutenticacao($conn);
$mensagens = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $usuario = $modelo->getUsuarioByCredenciais($email, $senha);

    if ($usuario) {
        if ($usuario['tipo_usuario'] === 'admin') {
            $_SESSION['admin_id']      = $usuario['id'];
            $_SESSION['nome_usuario']  = $usuario['nome'];
            $_SESSION['email_usuario'] = $usuario['email'];
            // REDIRECIONA DIRETO PARA O ADMIN
            header('Location: /admin-painel');
            exit;
        } else {
            $_SESSION['id_usuario']    = $usuario['id'];
            $_SESSION['nome_usuario']  = $usuario['nome'];
            $_SESSION['email_usuario'] = $usuario['email'];
            // REDIRECIONA DIRETO PARA O USUÁRIO
            header('Location: /home');
            exit;
        }
    } else {
        $mensagens[] = 'Email ou senha incorretos!';
    }
}

include 'view/user/login.view.php';
?>
