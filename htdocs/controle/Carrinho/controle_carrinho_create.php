<?php

require_once("modelo/Banco.php");
require_once("modelo/Pedido.php");

$textoRecebido = file_get_contents("php://input");
$objJson = json_decode($textoRecebido) or die('{"msg": "Formato incorreto!"}');

$objResposta = new stdClass();
$objPedido = new Pedido();

// Recebe os dados enviados
$objPedido->setUsuarioId($objJson->usuarios_id_usuario ?? 0);
$objPedido->setTotal($objJson->total ?? 0.0);
$objPedido->setStatus($objJson->status ?? 'Pendente');

// Validações
try {
    if ($objPedido->getUsuarioId() <= 0) {
        $objResposta->status = false;
        $objResposta->msg = 'ID de usuário inválido!';
    } else if ($objPedido->getTotal() <= 0) {
        $objResposta->status = false;
        $objResposta->msg = 'Total do pedido deve ser maior que zero!';
    } else if ($objPedido->create()) {
        $objResposta->status = true;
        $objResposta->msg = 'Pedido cadastrado com sucesso!';
        $objResposta->id_pedido = $objPedido->getId(); // Retorna o ID gerado
    } else {
        $objResposta->status = false;
        $objResposta->msg = 'Erro ao cadastrar pedido!';
    }
} catch (Exception $e) {
    $objResposta->status = false;
    $objResposta->error = $e->getMessage();
    die(json_encode($objResposta));
}

// Resposta HTTP
if ($objResposta->status) {
    header('HTTP/1.1 201');
} else {
    header('HTTP/1.1 200');
}

echo json_encode($objResposta);
?>
