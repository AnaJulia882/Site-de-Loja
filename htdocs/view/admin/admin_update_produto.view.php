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

   <section class="update-product">
      <?php if ($product): ?>
         <form action="" method="post" enctype="multipart/form-data">
            <img src="uploaded_img/<?= $product['image']; ?>" class="image" alt="">
            <input type="hidden" name="update_p_id" value="<?= $product['id']; ?>">
            <input type="hidden" name="update_p_image" value="<?= $product['image']; ?>">
            <input type="text" name="nome" required class="box" value="<?= $product['nome']; ?>" placeholder="Atualizar nome do produto">
            <input type="number" min="0" name="price" required class="box" value="<?= $product['price']; ?>" placeholder="Atualizar preço do produto">
            <textarea name="details" required class="box" placeholder="Atualizar detalhes do produto" cols="30" rows="10"><?= $product['details']; ?></textarea>
            <input type="file" accept="image/*" name="image" class="box">
            <input type="submit" name="update_product" value="Atualizar Produto" class="btn">
            <a href="/admin-produtos" class="option-btn">Voltar</a>
         </form>
      <?php else: ?>
         <p class="empty">Nenhum produto selecionado para atualizar.</p>
      <?php endif; ?>
   </section>

   <script src="js/admin_script.js"></script>