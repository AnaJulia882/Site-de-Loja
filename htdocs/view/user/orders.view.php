<!-- view/user/orders.view.php -->
<?php @include 'shared/header.php'; ?>

<section class="heading">
    <h3>Seus pedidos</h3>
    <p> <a href="/home">Início</a> / Pedido </p>
</section>

<section class="placed-orders">
    <h1 class="title">Pedidos realizados</h1>

    <div class="box-container">
        <?php if ($orders->num_rows > 0): ?>
            <?php while ($order = $orders->fetch_assoc()): ?>
                <div class="box">
                    <p>Realizado em: <span><?= $order['placed_on']; ?></span></p>
                    <p>Nome: <span><?= $order['name']; ?></span></p>
                    <p>Telefone: <span><?= $order['number']; ?></span></p>
                    <p>Email: <span><?= $order['email']; ?></span></p>
                    <p>Endereço: <span><?= $order['address']; ?></span></p>
                    <p>Método de pagamento: <span><?= $order['method']; ?></span></p>
                    <p>Seus pedidos: <span><?= $order['total_products']; ?></span></p>
                    <p>Preço total: <span>R$<?= $order['total_price']; ?>/-</span></p>
                    <p>Status do pagamento: 
                        <span style="color:<?= $order['payment_status'] == 'pending' ? 'tomato' : 'green'; ?>">
                            <?= $order['payment_status']; ?>
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