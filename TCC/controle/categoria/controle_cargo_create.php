<?php
// Inclui as classes Banco e Cargo, que provavelmente contêm funcionalidades relacionadas ao banco de dados e aos cargos
require_once ("modelo/Banco.php");
require_once ("modelo/Cargo.php");

// Obtém os dados enviados por meio de uma requisição POST em formato JSON
$textoRecebido = file_get_contents("php://input");
// Decodifica os dados JSON recebidos em um objeto PHP ou interrompe o script se o formato estiver incorreto
$objJson = json_decode($textoRecebido) or die('{"msg":"formato incorreto"}');

// Cria um novo objeto para armazenar a resposta
$objResposta = new stdClass();
// Cria um novo objeto da classe Cargo
$objCargo = new Cargo();

// Define o nome do cargo recebido do JSON no objeto Cargo
$objCargo->setNomeCargo($objJson->cargo->nomeCargo);

// Verifica se o nome do cargo está vazio
if ($objCargo->getNomeCargo() == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "o nome nao pode ser vazio";
} 
// Verifica se o nome do cargo tem menos de 3 caracteres
else if (strlen($objCargo->getNomeCargo()) < 3) {
    $objResposta->cod = 2;
    $objResposta->status = false;
    $objResposta->msg = "o nome nao pode ser menor do que 3 caracteres";
} 
// Verifica se já existe um cargo cadastrado com o mesmo nome
else if ($objCargo->isCargo() == true) {
    $objResposta->cod = 3;
    $objResposta->status = false;
    $objResposta->msg = "Ja existe um cargo cadastrado com o nome: " . $objCargo->getNomeCargo();
} 
// Se todas as condições anteriores forem atendidas, tenta criar um novo cargo
else {
    // Verifica se a criação do novo cargo foi bem-sucedida
    if ($objCargo->create() == true) {
        $objResposta->cod = 4;
        $objResposta->status = true;
        $objResposta->msg = "cadastrado com sucesso";
        $objResposta->novoCargo = $objCargo;
    } 
    // Se houver erro na criação do cargo, define a mensagem de erro
    else {
        $objResposta->cod = 5;
        $objResposta->status = false;
        $objResposta->msg = "Erro ao cadastrar novo Cargo";
    }
}

// Define o tipo de conteúdo da resposta como JSON
header("Content-Type: application/json");

// Define o código de status da resposta com base no status da operação
if ($objResposta->status == true) {
    header("HTTP/1.1 201");
} else {
    header("HTTP/1.1 200");
}

// Converte o objeto resposta em JSON e o imprime na saída
echo json_encode($objResposta);

?>
