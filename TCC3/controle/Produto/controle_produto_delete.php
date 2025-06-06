<?php

require_once("modelo/Banco.php");
require_once("modelo/Produto.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(["status" => false, "msg" => "ID não informado!"]);
    exit;
}

$objProduto = new Produto();
$objProduto->setId($id);

$sucesso = $objProduto->delete();

if ($sucesso) {
    echo json_encode(["status" => true, "msg" => "Produto deletado com sucesso!"]);
} else {
    echo json_encode(["status" => false, "msg" => "Erro ao deletar produto."]);
}
?>
