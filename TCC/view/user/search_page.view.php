<?php @include 'shared/header.php'; ?>

<section class="heading">
    <h3>página de busca</h3>
    <p> <a href="/home">início</a> / busca </p>
</section>

<section class="search-form">
    <form action="" method="POST">
        <input type="text" class="box" placeholder="busque produtos..." name="search_box">
        <input type="submit" class="btn" value="buscar" name="search_btn">
    </form>
</section>

<section class="products" style="padding-top: 0;">
    <div class="box-container">
        <?php if (isset($results)): ?>
            <?php if ($results->num_rows > 0): ?>
                <?php while ($product = $results->fetch_assoc()): ?>
                    <form action="" method="POST" class="box">
                        <a href="view_page.php?pid=<?= $product['id']; ?>" class="fas fa-eye"></a>
                        <div class="price">R$<?= $product['price']; ?></div>
                        <img src="uploaded_img/<?= $product['image']; ?>" alt="" class="image">
                        <div class="name"><?= $product['name']; ?></div>
                        <input type="number" name="product_quantity" value="1" min="1" class="qty">
                        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                        <input type="hidden" name="product_name" value="<?= $product['name']; ?>">
                        <input type="hidden" name="product_price" value="<?= $product['price']; ?>">
                        <input type="hidden" name="product_image" value="<?= $product['image']; ?>">
                        <input type="submit" name="add_to_wishlist" value="adicionar à lista de desejos" class="option-btn">
                        <input type="submit" name="add_to_cart" value="adicionar ao carrinho" class="btn">
                    </form>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="empty">nenhum resultado encontrado!</p>
            <?php endif; ?>
        <?php else: ?>
            <p class="empty">busque algo!</p>
        <?php endif; ?>
    </div>
</section>

<?php @include 'shared/footer.php'; ?>
<script src="js/script.js"></script>
