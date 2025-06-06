<?php

require_once("modelo/Banco.php");
require_once("modelo/Categoria.php");

$textoRecebido = file_get_contents("php://input");
$objJson = json_decode($textoRecebido) or die('{"msg": "Formato incorreto!"}');

$objResposta = new stdClass();
$objCategoria = new Categoria();

// Recebe os dados enviados
$objCategoria->setNome($objJson->nomeCategoria ?? '');
$objCategoria->setDescricao($objJson->descricaoCategoria ?? '');

// Validações
try {
    if ($objCategoria->getNome() == '') {
        $objResposta->status = false;
        $objResposta->msg = 'O nome da categoria está em branco!';
    } else if (strlen($objCategoria->getNome()) < 3) {
        $objResposta->status = false;
        $objResposta->msg = 'O nome da categoria deve ter no mínimo 3 caracteres!';
    } else if ($objCategoria->create()) {
        $objResposta->status = true;
        $objResposta->msg = 'Categoria cadastrada com sucesso!';
    } else {
        $objResposta->status = false;
        $objResposta->msg = 'Erro ao cadastrar categoria!';
    }
} catch (Exception $e) {
    $objResposta->status = false;
    $objResposta->error = $e->getMessage();
    die(json_encode($objResposta));
}

// Resposta HTTP
if ($objResposta->status) {
    header('HTTP/1.1 201');
} else {
    header('HTTP/1.1 200');
}

echo json_encode($objResposta);
?>
