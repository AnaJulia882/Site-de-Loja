<?php
@include_once 'config/config.php';
include_once 'model/ModeloCarrinho.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

$user_id = $_SESSION['user_id'];
$modelo = new ModeloCarrinho($conn);
$mensagem = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_quantidade'])) {
        $carrinho_id = $_POST['carrinho_id'];
        $quantidade = $_POST['quantidade'];
        $modelo->updateQuantidade($carrinho_id, $quantidade);
        $mensagem[] = 'Quantidade atualizada com sucesso!';
    }
}

if (isset($_GET['delete'])) {
    $modelo->deleteItem($_GET['delete']);
    header('Location: /carrinho');
    exit;
}

if (isset($_GET['delete_all'])) {
    $modelo->deleteCarrinho($id_usuario);
    header('Location: /carrinho');
    exit;
}

$carrinho_items = $modelo->getCarrinhoItems($id_usuario);
include 'view/usuario/carrinho.view.php';

?>