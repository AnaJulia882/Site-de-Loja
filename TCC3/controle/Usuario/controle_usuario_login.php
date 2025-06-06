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
$objUsuario = new Usuario();

$objUsuario->setEmail($objJson->emailUsuario ?? '');
$objUsuario->setSenha($objJson->senha ?? '');

try {
    if ($objUsuario->verificarUsuarioSenha()) {
        $tokenjwt = new MeuTokenJWT();

        $objClaimsToken = new stdClass();
        $objClaimsToken->emailUsuario = $objUsuario->getEmail();
        $objClaimsToken->tipoUsuario = $objUsuario->getTipo();
        $objClaimsToken->nomeUsuario = $objUsuario->getNome();

        $novoToken = $tokenjwt->gerarToken($objClaimsToken);

        $objResposta->status = true;
        $objResposta->msg = 'Login efetuado com sucesso!';
        $objResposta->token = $novoToken;
        $objResposta->usuario = $objUsuario; // será convertido via jsonSerialize()

        http_response_code(200);
    } else {
        $objResposta->status = false;
        $objResposta->msg = 'Usuário ou senha incorretos!';
        http_response_code(401);
    }
} catch (Exception $e) {
    $objResposta->status = false;
    $objResposta->error = $e->getMessage();
    http_response_code(500);
}

echo json_encode($objResposta);
