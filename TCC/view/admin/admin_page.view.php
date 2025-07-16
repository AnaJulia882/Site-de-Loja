<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Mensagens - Painel Admin</title>
  <link rel="stylesheet" href="/css/admin_style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

<?php @include 'shared/admin_header.php'; ?>

<section class="dashboard">
   <h1 class="title">Painel de Controle</h1>
   <div class="box-container">

      <div class="box">
         <h3>R$<?= $total_pendings; ?>,00</h3>
         <p>Pagamentos Pendentes</p>
      </div>

      <div class="box">
         <h3>R$<?= $total_completes; ?>,00</h3>
         <p>Pagamentos Concluídos</p>
      </div>

      <div class="box">
         <h3><?= $number_of_orders; ?></h3>
         <p>Pedidos Realizados</p>
      </div>

      <div class="box">
         <h3><?= $number_of_products; ?></h3>
         <p>Produtos Cadastrados</p>
      </div>

      <div class="box">
         <h3><?= $number_of_users; ?></h3>
         <p>Usuários Comuns</p>
      </div>

      <div class="box">
         <h3><?= $number_of_admin; ?></h3>
         <p>Administradores</p>
      </div>

      <div class="box">
         <h3><?= $number_of_account; ?></h3>
         <p>Total de Contas</p>
      </div>

      <div class="box">
         <h3><?= $number_of_messages; ?></h3>
         <p>Novas Mensagens</p>
      </div>

   </div>
</section>

<script src="js/admin_script.js"></script>
