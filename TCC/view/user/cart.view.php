<?php @include 'shared/header.php'; ?>

<section class="heading">
    <h3>Seu Carrinho</h3>
    <p> <a href="/home">Início</a> / Carrinho </p>
</section>

<section class="shopping-cart">
    <h1 class="title">Produtos adicionados</h1>
    <div class="box-container">
        <?php
        $grand_total = 0;
        if (mysqli_num_rows($cart_items) > 0):
            while ($item = mysqli_fetch_assoc($cart_items)):
                $sub_total = $item['price'] * $item['quantity'];
                $grand_total += $sub_total;
        ?>
        <form method="POST" class="box">
            <a href="?delete=<?= $item['id']; ?>" onclick="return confirm('Remover este item?');" class="fas fa-times"></a>
            <img src="images/<?= $item['image']; ?>" class="image" alt="">
            <div class="name"><?= $item['name']; ?></div>
            <div class="price">R$<?= $item['price']; ?>,-</div>
            <input type="hidden" name="cart_id" value="<?= $item['id']; ?>">
            <input type="number" min="1" name="quantity" value="<?= $item['quantity']; ?>" class="qty">
            <input type="submit" name="update_quantity" value="Atualizar" class="option-btn">
        </form>
        <?php endwhile; else: ?>
            <p class="empty">Seu carrinho está vazio!</p>
        <?php endif; ?>
    </div>

    <div class="cart-total">
        <p>Total geral: <span>R$<?= $grand_total; ?>,-</span></p>
        <div class="flex">
            <a href="?delete_all=true" onclick="return confirm('Deseja limpar o carrinho?');" class="delete-btn <?= $grand_total > 0 ? '' : 'disabled' ?>">Limpar carrinho</a>
            <a href="/checkout" class="btn <?= $grand_total > 0 ? '' : 'disabled' ?>">Finalizar pedido</a>
        </div>
    </div>
</section>

<?php @include 'shared/footer.php'; ?>
