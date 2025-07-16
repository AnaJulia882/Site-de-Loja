<?php
@include_once 'config/config.php';
include_once 'model/AdminOrderModel.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin-orders');
    exit;
}

$model = new AdminOrderModel($conn);
$message = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['update_payment'];
    $model->updatePaymentStatus($order_id, $new_status);
    $message[] = 'Status do pagamento atualizado!';
}

if (isset($_GET['delete'])) {
    $model->deleteOrder($_GET['delete']);
    header('Location: /admin-orders');
    exit;
}

$orders = $model->getAllOrders();
include 'view/admin/admin_orders.view.php';

?>