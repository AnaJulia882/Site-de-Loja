<?php
@include_once 'config/config.php';
include_once 'model/AdminDashboardModel.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin-dashboard');
    exit;
}

$model = new AdminDashboardModel($conn);

$total_pendings = $model->getSumByStatus('pending');
$total_completes = $model->getSumByStatus('completed');
$number_of_orders = $model->countRows('orders');
$number_of_products = $model->countRows('products');
$number_of_users = $model->countRows('users', "user_type = 'user'");
$number_of_admin = $model->countRows('users', "user_type = 'admin'");
$number_of_account = $model->countRows('users');
$number_of_messages = $model->countRows('message');

include 'view/admin/admin_page.view.php';
?>