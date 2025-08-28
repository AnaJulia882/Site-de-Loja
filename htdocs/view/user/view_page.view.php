<?php @include 'shared/header.php'; ?>

<?php
if (!empty($mensagens)) {
    foreach ($mensagens as $msg) {
        echo '<div class="message">' . $msg . '</div>';
    }
}
?>

<section class="products">
   <h1 class="title">Resultados da Busca</h1>
   <div class="box-container">

   <?php if ($resultados && $resultados->num_rows > 0): ?>
      <?php while($produto = $resultados->fetch_assoc()): ?>
         <form action="" method="POST" class="box">
            <a href="view_page.php?pid=<?= $produto['id']; ?>" class="fas fa-eye"></a>
            <div class="preco">R$<?= $produto['preco']; ?></div>
            <img src="/images/<?= $produto['imagem']; ?>" alt="" class="image">
            <div class="nome"><?= $produto['nome']; ?></div>
            <input type="number" name="quantidade_produto" value="1" min="1" class="qty">
            <input type="hidden" name="id_produto" value="<?= $produto['id']; ?>">
            <input type="hidden" name="nome_produto" value="<?= $produto['nome']; ?>">
            <input type="hidden" name="preco_produto" value="<?= $produto['preco']; ?>">
            <input type="hidden" name="imagem_produto" value="<?= $produto['imagem']; ?>">
            <input type="submit" value="Adicionar à Lista de Desejos" name="adicionar_lista_desejos" class="option-btn">
            <input type="submit" value="Adicionar ao Carrinho" name="adicionar_carrinho" class="btn">
         </form>
      <?php endwhile; ?>
   <?php else: ?>
      <p class="empty">Nenhum produto encontrado.</p>
   <?php endif; ?>

   </div>
</section>

<?php @include 'shared/footer.php'; ?>
<script src="js/script.js"></script>
