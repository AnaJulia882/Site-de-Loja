<?php

require_once("modelo/Banco.php");
require_once("modelo/Usuario.php");

$input = json_decode(file_get_contents("php://input"));

$id = $input->id ?? null;
$nome = $input->nome ?? null;
$email = $input->email ?? null;
$tipo = $input->tipo ?? "cliente";

if (!$id || !$nome || !$email) {
    echo json_encode(["status" => false, "msg" => "Dados incompletos!"]);
    exit;
}

$objUsuario = new Usuario();
$sucesso = $objUsuario->update($id, $nome, $email, $tipo);

if ($sucesso) {
    echo json_encode(["status" => true, "msg" => "Usuário atualizado com sucesso!"]);
} else {
    echo json_encode(["status" => false, "msg" => "Erro ao atualizar usuário."]);
}
?>
