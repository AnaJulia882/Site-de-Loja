<?php
@include_once 'config/config.php';
include_once 'model/ViewProductModel.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: /view');
    exit;
}

$user_id = $_SESSION['user_id'];
$model = new ViewProductModel($conn);
$message = [];

$product = null;

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $product = $model->getProductById($pid);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_wishlist'])) {
        include 'controller/WishlistController.php';
    }

    if (isset($_POST['add_to_cart'])) {
        include 'controller/CartController.php';
    }
}

include 'view/user/view_page.view.php';

?>