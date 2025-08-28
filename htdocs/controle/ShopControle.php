<?php
// controller/shop.php (exemplo de rota/controller da loja)

// Inclui o arquivo de configuração
@include_once 'config/config.php';

// Inclui os arquivos dos modelos
include_once 'modelo/ModeloProduto.php';
include_once 'modelo/ModeloCarrinho.php';
include_once 'modelo/ModeloWishlist.php';

// Inicia a sessão, se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ID do usuário (se logado)
$id_usuario = $_SESSION['id_usuario'] ?? null;

// Instancia os modelos
$modeloProduto   = new ModeloProduto($conn);
$modeloCarrinho  = new ModeloCarrinho($conn);
$modeloWishlist  = new ModeloWishlist($conn);

$mensagens = [];

// Trata POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Adicionar à lista de desejos (nome do botão igual ao da VIEW)
    if (isset($_POST['adicionar_lista_desejos'])) {
        // Ajuste para o que seu método realmente faz/espera:
        // Exemplo mantém sua chamada original, só corrigindo a variável:
        $mensagens[] = $modeloWishlist->getWishlistById($id_usuario, $_POST, $modeloCarrinho);
    }

    // Adicionar ao carrinho
    if (isset($_POST['adicionar_carrinho'])) {
        $mensagens[] = $modeloCarrinho->adicionarItem($id_usuario, $_POST, $modeloWishlist);
    }
}

// Busca todos os produtos (garante variável mesmo se null)
$produtos = $modeloProduto->getAll() ?? null;

// Carrega a view da loja
include 'view/user/shop.view.php';
