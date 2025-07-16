<?php
// index.php - Roteador principal
session_start();

$route = $_GET['page'] ?? 'home';

switch ($route) {

    // Páginas públicas
    case 'home':
        include 'controller/HomeController.php';
        break;

    case 'about':
        include 'view/user/about.view.php'; // se não tiver controller
        break;

    case 'shop':
        include 'controller/ShopController.php';
        break;

    case 'search':
        include 'controller/SearchController.php';
        break;

    case 'view':
        include 'controller/ViewProductController.php';
        break;

    case 'contact':
        include 'controller/ContactController.php';
        break;

    case 'cart':
        include 'controller/CartController.php';
        break;

    case 'wishlist':
        include 'controller/WishlistController.php';
        break;

    case 'checkout':
        include 'controller/CheckoutController.php';
        break;

    case 'orders':
        include 'controller/OrderController.php';
        break;

    // Login e Cadastro
    case 'login':
        include 'controller/LoginController.php';
        break;

    case 'register':
        include 'controller/RegisterController.php';
        break;

    case 'logout':
        include 'controller/logout.php'; // você pode criar esse arquivo para session_destroy
        break;

    // Painel Administrativo
    case 'admin-dashboard':
        include 'controller/AdminDashboardController.php';
        break;

    case 'admin-products':
        include 'controller/AdminProductsController.php';
        break;

    case 'admin-update-product':
        include 'controller/AdminUpdateProductController.php';
        break;

    case 'admin-orders':
        include 'controller/AdminOrdersController.php';
        break;

    case 'admin-users':
        include 'controller/AdminUsersController.php';
        break;

    case 'admin-contacts':
        include 'controller/AdminContactsController.php';
        break;

    default:
        include 'controller/HomeController.php';
        break;
}
