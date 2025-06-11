<?php

require_once("modelo/Banco.php");
require_once("modelo/Produto.php");

// Lê e decodifica o corpo JSON da requisição
$input = json_decode(file_get_contents("php://input"), true);

// Extrai os dados do JSON
$nome = $input['nome'] ?? null;
$descricao = $input['descricao'] ?? null;
$preco = $input['preco'] ?? null;
$tamanho = $input['tamanho'] ?? null;
$cor = $input['cor'] ?? null;
$estoque = $input['estoque'] ?? 0;
$categoria_id = $input['categorias_id_categoria'] ?? null;

// Verificação de campos obrigatórios
if (!$nome || !$preco || !$categoria_id) {
    echo json_encode(["status" => false, "msg" => "Dados incompletos!"]);
    exit;
}

// Criação do produto
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
