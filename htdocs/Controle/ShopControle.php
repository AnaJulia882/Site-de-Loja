<?php
// Inclui o arquivo de configuração
@include_once 'config/config.php';
// Inclui os arquivos dos modelos
include_once 'model/ModeloProduto.php';
include_once 'model/ModeloCarrinho.php';
include_once 'model/ModeloWishlist.php';

// Inicia a sessão, se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Instancia os modelos
$modeloProduto     = new ModeloProduto($conn);
$modeloCarrinho    = new ModeloCarrinho($conn);
$modeloListaDesejos = new ModeloWishlist($conn);
$mensagens = [];

// Adicionar à lista de desejos
if (isset($_POST['adicionar_wishlist'])) {
    $mensagens[] = $modeloWishlist->getWishlistById($id_usuario, $_POST, $modeloCarrinho);
}

// Adicionar ao carrinho
if (isset($_POST['adicionar_carrinho'])) {
    $mensagens[] = $modeloCarrinho->adicionarItem($id_usuario, $_POST, $modeloListaDesejos);
}

// Busca todos os produtos
$produtos = $modeloProduto->getAll();

// Carrega a view da loja
include 'view/user/shop.view.php';
?>
