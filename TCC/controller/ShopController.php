<?php
@include_once 'config/config.php';
include_once 'model/ProductModel.php';
include_once 'model/CartModel.php';
include_once 'model/WishlistModel.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$productModel = new ProductModel($conn);
$cartModel = new CartModel($conn);
$wishlistModel = new WishlistModel($conn);
$message = [];

// Adicionar à lista de desejos
if (isset($_POST['add_to_wishlist'])) {
    $message[] = $wishlistModel->handleAdd($user_id, $_POST, $cartModel);
}

// Adicionar ao carrinho
if (isset($_POST['add_to_cart'])) {
    $message[] = $cartModel->handleAdd($user_id, $_POST, $wishlistModel);
}

// Busca produtos
$products = $productModel->getAll();

// Carrega a view
include 'view/user/shop.view.php';
?>
