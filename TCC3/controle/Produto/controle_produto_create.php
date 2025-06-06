<?php

require_once("modelo/Banco.php");
require_once("modelo/Produto.php");

$nome = $_POST['nome'] ?? null;
$descricao = $_POST['descricao'] ?? null;
$preco = $_POST['preco'] ?? null;
$tamanho = $_POST['tamanho'] ?? null;
$cor = $_POST['cor'] ?? null;
$estoque = $_POST['estoque'] ?? 0;
$categoria_id = $_POST['categoria_id'] ?? null;

if (!$nome || !$preco || !$categoria_id) {
    echo json_encode(["status" => false, "msg" => "Dados incompletos!"]);
    exit;
}

$objProduto = new Produto();
$objProduto->setNome($nome);
$objProduto->setDescricao($descricao);
$objProduto->setPreco($preco);
$objProduto->setTamanho($tamanho);
$objProduto->setCor($cor);
$objProduto->setEstoque($estoque);
$objProduto->setCategoriaId($categoria_id);

$sucesso = $objProduto->create();

if ($sucesso) {
    echo json_encode(["status" => true, "msg" => "Produto criado com sucesso!"]);
} else {
    echo json_encode(["status" => false, "msg" => "Erro ao criar produto."]);
}
?>
