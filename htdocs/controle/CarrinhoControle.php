<?php
@include_once 'config/config.php';
include_once 'modelo/ModeloCarrinho.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_usuario'])) {
    header('Location: /login');
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
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