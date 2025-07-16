<?php

require_once("modelo/Banco.php");
require_once("modelo/Usuario.php");

$id = $_REQUEST['id'] ?? null;
$nome = $_REQUEST['nomeUsuario'] ?? null;
$email = $_REQUEST['emailUsuario'] ?? null;
$tipo = $_REQUEST['tipo'] ?? "cliente";

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
