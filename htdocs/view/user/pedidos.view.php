<!-- view/user/pedidos.view.php -->
<?php @include 'shared/header.php'; ?>

<section class="heading">
    <h3>Seus Pedidos</h3>
    <p> <a href="/home">Início</a> / Pedidos </p>
</section>

<section class="placed-orders">
    <h1 class="title">Pedidos Realizados</h1>

    <div class="box-container">
        <?php if (isset($pedidos) && $pedidos && $pedidos->num_rows > 0): ?>
            <?php while ($pedido = $pedidos->fetch_assoc()): ?>
                <div class="box">
                    <p>Realizado em: <span><?= $pedido['data_pedido']; ?></span></p>
                    <p>Nome: <span><?= $pedido['nome']; ?></span></p>
                    <p>Telefone: <span><?= $pedido['telefone']; ?></span></p>
                    <p>Email: <span><?= $pedido['email']; ?></span></p>
                    <p>Endereço: <span><?= $pedido['endereco']; ?></span></p>
                    <p>Método de pagamento: <span><?= $pedido['metodo_pagamento']; ?></span></p>
                    <p>Produtos do pedido: <span><?= $pedido['produtos_totais']; ?></span></p>
                    <p>Preço total: <span>R$<?= $pedido['preco_total']; ?>/-</span></p>
                    <p>Status do pagamento: 
                        <span style="color:<?= $pedido['status_pagamento'] == 'pendente' ? 'tomato' : 'green'; ?>">
                            <?= $pedido['status_pagamento']; ?>
                        </span>
                    </p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="empty">Nenhum pedido realizado ainda!</p>
        <?php endif; ?>
    </div>
</section>

<?php @include 'shared/footer.php'; ?>
