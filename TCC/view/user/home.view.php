<?php @include 'shared/header.php'; ?>

<section class="home">
    <div class="content">
        <h3>novas coleções</h3>
    </div>
</section>

<section class="products">
    <h1 class="title">últimos produtos</h1>
    <div class="box-container">
        <?php
        if ($products->num_rows > 0) {
            while ($fetch_products = $products->fetch_assoc()) {
        ?>
        <form action="" method="POST" class="box">
            <a href="index.php?page=view&pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
            <div class="price">R$<?= $fetch_products['price']; ?>,00</div>
            <img src="/images/<?= $fetch_products['image']; ?>" alt="" class="image">
            <div class="name"><?= $fetch_products['name']; ?></div>
            <input type="number" name="product_quantity" value="1" min="1" class="qty">
            <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="product_name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="product_price" value="<?= number_format($fetch_products['price'], 2, ',', '.'); ?>">
            <input type="hidden" name="product_image" value="<?= $fetch_products['image']; ?>">
            <input type="submit" name="add_to_wishlist" value="adicionar à lista de desejos" class="option-btn">
            <input type="submit" name="add_to_cart" value="adicionar ao carrinho" class="btn">
        </form>
        <?php
            }
        } else {
            echo '<p class="empty">nenhum produto adicionado ainda!</p>';
        }
        ?>
    </div>

    <div class="more-btn">
        <a href="index.php?page=shop" class="option-btn">carregar mais</a>
    </div>
</section>

<section class="home-contact">
    <div class="content">
        <h3>tem alguma dúvida?</h3>
        <a href="index.php?page=contact" class="btn">contate-nos</a>
    </div>
</section>

<?php @include 'shared/footer.php'; ?>
