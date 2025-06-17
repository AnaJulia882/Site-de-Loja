<?php @include 'shared/header.php'; ?>

<?php
if (!empty($message)) {
    foreach ($message as $msg) {
        echo '<div class="message">' . $msg . '</div>';
    }
}
?>

<section class="quick-view">
    <h1 class="title">detalhes do produto</h1>

    <?php if ($product): ?>
        <form action="" method="POST">
            <img src="uploaded_img/<?= $product['image']; ?>" alt="" class="image">
            <div class="name"><?= $product['name']; ?></div>
            <div class="price">R$<?= $product['price']; ?>,-</div>
            <div class="details"><?= $product['details']; ?></div>
            <input type="number" name="product_quantity" value="1" min="1" class="qty">
            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
            <input type="hidden" name="product_name" value="<?= $product['name']; ?>">
            <input type="hidden" name="product_price" value="<?= $product['price']; ?>">
            <input type="hidden" name="product_image" value="<?= $product['image']; ?>">
            <input type="submit" value="adicionar à lista de desejos" name="add_to_wishlist" class="option-btn">
            <input type="submit" value="adicionar ao carrinho" name="add_to_cart" class="btn">
        </form>
    <?php else: ?>
        <p class="empty">Nenhum detalhe disponível para este produto!</p>
    <?php endif; ?>

    <div class="more-btn">
        <a href="/home" class="option-btn">voltar para a página inicial</a>
    </div>
</section>

<?php @include 'shared/footer.php'; ?>
<script src="js/script.js"></script>
