<?php

require_once("modelo/Banco.php");
require_once("modelo/Usuario.php");

$objUsuario = new Usuario();
$usuarios = $objUsuario->readAll();

echo json_encode($usuarios);
?>
