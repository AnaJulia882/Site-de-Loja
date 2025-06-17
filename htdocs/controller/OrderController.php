<?php
@include_once 'config/config.php';
include_once 'model/OrderModel.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: /orders');
    exit;
}

$orderModel = new OrderModel($conn);
$orders = $orderModel->getOrdersByUserId($_SESSION['user_id']);

// Envia os dados para a view
include 'view/user/orders.view.php';
?>