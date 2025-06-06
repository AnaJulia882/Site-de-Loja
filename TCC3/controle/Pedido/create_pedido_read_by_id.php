<?php

require_once("modelo/Banco.php");
require_once("modelo/Pedido.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(["status" => false, "msg" => "ID não informado!"]);
    exit;
}

$objPedido = new Pedido();
$pedido = $objPedido->readById($id);

if ($pedido) {
    echo json_encode($pedido);
} else {
    echo json_encode(["status" => false, "msg" => "Pedido não encontrado!"]);
}

?>
