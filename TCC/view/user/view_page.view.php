<?php @include 'shared/header.php'; ?>

<?php
if (!empty($message)) {
    foreach ($message as $msg) {
        echo '<div class="message">' . $msg . '</div>';
    }
}
?>

<section class="products">
   <h1 class="title">Resultados da Busca</h1>
   <div class="box-container">

   <?php if ($results && $results->num_rows > 0): ?>
      <?php while($product = $results->fetch_assoc()): ?>
         <form action="" method="POST" class="box">
            <a href="view_page.php?pid=<?= $product['id']; ?>" class="fas fa-eye"></a>
            <div class="price">R$<?= $product['price']; ?></div>
            <img src="/images/<?= $product['image']; ?>" alt="" class="image">
            <div class="name"><?= $product['name']; ?></div>
            <input type="number" name="product_quantity" value="1" min="1" class="qty">
            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
            <input type="hidden" name="product_name" value="<?= $product['name']; ?>">
            <input type="hidden" name="product_price" value="<?= $product['price']; ?>">
            <input type="hidden" name="product_image" value="<?= $product['image']; ?>">
            <input type="submit" value="Adicionar à Lista de Desejos" name="add_to_wishlist" class="option-btn">
            <input type="submit" value="Adicionar ao Carrinho" name="add_to_cart" class="btn">
         </form>
      <?php endwhile; ?>
   <?php else: ?>
      <p class="empty">Nenhum produto encontrado.</p>
   <?php endif; ?>

   </div>
</section>

<?php @include 'shared/footer.php'; ?>
<script src="js/script.js"></script>
