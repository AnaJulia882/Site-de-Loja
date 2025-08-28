<?php
// index.php - Roteador principal
session_start();

$rota = $_GET['pagina'] ?? 'home';

switch ($rota) {

    // Páginas públicas
    case 'home':
        include 'controle/HomeControle.php';
        break;

    case 'sobre':
        include 'view/user/sobre.view.php'; // se não tiver controle
        break;

    case 'loja':
        include 'controle/ShopControle.php';
        break;

    case 'pesquisa':
        include 'controle/PesquisaControle.php';
        break;

    case 'visualizar':
        include 'controle/ViewProdutoControle.php';
        break;

    case 'contato':
        include 'controle/ContatoControle.php';
        break;

    case 'carrinho':
        include 'controle/CarrinhoControle.php';
        break;

    case 'wishlist':
        include 'controle/WishlistControle.php';
        break;

    case 'checkout':
        include 'controle/CheckoutControle.php';
        break;

    case 'pedidos':
        include 'controle/PedidosControle.php';
        break;

    // Login e Cadastro
    case 'login':
        include 'controle/LoginControle.php';
        break;

    case 'registro':
        include 'controle/RegistroControle.php';
        break;

    case 'logout':
        include 'controle/logout.php'; // arquivo para session_destroy
        break;

    // Painel Administrativo
    case 'admin-painel':
        include 'controle/AdminPainelControle.php';
        break;

    case 'admin-produtos':
        include 'controle/AdminProdutosControle.php';
        break;

    case 'admin-atualizar-produto':
        include 'controle/AdminUpdateProdutoControle.php';
        break;

    case 'admin-pedidos':
        include 'controle/AdminPedidosControle.php';
        break;

    case 'admin-usuarios':
        include 'controle/AdminUsersControle.php';
        break;

    case 'admin-contatos':
        include 'controle/AdminContatoControle.php';
        break;

    default:
        include 'controle/HomeControle.php';
        break;
}
