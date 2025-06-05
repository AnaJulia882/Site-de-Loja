<?php

require_once("modelo/Banco.php");
require_once("modelo/Categoria.php");

// Pega o ID direto de $_REQUEST (aceita tanto GET quanto POST)
$id = $_REQUEST['id'] ?? null;

if (!$id) {
    echo json_encode(["status" => false, "msg" => "ID não informado!"]);
    exit;
}

$objCategoria = new Categoria();
$objCategoria->setId($id);

$sucesso = $objCategoria->delete();

if ($sucesso) {
    echo json_encode(["status" => true, "msg" => "Categoria deletada com sucesso!"]);
} else {
    echo json_encode(["status" => false, "msg" => "Erro ao deletar categoria."]);
}
?>
