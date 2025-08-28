<?php
@include_once 'config/config.php';
include_once 'model/CheckoutModelo.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: /checkout');
    exit;
}

$user_id = $_SESSION['user_id'];
$modelo = new CheckoutModelo($conn);
$mensagem = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ordem'])) {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $numero = mysqli_real_escape_string($conn, $_POST['numero']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $metodo = mysqli_real_escape_string($conn, $_POST['metodo']);
    $endereco = mysqli_real_escape_string($conn, 'aptº '. $_POST['flat'] .', '. $_POST['rua'] .', '. $_POST['cidade'] .', '. $_POST['pais'] .' - '. $_POST['pin_code']);
    $pedido_em = date('d-M-Y');

    $carrinho = $modelo->getCarrinhoByUsuario($user_id);
    $carrinho_total = 0;
    $produtos = [];

    while ($item = $carrinho->fetch_assoc()) {
        $produtos[] = $item['nome'] . ' (' . $item['quantidade'] . ')';
        $carrinho_total += $item['preco'] * $item['quantidade'];
    }

    $total_produtos = implode(', ', $produtos);

    if ($carrinho_total === 0) {
        $mensagem[] = 'Seu carrinho está vazio!';
    } elseif ($modelo->pedidoExiste($nome, $numero, $email, $metodo, $endereco, $total_produtos, $carrinho_total)) {
        $mensagem[] = 'Pedido já realizado anteriormente!';
    } else {
        $modelo->createPedido($user_id, $nome, $numero, $email, $metodo, $endereco, $total_produtos, $carrinho_total, $pedido_em);
        $modelo->limparCarrinho($user_id);
        $mensagem[] = 'Pedido realizado com sucesso!';
    }
}

$carrinho_items = $modelo->getCarrinhoByUsuario($user_id);
include 'view/user/checkout.view.php';
?>