<?php
@include_once 'config/config.php';
include_once 'model/SearchModel.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Corrigido para evitar erro
$user_id = $_SESSION['user_id'] ?? null;

$model = new SearchModel($conn);
$message = [];

$results = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_wishlist'])) {
        include 'controller/WishlistController.php';
    }

    if (isset($_POST['add_to_cart'])) {
        include 'controller/CartController.php';
    }

    if (isset($_POST['search_btn'])) {
        $term = mysqli_real_escape_string($conn, $_POST['search_box']);
        $results = $model->searchProducts($term);
    }
}

include 'view/user/search_page.view.php';
?>
