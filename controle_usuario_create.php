<?php

require_once("modelo/Banco.php");
require_once("modelo/Usuario.php");

$textoRecebido = file_get_contents("php://input");
$objJson = json_decode($textoRecebido) or die('{"msg": "Formato incorreto!"}');

$objResposta = new stdClass();
$objUsuario = new Usuario();

// Recebe os dados enviados
$objUsuario->setNome($objJson->nomeUsuario);
$objUsuario->setEmail($objJson->emailUsuario);
$objUsuario->setSenha($objJson->senhaUsuario);

// Define o tipo padrão do usuário (ex: 'cliente'). Altere conforme sua regra:
$objUsuario->setTipo("cliente");

// Validações
try {
    if ($objUsuario->getNome() == '') {
        $objResposta->status = false;
        $objResposta->msg = 'Nome está em branco!';
    } else if (strlen($objUsuario->getNome()) < 4) {
        $objResposta->status = false;
        $objResposta->msg = 'O nome não pode ser menor que 4 caracteres!';
    } else if ($objUsuario->getEmail() == '') {
        $objResposta->status = false;
        $objResposta->msg = 'O email não pode estar vazio!';
    } else if ($objUsuario->verificarEmail() == true) {
        $objResposta->cod = 1;
        $objResposta->status = false;
        $objResposta->msg = 'Este email já está cadastrado!';
    } else if ($objUsuario->create() == true) {
        $objResposta->status = true;
        $objResposta->msg = 'Cadastro realizado com sucesso!';
    } else {
        $objResposta->status = false;
        $objResposta->msg = "Erro ao cadastrar!";
    }
} catch (Exception $e) {
    $objResposta->status = false;
    $objResposta->error = $e->getMessage();
    die(json_encode($objResposta));
}

// Resposta HTTP
if ($objResposta->status == true) {
    header('HTTP/1.1 201');
} else {
    header('HTTP/1.1 200');
}

echo json_encode($objResposta);
?>
