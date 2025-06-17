<?php @include 'shared/header.php'; ?>

<section class="heading">
    <h3>sua lista de desejos</h3>
    <p> <a href="/home">início</a> / lista de desejos </p>
</section>

<section class="wishlist">
    <h1 class="title">produtos adicionados</h1>
    <div class="box-container">
        <?php
        if (mysqli_num_rows($wishlist) > 0):
            while ($item = mysqli_fetch_assoc($wishlist)):
        ?>
        <form class="box" method="POST">
            <a href="?delete=<?= $item['id']; ?>" class="fas fa-times" onclick="return confirm('Excluir este item?');"></a>
            <a href="view_page.php?pid=<?= $item['pid']; ?>" class="fas fa-eye"></a>
            <img src="uploaded_img/<?= $item['image']; ?>" alt="" class="image">
            <div class="name"><?= $item['name']; ?></div>
            <div class="price">R$<?= $item['price']; ?>,-</div>
        </form>
        <?php endwhile; else: ?>
        <p class="empty">Nenhum item na lista de desejos</p>
        <?php endif; ?>
    </div>
</section>

<?php @include 'shared/footer.php'; ?>
