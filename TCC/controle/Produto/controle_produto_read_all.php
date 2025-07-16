<?php

require_once("modelo/Banco.php");
require_once("modelo/Produto.php");

$objProduto = new Produto();
$produtos = $objProduto->readAll();

echo json_encode($produtos);
?>
