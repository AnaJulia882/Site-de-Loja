<?php
// Inclui o arquivo Router.php
require_once("modelo/Router.php");

// Instancia o roteador
$roteador = new Router();

// READ ALL - Obter todos os usuários
$roteador->get("/usuarios", function () {
    require_once("controle/Usuario/controle_usuario_read_all.php");
});

// READ BY ID - Obter um usuário específico pelo ID
$roteador->get("/usuarios/(\d+)", function ($idUsuario) {
    $_GET['id'] = $idUsuario;
    require_once("controle/Usuario/controle_usuario_read_by_id.php");
});

// CREATE - Criar um novo usuário
$roteador->post("/usuarios", function () {
    require_once("controle/Usuario/controle_usuario_create.php");
});

// UPDATE - Atualizar um usuário existente pelo ID
$roteador->put("/usuarios/(\d+)", function ($idUsuario) {
    $_PUT = json_decode(file_get_contents("php://input"), true);
    $_PUT['id'] = $idUsuario;
    $_REQUEST = $_PUT;
    require_once("controle/Usuario/controle_usuario_update.php");
});

// DELETE - Excluir um usuário existente pelo ID
$roteador->delete("/usuarios/(\d+)", function ($idUsuario) {
    $_DELETE = json_decode(file_get_contents("php://input"), true);
    $_DELETE['id'] = $idUsuario;
    $_REQUEST = $_DELETE;
    require_once("controle/Usuario/controle_usuario_delete.php");
});

$roteador->post ("/logar",function(){
    require_once("controle/Usuario/controle_usuario_login.php");

});

$roteador->put("/usuarios/senha", function(){
    require_once("controle/Usuario/controle_usuario_trocarSenha.php");
});

// Executa o roteador
$roteador->run();
?>
