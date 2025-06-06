<?php

require_once("modelo/Banco.php");
require_once("modelo/Pedido.php");

$id = $_REQUEST['id'] ?? null;         // ID do pedido
$status = $_REQUEST['status'] ?? null; // Novo status do pedido
$total = $_REQUEST['total'] ?? null;   // Novo total do pedido

// Verifica se todos os dados necessários foram passados
if (!$id || !$status || !$total) {
    echo json_encode(["status" => false, "msg" => "Dados incompletos!"]);
    exit;
}

// Cria o objeto pedido e atualiza
$objPedido = new Pedido();
$sucesso = $objPedido->update($id, $status, $total);

if ($sucesso) {
    echo json_encode(["status" => true, "msg" => "Pedido atualizado com sucesso!"]);
} else {
    echo json_encode(["status" => false, "msg" => "Erro ao atualizar pedido."]);
}

?>
