<?php @include 'shared/header.php'; ?>

<section class="heading">
    <h3>Página de Busca</h3>
    <p> <a href="/home">Início</a> / Busca </p>
</section>

<section class="search-form">
    <form action="" method="POST">
        <input type="text" class="box" placeholder="Busque produtos..." name="caixa_busca">
        <input type="submit" class="btn" value="Buscar" name="botao_busca">
    </form>
</section>

<section class="products" style="padding-top: 0;">
    <div class="box-container">
        <?php if (isset($resultados)): ?>
            <?php if ($resultados->num_rows > 0): ?>
                <?php while ($produto = $resultados->fetch_assoc()): ?>
                    <form action="" method="POST" class="box">
                        <a href="view_page.php?pid=<?= $produto['id']; ?>" class="fas fa-eye"></a>
                        <div class="preco">R$<?= $produto['preco']; ?></div>
                        <img src="uploaded_img/<?= $produto['imagem']; ?>" alt="" class="image">
                        <div class="nome"><?= $produto['nome']; ?></div>
                        <input type="number" name="quantidade_produto" value="1" min="1" class="qty">
                        <input type="hidden" name="id_produto" value="<?= $produto['id']; ?>">
                        <input type="hidden" name="nome_produto" value="<?= $produto['nome']; ?>">
                        <input type="hidden" name="preco_produto" value="<?= $produto['preco']; ?>">
                        <input type="hidden" name="imagem_produto" value="<?= $produto['imagem']; ?>">
                        <input type="submit" name="adicionar_lista_desejos" value="Adicionar à lista de desejos" class="option-btn">
                        <input type="submit" name="adicionar_carrinho" value="Adicionar ao carrinho" class="btn">
                    </form>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="empty">Nenhum resultado encontrado!</p>
            <?php endif; ?>
        <?php else: ?>
            <p class="empty">Busque algo!</p>
        <?php endif; ?>
    </div>
</section>

<?php @include 'shared/footer.php'; ?>
<script src="js/script.js"></script>
