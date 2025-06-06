<?php

require_once("modelo/Banco.php");
require_once("modelo/Categoria.php");

$id = $_REQUEST['id'] ?? null;
$nome = $_REQUEST['nome'] ?? null;
$descricao = $_REQUEST['descricao'] ?? null;

if (!$id || !$nome) {
    echo json_encode(["status" => false, "msg" => "Dados incompletos!"]);
    exit;
}

$objCategoria = new Categoria();
$sucesso = $objCategoria->update($id, $nome, $descricao);

if ($sucesso) {
    echo json_encode(["status" => true, "msg" => "Categoria atualizada com sucesso!"]);
} else {
    echo json_encode(["status" => false, "msg" => "Erro ao atualizar categoria."]);
}

?>
