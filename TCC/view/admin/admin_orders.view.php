<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Mensagens - Painel Admin</title>
  <link rel="stylesheet" href="/css/admin_style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

<?php @include 'shared/admin_header.php'; ?>

<section class="placed-orders">
   <h1 class="title">Pedidos Realizados</h1>
   <div class="box-container">
      <?php if (mysqli_num_rows($orders) > 0): ?>
         <?php while ($order = mysqli_fetch_assoc($orders)): ?>
            <div class="box">
               <p>ID do Usuário: <span><?= $order['user_id']; ?></span></p>
               <p>Data do Pedido: <span><?= $order['placed_on']; ?></span></p>
               <p>Nome: <span><?= $order['name']; ?></span></p>
               <p>Telefone: <span><?= $order['number']; ?></span></p>
               <p>Email: <span><?= $order['email']; ?></span></p>
               <p>Endereço: <span><?= $order['address']; ?></span></p>
               <p>Total de Produtos: <span><?= $order['total_products']; ?></span></p>
               <p>Preço Total: <span>R$<?= $order['total_price']; ?>,00</span></p>
               <p>Forma de Pagamento: <span><?= $order['method']; ?></span></p>

               <form method="POST">
                  <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                  <select name="update_payment">
                     <option disabled selected><?= $order['payment_status']; ?></option>
                     <option value="pending">Pendente</option>
                     <option value="completed">Concluído</option>
                  </select>
                  <input type="submit" name="update_order" value="Atualizar" class="option-btn">
                  <a href="?delete=<?= $order['id']; ?>" class="delete-btn" onclick="return confirm('Deseja excluir este pedido?');">Excluir</a>
               </form>
            </div>
         <?php endwhile; ?>
      <?php else: ?>
         <p class="empty">Nenhum pedido realizado ainda!</p>
      <?php endif; ?>
   </div>
</section>

<script src="js/admin_script.js"></script>
