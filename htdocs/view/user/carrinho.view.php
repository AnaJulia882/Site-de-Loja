<?php @include 'shared/header.php'; ?>

<section class="heading">
    <h3>Seu Carrinho</h3>
    <p> <a href="/home">Início</a> / Carrinho </p>
</section>

<section class="shopping-cart">
    <h1 class="title">Produtos adicionados</h1>
    <div class="box-container">
        <?php
        $total_geral = 0;
        if (!empty($carrinho_items)):
            foreach ($carrinho_items as $item):
                $subtotal = $item['preco'] * $item['quantidade'];
                $total_geral += $subtotal;
        ?>
        <form method="POST" class="box">
            <a href="?delete=<?= $item['id']; ?>" onclick="return confirm('Remover este item?');" class="fas fa-times"></a>
            <img src="images/<?= $item['imagem']; ?>" class="image" alt="">
            <div class="nome"><?= $item['nome']; ?></div>
            <div class="preco">R$<?= $item['preco']; ?>,-</div>
            <input type="hidden" name="carrinho_id" value="<?= $item['id']; ?>">
            <input type="number" min="1" name="quantidade" value="<?= $item['quantidade']; ?>" class="qty">
            <input type="submit" name="update_quantidade" value="Atualizar" class="option-btn">
        </form>
        <?php endforeach; else: ?>
            <p class="empty">Seu carrinho está vazio!</p>
        <?php endif; ?>
    </div>

    <div class="cart-total">
        <p>Total geral: <span>R$<?= $total_geral; ?>,-</span></p>
        <div class="flex">
            <a href="?delete_all=true" onclick="return confirm('Deseja limpar o carrinho?');" class="delete-btn <?= $total_geral > 0 ? '' : 'disabled' ?>">Limpar carrinho</a>
            <a href="/checkout" class="btn <?= $total_geral > 0 ? '' : 'disabled' ?>">Finalizar pedido</a>
        </div>
    </div>
</section>

<?php @include 'shared/footer.php'; ?>
