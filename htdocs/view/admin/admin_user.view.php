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

<section class="users">
   <h1 class="title">Usuários</h1>
   <div class="box-container">
      <?php if (mysqli_num_rows($users) > 0): ?>
         <?php while ($user = mysqli_fetch_assoc($users)): ?>
            <div class="box">
               <p>ID: <span><?= $user['id']; ?></span></p>
               <p>Nome: <span><?= $user['name']; ?></span></p>
               <p>Email: <span><?= $user['email']; ?></span></p>
               <p>Tipo: <span style="color: <?= $user['user_type'] == 'admin' ? 'var(--orange)' : 'var(--black)'; ?>">
                  <?= $user['user_type']; ?></span></p>
               <a href="?delete=<?= $user['id']; ?>" onclick="return confirm('Excluir este usuário?');" class="delete-btn">Excluir</a>
            </div>
         <?php endwhile; ?>
      <?php else: ?>
         <p class="empty">Nenhum usuário registrado ainda!</p>
      <?php endif; ?>
   </div>
</section>

<script src="js/admin_script.js"></script>
