<?php @include 'shared/header.php'; ?>

<section class="heading">
    <h3>Finalizar pedido</h3>
    <p> <a href="/home">Início</a> / Finalizar pedido </p>
</section>

<section class="display-order">
    <?php
    $grand_total = 0;
    if (mysqli_num_rows($cart_items) > 0):
        while ($item = mysqli_fetch_assoc($cart_items)):
            $sub_total = $item['price'] * $item['quantity'];
            $grand_total += $sub_total;
    ?>
        <p><?= $item['name']; ?> <span>(R$<?= $item['price']; ?> x <?= $item['quantity']; ?>)</span></p>
    <?php endwhile; else: ?>
        <p class="empty">Seu carrinho está vazio</p>
    <?php endif; ?>
    <div class="grand-total">Total geral: <span>R$<?= $grand_total; ?>/-</span></div>
</section>

<section class="checkout">
    <?php if (!empty($message)) foreach ($message as $msg) echo "<div class='message'>{$msg}</div>"; ?>
    <form action="" method="POST">
        <h3>Faça seu pedido</h3>
        <div class="flex">
            <div class="inputBox"><span>Seu nome:</span><input type="text" name="name" required></div>
            <div class="inputBox"><span>Telefone:</span><input type="number" name="number" required></div>
            <div class="inputBox"><span>Email:</span><input type="email" name="email" required></div>
            <div class="inputBox"><span>Pagamento:</span>
                <select name="method" required>
                    <option value="Pagamento na entrega">Pagamento na entrega</option>
                    <option value="Cartão de crédito">Cartão de crédito</option>
                    <option value="Paypal">Paypal</option>
                </select>
            </div>
            <div class="inputBox"><span>Endereço 1:</span><input type="text" name="flat" required></div>
            <div class="inputBox"><span>Endereço 2:</span><input type="text" name="street" required></div>
            <div class="inputBox"><span>Cidade:</span><input type="text" name="city" required></div>
            <div class="inputBox"><span>Estado:</span><input type="text" name="state" required></div>
            <div class="inputBox"><span>País:</span><input type="text" name="country" required></div>
            <div class="inputBox"><span>CEP:</span><input type="number" name="pin_code" required></div>
        </div>
        <input type="submit" name="order" value="Finalizar pedido" class="btn">
    </form>
</section>

<?php @include 'shared/footer.php'; ?>
