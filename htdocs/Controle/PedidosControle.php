<?php
// Inclui o arquivo de configuração
@include_once 'config/config.php';
// Inclui o arquivo do modelo de pedidos
include_once 'model/ModeloPedido.php';

// Inicia a sessão, se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: /login');
    exit;
}

// Cria instância do modelo de pedidos
$modeloPedido = new ModeloPedido($conn);

// Busca os pedidos do usuário logado
$pedidos = $modeloPedido->getPedidosByIdUsuario($_SESSION['id_usuario']);

// Envia os dados para a view
include 'view/user/pedidos.view.php';
?>
