<?php

require_once("modelo/Banco.php");
require_once("modelo/Produto.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(["status" => false, "msg" => "ID não informado!"]);
    exit;
}

$objProduto = new Produto();
$produto = $objProduto->readById($id);

if ($produto) {
    echo json_encode($produto);
} else {
    echo json_encode(["status" => false, "msg" => "Produto não encontrado!"]);
}
?>
