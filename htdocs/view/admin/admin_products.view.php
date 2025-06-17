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

<section class="add-products">
   <form action="" method="POST" enctype="multipart/form-data">
      <h3>Adicionar Novo Produto</h3>
      <input type="text" class="box" required placeholder="Nome do produto" name="name">
      <input type="text" min="0" class="box" required placeholder="Preço" name="price">
      <textarea name="details" class="box" required placeholder="Detalhes" cols="30" rows="10"></textarea>
      <input type="file" accept="image/*" required class="box" name="image">
      <input type="submit" value="Adicionar Produto" name="add_product" class="btn">
   </form>
</section>

<section class="show-products">
   <div class="box-container">
      <?php if (mysqli_num_rows($products) > 0): ?>
         <?php while ($product = mysqli_fetch_assoc($products)): ?>
            <div class="box">
               <div class="price">R$<?= $product['price']; ?>,00</div>
               <img class="image" src="uploaded_img/<?= $product['image']; ?>" alt="">
               <div class="name"><?= $product['name']; ?></div>
               <div class="details"><?= $product['details']; ?></div>
               <a href="admin_update_product.php?update=<?= $product['id']; ?>" class="option-btn">Atualizar</a>
               <a href="?delete=<?= $product['id']; ?>" class="delete-btn" onclick="return confirm('Excluir produto?');">Excluir</a>
            </div>
         <?php endwhile; ?>
      <?php else: ?>
         <p class="empty">Nenhum produto adicionado ainda!</p>
      <?php endif; ?>
   </div>
</section>

<script src="js/admin_script.js"></script>
