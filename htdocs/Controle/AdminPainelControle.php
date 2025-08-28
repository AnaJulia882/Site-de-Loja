<?php
@include_once 'config/config.php';
include_once 'model/AdminPainelModelo.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin-painel');
    exit;
}

$modelo = new AdminPainelModelo($conn);

$pendentes_total = $modelo->getSomaPorStatus('pendente');
$total_completos = $modelo->getSomaPorStatus('completo');
$numero_de_pedidos = $modelo->countRows('pedidos');
$numero_de_produtos = $modelo->countRows('produtos');
$numero_de_usuarios = $modelo->countRows('usuarios', "tipo_usuario = 'user'");
$numeros_de_admin = $modelo->countRows('usuarios', "tipo_usuario = 'admin'");
$numero_de_contas = $modelo->countRows('usuarios');
$numero_de_mensagens = $modelo->countRows('mensagem');

include 'view/admin/admin_page.view.php';
?>