<?php
use Firebase\JWT\MeuTokenJWT;

require_once("modelo/Banco.php");
require_once("modelo/MeuTokenJWT.php");
require_once("modelo/Usuario.php");

header("Content-Type: application/json");

$textoRecebido = file_get_contents("php://input");
$objJson = json_decode($textoRecebido);

if (!$objJson) {
    http_response_code(400);
    die(json_encode(["msg" => "Formato JSON incorreto!"]));
}

$objResposta = new stdClass();

try {
    $objUsuario = new Usuario();
    $objUsuario->setEmail($objJson->emailUsuario ?? '');
    $objUsuario->setSenha($objJson->senhaUsuario ?? '');

    if ($objUsuario->verificarEmail()) {
        if ($objUsuario->updateSenha()) {
            $objResposta->status = true;
            $objResposta->msg = 'Senha trocada com sucesso!';
            http_response_code(200);
        } else {
            $objResposta->status = false;
            $objResposta->msg = 'Erro ao atualizar a senha!';
            http_response_code(500);
        }
    } else {
        $objResposta->status = false;
        $objResposta->msg = 'E-mail não encontrado!';
        http_response_code(404);
    }
} catch (Exception $e) {
    $objResposta->status = false;
    $objResposta->error = $e->getMessage();
    http_response_code(500);
}

echo json_encode($objResposta);
