<?php @include 'shared/header.php'; ?>

<?php if (!empty($mensagens)): ?>
   <?php foreach ($mensagens as $msg): ?>
      <div class="message"><?= $msg ?></div>
   <?php endforeach; ?>
<?php endif; ?>

<section class="heading">
    <h3>Nossa Loja</h3>
    <p> <a href="index.php">Início</a> / Loja </p>
</section>

<section class="products">
   <h1 class="title">Últimos Produtos</h1>
   <div class="box-container">
      <?php if ($produtos && $produtos->num_rows > 0): ?>
         <?php while($produto_atual = $produtos->fetch_assoc()): ?>
            <form action="" method="POST" class="box">
               <a href="view_page.php?pid=<?= $produto_atual['id']; ?>" class="fas fa-eye"></a>
               <div class="preco">R$<?= $produto_atual['preco']; ?>,-</div>
               <img src="images/<?= $produto_atual['imagem']; ?>" alt="" class="image">
               <div class="nome"><?= $produto_atual['nome']; ?></div>
               <input type="number" name="quantidade_produto" value="1" min="1" class="qty">
               <input type="hidden" name="id_produto" value="<?= $produto_atual['id']; ?>">
               <input type="hidden" name="nome_produto" value="<?= $produto_atual['nome']; ?>">
               <input type="hidden" name="preco_produto" value="<?= $produto_atual['preco']; ?>">
               <input type="hidden" name="imagem_produto" value="<?= $produto_atual['imagem']; ?>">
               <input type="submit" name="adicionar_lista_desejos" value="Adicionar à lista de desejos" class="option-btn">
               <input type="submit" name="adicionar_carrinho" value="Adicionar ao carrinho" class="btn">
            </form>
         <?php endwhile; ?>
      <?php else: ?>
         <p class="empty">Nenhum produto cadastrado ainda!</p>
      <?php endif; ?>
   </div>
</section>

<?php @include 'shared/footer.php'; ?>
