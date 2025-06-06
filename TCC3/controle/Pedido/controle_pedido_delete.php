<?php

require_once("modelo/Banco.php");
require_once("modelo/Pedido.php");

// Pega o ID diretamente de $_REQUEST (aceita tanto GET quanto POST)
$id = $_REQUEST['id'] ?? null;

if (!$id) {
    echo json_encode(["status" => false, "msg" => "ID não informado!"]);
    exit;
}

$objPedido = new Pedido();
$objPedido->setId($id);

$sucesso = $objPedido->delete();

if ($sucesso) {
    echo json_encode(["status" => true, "msg" => "Pedido deletado com sucesso!"]);
} else {
    echo json_encode(["status" => false, "msg" => "Erro ao deletar pedido."]);
}

?>
