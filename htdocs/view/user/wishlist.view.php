<?php @include 'shared/header.php'; ?>

<section class="heading">
    <h3>Sua Wishlist</h3>
    <p> <a href="/home">Início</a> / Wishlist </p>
</section>

<section class="wishlist">
    <h1 class="title">Produtos Adicionados</h1>
    <div class="box-container">
        <?php if (!empty($wishlist)): ?>
            <?php foreach ($wishlist as $item): ?>
                <form class="box" method="POST">
                    <a href="?delete=<?= $item['id']; ?>" class="fas fa-times" onclick="return confirm('Excluir este item?');"></a>
                    <a href="view_page.php?pid=<?= $item['pid']; ?>" class="fas fa-eye"></a>
                    <img src="images/<?= $item['imagem']; ?>" alt="" class="image">
                    <div class="nome"><?= $item['nome']; ?></div>
                    <div class="preco">R$<?= $item['preco']; ?>,-</div>
                </form>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="empty">Nenhum item na wishlist</p>
        <?php endif; ?>
    </div>
</section>
<?php @include 'shared/footer.php'; ?>
