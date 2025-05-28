<?php

require_once("modelo/Banco.php");
require_once("modelo/Usuario.php");

// Pega o ID direto de $_REQUEST
$id = $_REQUEST['id'] ?? null;

if (!$id) {
    echo json_encode(["status" => false, "msg" => "ID não informado!"]);
    exit;
}

$objUsuario = new Usuario();
$objUsuario->setId($id);

$sucesso = $objUsuario->delete();

if ($sucesso) {
    echo json_encode(["status" => true, "msg" => "Usuário deletado com sucesso!"]);
} else {
    echo json_encode(["status" => false, "msg" => "Erro ao deletar usuário."]);
}
?>
