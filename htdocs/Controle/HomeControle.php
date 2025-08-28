<?php
// Inclui o arquivo de configuração
@include_once 'config/config.php';
// Inclui o arquivo com a classe do modelo da página inicial
include_once 'model/HomeModelo.php';

// Inicia a sessão, se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Obtém o ID do usuário logado, se existir
$id_usuario = $_SESSION['id_usuario'] ?? null;

// Cria uma instância do modelo
$modelo = new HomeModelo($conn);
$mensagens = [];

// Controle para adicionar à lista de desejos ou ao carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produto     = $_POST['id_produto'];
    $nome_produto   = $_POST['nome_produto'];
    $preco_produto  = $_POST['preco_produto'];
    $imagem_produto = $_POST['imagem_produto'];
    $quantidade     = $_POST['quantidade_produto'] ?? 1;

    // Adicionar à lista de desejos
    if (isset($_POST['adicionar_lista_desejos'])) {
        if (!$id_usuario) {
            $mensagens[] = 'Faça login para adicionar à lista de desejos.';
        } elseif ($modelo->estaNaListaDesejos($id_usuario, $nome_produto)) {
            $mensagens[] = 'Já adicionado à lista de desejos.';
        } elseif ($modelo->estaNoCarrinho($id_usuario, $nome_produto)) {
            $mensagens[] = 'Já adicionado ao carrinho.';
        } else {
            $modelo->adicionarListaDesejos($id_usuario, $id_produto, $nome_produto, $preco_produto, $imagem_produto);
            $mensagens[] = 'Produto adicionado à lista de desejos.';
        }
    }

    // Adicionar ao carrinho
    if (isset($_POST['adicionar_carrinho'])) {
        if (!$id_usuario) {
            $mensagens[] = 'Faça login para adicionar ao carrinho.';
        } elseif ($modelo->estaNoCarrinho($id_usuario, $nome_produto)) {
            $mensagens[] = 'Já adicionado ao carrinho.';
        } else {
            // Se o produto estiver na lista de desejos, remove de lá
            if ($modelo->estaNaListaDesejos($id_usuario, $nome_produto)) {
                $modelo->removerListaDesejos($id_usuario, $nome_produto);
            }
            $modelo->adicionarCarrinho($id_usuario, $id_produto, $nome_produto, $preco_produto, $quantidade, $imagem_produto);
            $mensagens[] = 'Produto adicionado ao carrinho.';
        }
    }
}

// Busca os últimos produtos cadastrados
$produtos = $modelo->obterProdutosRecentes();

// Inclui a view responsável pela página inicial do usuário
include 'view/user/home.view.php';
?>
