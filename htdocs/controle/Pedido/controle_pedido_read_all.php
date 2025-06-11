<?php

require_once("modelo/Banco.php");
require_once("modelo/Pedido.php");

$objPedido = new Pedido();
$pedidos = $objPedido->readAll();

echo json_encode($pedidos);
?>
