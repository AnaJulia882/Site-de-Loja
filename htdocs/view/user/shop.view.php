<?php @include 'shared/header.php'; ?>

<?php if (!empty($message)): ?>
   <?php foreach ($message as $msg): ?>
      <div class="message"><?= $msg ?></div>
   <?php endforeach; ?>
<?php endif; ?>

<section class="heading">
    <h3>nossa loja</h3>
    <p> <a href="index.php">home</a> / loja </p>
</section>

<section class="products">
   <h1 class="title">últimos produtos</h1>
   <div class="box-container">
      <?php if ($products && $products->num_rows > 0): ?>
         <?php while($fetch_products = $products->fetch_assoc()): ?>
            <form action="" method="POST" class="box">
               <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
               <div class="price">R$<?= $fetch_products['price']; ?>,-</div>
               <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="" class="image">
               <div class="name"><?= $fetch_products['name']; ?></div>
               <input type="number" name="product_quantity" value="1" min="1" class="qty">
               <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
               <input type="hidden" name="product_name" value="<?= $fetch_products['name']; ?>">
               <input type="hidden" name="product_price" value="<?= $fetch_products['price']; ?>">
               <input type="hidden" name="product_image" value="<?= $fetch_products['image']; ?>">
               <input type="submit" name="add_to_wishlist" value="Adicionar à lista de desejos" class="option-btn">
               <input type="submit" name="add_to_cart" value="Adicionar ao carrinho" class="btn">
            </form>
         <?php endwhile; ?>
      <?php else: ?>
         <p class="empty">Nenhum produto cadastrado ainda!</p>
      <?php endif; ?>
   </div>
</section>

<?php @include 'shared/footer.php'; ?>
