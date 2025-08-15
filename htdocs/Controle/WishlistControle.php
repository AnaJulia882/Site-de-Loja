<?php
@include_once 'config/config.php';
@include_once 'model/WishlistModel.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

$user_id = $_SESSION['user_id'];
$model = new ModeloWishlist($conn);

if (isset($_GET['delete'])) {
    $model->deleteItem($_GET['delete']);
    header('Location: /wishlist');
    exit;
}

if (isset($_GET['delete_all'])) {
    $model->deleteAllByUser($user_id);
    header('Location: /wishlist');
    exit;
}

$wishlist = $model->getWishlistByUserId($user_id);
include 'view/user/wishlist.view.php';

?>