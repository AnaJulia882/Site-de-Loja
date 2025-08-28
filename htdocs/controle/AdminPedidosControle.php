<?php
@include_once 'config/config.php';
include_once 'modelo/AdminPedidoModelo.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin-pedidos');
    exit;
}

$modelo = new AdminPedidoModelo($conn);
$mensagem = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_pedido'])) {
    $id_pedido = $_POST['id_pedido'];
    $novo_status = $_POST['update_pagamento'];
    $modelo->updatePagamentoStatus($id_pedido, $novo_status);
    $mensagem[] = 'Status do pagamento atualizado!';
}

if (isset($_GET['delete'])) {
    $modelo->deletePedido($_GET['delete']);
    header('Location: /admin-pedidos');
    exit;
}

$pedidos = $modelo->getAllPedidos();
include 'view/admin/admin_pedidos.view.php';

?>