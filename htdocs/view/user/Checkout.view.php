<?php @include 'shared/header.php'; ?>
<section class="heading">
    <h3>Finalizar Pedido</h3>
    <p> <a href="/home">Início</a> / Finalizar Pedido </p>
</section>

<section class="display-order">
    <?php
    $total_geral = 0;
    if (mysqli_num_rows($itens_carrinho) > 0):
        while ($item = mysqli_fetch_assoc($itens_carrinho)):
            $subtotal = $item['preco'] * $item['quantidade'];
            $total_geral += $subtotal;
    ?>
        <p><?= $item['nome']; ?> <span>(R$<?= $item['preco']; ?> x <?= $item['quantidade']; ?>)</span></p>
    <?php endwhile; else: ?>
        <p class="empty">Seu carrinho está vazio</p>
    <?php endif; ?>
    <div class="grand-total">Total geral: <span>R$<?= $total_geral; ?>/-</span></div>
</section>

<section class="checkout">
    <?php if (!empty($mensagens)) foreach ($mensagens as $msg) echo "<div class='message'>{$msg}</div>"; ?>
    <form action="" method="POST">
        <h3>Faça seu pedido</h3>
        <div class="flex">
            <div class="inputBox"><span>Seu nome:</span><input type="text" name="nome" required></div>
            <div class="inputBox"><span>Telefone:</span><input type="number" name="telefone" required></div>
            <div class="inputBox"><span>Email:</span><input type="email" name="email" required></div>
            <div class="inputBox"><span>Método de pagamento:</span>
                <select name="metodo_pagamento" required>
                    <option value="Pagamento na entrega">Pagamento na entrega</option>
                    <option value="Cartão de crédito">Cartão de crédito</option>
                    <option value="Paypal">Paypal</option>
                </select>
            </div>
            <div class="inputBox"><span>Endereço 1:</span><input type="text" name="endereco1" required></div>
            <div class="inputBox"><span>Endereço 2:</span><input type="text" name="endereco2" required></div>
            <div class="inputBox"><span>Cidade:</span><input type="text" name="cidade" required></div>
            <div class="inputBox"><span>Estado:</span><input type="text" name="estado" required></div>
            <div class="inputBox"><span>País:</span><input type="text" name="pais" required></div>
            <div class="inputBox"><span>CEP:</span><input type="number" name="cep" required></div>
        </div>
        <input type="submit" name="finalizar_pedido" value="Finalizar Pedido" class="btn">
    </form>
</section>

<?php @include 'shared/footer.php'; ?>
