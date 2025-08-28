
<?php @include 'shared/header.php'; ?>

<section class="home">
    <div class="content">
        <h3>Novas Coleções</h3>
    </div>
</section>

<section class="products">
    <h1 class="title">Últimos Produtos</h1>
    <div class="box-container">
        <?php
        // evita aviso caso a view seja acessada sem passar pelo controller
        // e só acessa num_rows se $produtos existir
        if (isset($produtos) && $produtos && $produtos->num_rows > 0):
            while ($produto_atual = $produtos->fetch_assoc()):
        ?>
        <form action="" method="POST" class="box">
            <a href="/visualizar?id_produto=<?= $produto_atual['id']; ?>" class="fas fa-eye"></a>
            <div class="preco">R$<?= $produto_atual['preco']; ?>,00</div>
            <img src="/images/<?= $produto_atual['imagem']; ?>" alt="" class="image">
            <div class="nome"><?= $produto_atual['nome']; ?></div>
            <input type="number" name="quantidade_produto" value="1" min="1" class="qty">
            <input type="hidden" name="id_produto" value="<?= $produto_atual['id']; ?>">
            <input type="hidden" name="nome_produto" value="<?= $produto_atual['nome']; ?>">
            <input type="hidden" name="preco_produto" value="<?= number_format($produto_atual['preco'], 2, ',', '.'); ?>">
            <input type="hidden" name="imagem_produto" value="<?= $produto_atual['imagem']; ?>">
            <input type="submit" name="adicionar_lista_desejos" value="Adicionar à lista de desejos" class="option-btn">
            <input type="submit" name="adicionar_carrinho" value="Adicionar ao carrinho" class="btn">
        </form>
        <?php
            endwhile;
        else:
            echo '<p class="empty">Nenhum produto adicionado ainda!</p>';
        endif;
        ?>
    </div>

    <div class="more-btn">
    <a href="/shop" class="option-btn">Carregar mais</a>
    </div>
</section>

<section class="home-contato">
    <div class="content">
        <h3>Tem alguma dúvida?</h3>
    <a href="/contato" class="btn">Contate-nos</a>
    </div>
</section>

<?php @include 'shared/footer.php'; ?>
