<?php
@include_once 'config/config.php';
include_once 'model/AdminUserModel.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin-users');
    exit;
}

$model = new AdminUserModel($conn);

if (isset($_GET['delete'])) {
    $model->deleteUser($_GET['delete']);
    header('Location: /admin-users');
    exit;
}

$users = $model->getAllUsers();
include 'view/admin/admin_user.view.php';

?>