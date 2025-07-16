<?php
@include_once 'config/config.php';
include_once 'model/HomeModel.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id'] ?? null;
$model = new HomeModel($conn);
$message = [];

// Controle de adicionar à lista de desejos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pid = $_POST['product_id'];
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $image = $_POST['product_image'];
    $quantity = $_POST['product_quantity'] ?? 1;

    if (isset($_POST['add_to_wishlist'])) {
        if (!$user_id) {
            $message[] = 'Faça login para adicionar à lista de desejos.';
        } elseif ($model->isInWishlist($user_id, $name)) {
            $message[] = 'Já adicionado à lista de desejos.';
        } elseif ($model->isInCart($user_id, $name)) {
            $message[] = 'Já adicionado ao carrinho.';
        } else {
            $model->addToWishlist($user_id, $pid, $name, $price, $image);
            $message[] = 'Produto adicionado à lista de desejos.';
        }
    }

    if (isset($_POST['add_to_cart'])) {
        if (!$user_id) {
            $message[] = 'Faça login para adicionar ao carrinho.';
        } elseif ($model->isInCart($user_id, $name)) {
            $message[] = 'Já adicionado ao carrinho.';
        } else {
            if ($model->isInWishlist($user_id, $name)) {
                $model->removeFromWishlist($user_id, $name);
            }
            $model->addToCart($user_id, $pid, $name, $price, $quantity, $image);
            $message[] = 'Produto adicionado ao carrinho.';
        }
    }
}

$products = $model->getLatestProducts();

include 'view/user/home.view.php';
?>
