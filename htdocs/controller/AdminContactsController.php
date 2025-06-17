<?php
@include_once 'config/config.php';
include_once 'model/AdminContactModel.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin-contacts');
    exit;
}

$model = new AdminContactModel($conn);

if (isset($_GET['delete'])) {
    $model->deleteMessage($_GET['delete']);
    header('Location: /admin-contacts');
    exit;
}

$messages = $model->getAllMessages();
include 'view/admin/admin_contacts.view.php';

?>