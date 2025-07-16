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

<section class="messages">
   <h1 class="title">Mensagens de Contato</h1>
   <div class="box-container">
      <?php if (mysqli_num_rows($messages) > 0): ?>
         <?php while ($msg = mysqli_fetch_assoc($messages)): ?>
            <div class="box">
               <p>ID do usuário: <span><?= $msg['user_id']; ?></span></p>
               <p>Nome: <span><?= $msg['name']; ?></span></p>
               <p>Email: <span><?= $msg['email']; ?></span></p>
               <p>Telefone: <span><?= $msg['number']; ?></span></p>
               <p>Mensagem: <span><?= $msg['message']; ?></span></p>
               <a href="?delete=<?= $msg['id']; ?>" class="delete-btn" onclick="return confirm('Excluir esta mensagem?');">Excluir</a>
            </div>
         <?php endwhile; ?>
      <?php else: ?>
         <p class="empty">Nenhuma mensagem recebida ainda!</p>
      <?php endif; ?>
   </div>
</section>

<script src="js/admin_script.js"></script>
