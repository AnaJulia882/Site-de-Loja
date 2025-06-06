<?php
require_once("modelo/Banco.php");
require_once("modelo/Usuario.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(["status" => false, "msg" => "ID não informado!"]);
    exit;
}

$objUsuario = new Usuario();
$usuario = $objUsuario->readById($id);

if ($usuario) {
    echo json_encode($usuario);
} else {
    echo json_encode(["status" => false, "msg" => "Usuário não encontrado!"]);
}
?>
