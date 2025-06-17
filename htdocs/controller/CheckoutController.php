<?php
@include_once 'config/config.php';
include_once 'model/CheckoutModel.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: /checkout');
    exit;
}

$user_id = $_SESSION['user_id'];
$model = new CheckoutModel($conn);
$message = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, 'aptº '. $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['country'] .' - '. $_POST['pin_code']);
    $placed_on = date('d-M-Y');

    $cart = $model->getCartByUser($user_id);
    $cart_total = 0;
    $products = [];

    while ($item = $cart->fetch_assoc()) {
        $products[] = $item['name'] . ' (' . $item['quantity'] . ')';
        $cart_total += $item['price'] * $item['quantity'];
    }

    $total_products = implode(', ', $products);

    if ($cart_total === 0) {
        $message[] = 'Seu carrinho está vazio!';
    } elseif ($model->orderExists($name, $number, $email, $method, $address, $total_products, $cart_total)) {
        $message[] = 'Pedido já realizado anteriormente!';
    } else {
        $model->insertOrder($user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on);
        $model->clearCart($user_id);
        $message[] = 'Pedido realizado com sucesso!';
    }
}

$cart_items = $model->getCartByUser($user_id);
include 'view/user/checkout.view.php';
?>