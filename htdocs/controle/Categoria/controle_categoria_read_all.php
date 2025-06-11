<?php

require_once("modelo/Banco.php");
require_once("modelo/Categoria.php");

$objCategoria = new Categoria();
$categorias = $objCategoria->readAll();

echo json_encode($categorias);
?>
