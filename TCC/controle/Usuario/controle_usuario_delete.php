<?php

require_once("modelo/Banco.php");
require_once("modelo/Usuario.php");

$input = json_decode(file_get_contents("php://input"));
$id = $input->id ?? null;

if (!$id) {
    echo json_encode(["status" => false, "msg" => "ID não informado!"]);
    exit;
}

$objUsuario = new Usuario();
$sucesso = $objUsuario->delete($id);

if ($sucesso) {
    echo json_encode(["status" => true, "msg" => "Usuário deletado com sucesso!"]);
} else {
    echo json_encode(["status" => false, "msg" => "Erro ao deletar usuário."]);
}
?>
