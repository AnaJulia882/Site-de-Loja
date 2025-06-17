<?php
@include_once 'config/config.php';
include_once 'model/CartModel.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: /cart');
    exit;
}

$user_id = $_SESSION['user_id'];
$model = new CartModel($conn);
$message = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_quantity'])) {
        $cart_id = $_POST['cart_id'];
        $quantity = $_POST['quantity'];
        $model->updateQuantity($cart_id, $quantity);
        $message[] = 'Quantidade atualizada com sucesso!';
    }
}

if (isset($_GET['delete'])) {
    $model->removeItem($_GET['delete']);
    header('Location: /cart');
    exit;
}

if (isset($_GET['delete_all'])) {
    $model->clearCart($user_id);
    header('Location: /cart');
    exit;
}

$cart_items = $model->getCartItems($user_id);
include 'view/user/cart.view.php';

?>