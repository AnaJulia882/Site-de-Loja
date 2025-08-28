<?php
// Inclui o arquivo de configuração
@include_once 'config/config.php';
// Inclui o arquivo com a classe do modelo da página inicial
include_once 'modelo/HomeModelo.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id_usuario = $_SESSION['id_usuario'] ?? null;

$modelo = new HomeModelo($conn);
$mensagens = [];

// (… seus handlers de POST permanecem iguais …)

// Garante que a variável exista
$produtos = $modelo->obterProdutosRecentes();

// Inclui a view
include 'view/user/home.view.php';
