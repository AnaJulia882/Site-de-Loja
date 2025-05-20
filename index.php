<?php
require_once("modelo/Router.php");

$roteador = new Router();

    $roteador->post("/usuarios", function(){
        require_once("controle/usuario/controle_usuario_create.php");
    });

    $roteador->run();
?>