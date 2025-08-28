<?php
// Inclui o arquivo de configuração
@include_once 'config/config.php';
// Inclui o arquivo do modelo de pesquisa
include_once 'modelo/ModeloPesquisa.php';

// Inicia a sessão, se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Obtém o ID do usuário logado, se existir
$id_usuario = $_SESSION['id_usuario'] ?? null;

// Cria instância do modelo de pesquisa
$modelo = new ModeloPesquisa($conn);
$mensagens = [];

// Variável para armazenar resultados da busca
$resultados = null;

// Verifica se houve envio de formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Adicionar à lista de desejos
    if (isset($_POST['adicionar_lista_desejos'])) {
        include 'controller/ControladorListaDesejos.php';
    }

    // Adicionar ao carrinho
    if (isset($_POST['adicionar_carrinho'])) {
        include 'controller/ControladorCarrinho.php';
    }

    // Pesquisa de produtos
    if (isset($_POST['botao_pesquisa'])) {
        $termo = mysqli_real_escape_string($conn, $_POST['caixa_pesquisa']);
        $resultados = $modelo->getProdutos($termo);
    }
}

// Inclui a view da página de pesquisa
include 'view/user/pesquisa.view.php';
?>
