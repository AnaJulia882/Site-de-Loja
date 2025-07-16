<?php
require_once("modelo/Banco.php");
require_once("modelo/Categoria.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(["status" => false, "msg" => "ID não informado!"]);
    exit;
}

$objCategoria = new Categoria();
$categoria = $objCategoria->readById($id);

if ($categoria) {
    echo json_encode($categoria);
} else {
    echo json_encode(["status" => false, "msg" => "Categoria não encontrada!"]);
}
?>
