<?php
// Inicia a sessão, se ainda não foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id'] ?? 0; // Garante que a variável exista
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Honey Bee</title>

    <!-- Link CSS -->
    <link rel="stylesheet" href="/css/style.css" />

    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

<?php
// Se tiver mensagens para mostrar (de erro, aviso, etc)
if (isset($message)) {
    foreach ($message as $msg) {
        echo '
        <div class="message">
            <span>' . htmlspecialchars($msg) . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<header class="header">

   <div class="flex">

      <a href="/home" class="logo">Honey Bee</a>

      <nav class="navbar">
         <ul>
            <li><a href="/home">início</a></li>
            <li><a href="#">Contato</a>
               <ul>
                  <li><a href="/contact">contato</a></li>
               </ul>
            </li>
            <li><a href="/shop">loja</a></li>
            <li><a href="/orders">pedidos</a></li>
            <li><a href="#">conta +</a>
               <ul>
                  <li><a href="/login">entrar</a></li>
                  <li><a href="/register">cadastrar</a></li>
               </ul>
            </li>
         </ul>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="/search" class="fas fa-search"></a>

         <?php
            if ($user_id) {
                // Conexão $conn precisa estar definida antes desse include
                $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            } else {
                $wishlist_num_rows = 0;
            }
         ?>
         <a href="/wishlist"><i class="fas fa-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>

         <?php
            if ($user_id) {
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
            } else {
                $cart_num_rows = 0;
            }
         ?>
         <a href="/cart"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
      </div>

      <div class="account-box">
         <p>usuário : <span><?php echo $_SESSION['user_name'] ?? 'Visitante'; ?></span></p>
         <p>email : <span><?php echo $_SESSION['user_email'] ?? '-'; ?></span></p>
         <a href="/logout" class="delete-btn">sair</a>
      </div>

   </div>

</header>
