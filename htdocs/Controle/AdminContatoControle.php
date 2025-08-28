<?php
@include_once 'config/config.php';
include_once 'modelo/AdminContatoModelo.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin-contatos');
    exit;
}

$modelo = new AdminContatoModelo($conn);

if (isset($_GET['delete'])) {
    $modelo->deleteMensagem($_GET['delete']);
    header('Location: /admin-contatos');
    exit;
}

$mensagens = $modelo->getAllMensagens();
include 'view/admin/admin_contatos.view.php';

?>