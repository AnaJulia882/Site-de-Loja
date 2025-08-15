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
            <h3>R$<?= $pagamentos_pendentes; ?>,00</h3>
            <p>Pagamentos Pendentes</p>
         </div>

         <div class="box">
            <h3>R$<?= $pagamentos_concluidos; ?>,00</h3>
            <p>Pagamentos Concluídos</p>
         </div>

         <div class="box">
            <h3><?= $numero_de_pedidos; ?></h3>
            <p>Pedidos Realizados</p>
         </div>

         <div class="box">
            <h3><?= $numero_de_produtos; ?></h3>
            <p>Produtos Cadastrados</p>
         </div>

         <div class="box">
            <h3><?= $numero_de_usuario; ?></h3>
            <p>Usuários Comuns</p>
         </div>

         <div class="box">
            <h3><?= $numero_admin; ?></h3>
            <p>Administradores</p>
         </div>

         <div class="box">
            <h3><?= $numero_contas; ?></h3>
            <p>Total de Contas</p>
         </div>

         <div class="box">
            <h3><?= $numero_de_mensagens; ?></h3>
            <p>Novas Mensagens</p>
         </div>

      </div>
   </section>

   <script src="js/admin_script.js"></script>