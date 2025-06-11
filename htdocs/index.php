<?php
// Inclui o arquivo Router.php
require_once("modelo/Router.php");

// Instancia o roteador
$roteador = new Router();

//////////////////////////////////////
// ROTAS DE USUÁRIO
//////////////////////////////////////

$roteador->get("/usuarios", function () {
    require_once("controle/Usuario/controle_usuario_read_all.php");
});

$roteador->get("/usuarios/(\d+)", function ($idUsuario) {
    $_GET['id'] = $idUsuario;
    require_once("controle/Usuario/controle_usuario_read_by_id.php");
});

$roteador->post("/usuarios", function () {
    require_once("controle/Usuario/controle_usuario_create.php");
});

$roteador->put("/usuarios/(\d+)", function ($idUsuario) {
    $_PUT = json_decode(file_get_contents("php://input"), true);
    $_PUT['id'] = $idUsuario;
    $_REQUEST = $_PUT;
    require_once("controle/Usuario/controle_usuario_update.php");
});

$roteador->delete("/usuarios/(\d+)", function ($idUsuario) {
    $_DELETE = json_decode(file_get_contents("php://input"), true);
    $_DELETE['id'] = $idUsuario;
    $_REQUEST = $_DELETE;
    require_once("controle/Usuario/controle_usuario_delete.php");
});

$roteador->post("/logar", function () {
    require_once("controle/Usuario/controle_usuario_login.php");
});

$roteador->put("/usuarios/senha", function () {
    require_once("controle/Usuario/controle_usuario_trocarSenha.php");
});

//////////////////////////////////////
// ROTAS DE CATEGORIA
//////////////////////////////////////

$roteador->post("/categorias", function () {
    require_once("controle/Categoria/controle_categoria_create.php");
});

$roteador->delete("/categorias/(\d+)", function ($idCategoria) {
    $_DELETE = json_decode(file_get_contents("php://input"), true);
    $_DELETE['id'] = $idCategoria;
    $_REQUEST = $_DELETE;
    require_once("controle/Categoria/controle_categoria_delete.php");
});

$roteador->get("/categorias", function () {
    require_once("controle/Categoria/controle_categoria_read_all.php");
});

$roteador->get("/categorias/(\d+)", function ($idCategoria) {
    $_GET['id'] = $idCategoria;
    require_once("controle/Categoria/controle_categoria_read_by_id.php");
});

$roteador->put("/categorias/(\d+)", function ($idCategoria) {
    $_PUT = json_decode(file_get_contents("php://input"), true);
    $_PUT['id'] = $idCategoria;
    $_REQUEST = $_PUT;
    require_once("controle/Categoria/controle_categoria_update.php");
});

//////////////////////////////////////
// ROTAS DE PRODUTO
//////////////////////////////////////

$roteador->post("/produtos", function () {
    require_once("controle/Produto/controle_produto_create.php");
});

$roteador->get("/produtos", function () {
    require_once("controle/Produto/controle_produto_read_all.php");
});

$roteador->get("/produtos/(\d+)", function ($idProduto) {
    $_GET['id'] = $idProduto;
    require_once("controle/Produto/controle_produto_read_by_id.php");
});

$roteador->put("/produtos/(\d+)", function ($idProduto) {
    $_PUT = json_decode(file_get_contents("php://input"), true);
    $_PUT['id'] = $idProduto;
    $_REQUEST = $_PUT;
    require_once("controle/Produto/controle_produto_update.php");
});

$roteador->delete("/produtos/(\d+)", function ($idProduto) {
    $_DELETE = json_decode(file_get_contents("php://input"), true);
    $_DELETE['id'] = $idProduto;
    $_REQUEST = $_DELETE;
    require_once("controle/Produto/controle_produto_delete.php");
});

//////////////////////////////////////
// ROTAS DE PEDIDO
//////////////////////////////////////

$roteador->post("/pedidos", function () {
    require_once("controle/Pedido/controle_pedido_create.php");
});

$roteador->get("/pedidos", function () {
    require_once("controle/Pedido/controle_pedido_read_all.php");
});

$roteador->get("/pedidos/(\d+)", function ($idPedido) {
    $_GET['id'] = $idPedido;
    require_once("controle/Pedido/controle_pedido_read_by_id.php");
});

$roteador->put("/pedidos/(\d+)", function ($idPedido) {
    $_PUT = json_decode(file_get_contents("php://input"), true);
    $_PUT['id'] = $idPedido;
    $_REQUEST = $_PUT;
    require_once("controle/Pedido/controle_pedido_update.php");
});

$roteador->delete("/pedidos/(\d+)", function ($idPedido) {
    $_DELETE = json_decode(file_get_contents("php://input"), true);
    $_DELETE['id'] = $idPedido;
    $_REQUEST = $_DELETE;
    require_once("controle/Pedido/controle_pedido_delete.php");
});

// Executa o roteador
$roteador->run();
?>
