<?php
// Inicia a sessão, se ainda não foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

@include_once 'config/config.php';

// Define variáveis com fallback seguro
$user_id = $_SESSION['user_id'] ?? 0;
$user_name = $_SESSION['user_name'] ?? 'Visitante';
$user_email = $_SESSION['user_email'] ?? '-';
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

            <?php if ($user_id): ?>
               <li><a href="#">minha conta</a>
                  <ul>
                     <li><a href="/orders">meus pedidos</a></li>
                     <li><a href="/logout">sair</a></li>
                  </ul>
               </li>
            <?php else: ?>
               <li><a href="#">conta +</a>
                  <ul>
                     <li><a href="/login">entrar</a></li>
                     <li><a href="/register">cadastrar</a></li>
                  </ul>
               </li>
            <?php endif; ?>
         </ul>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="/search" class="fas fa-search"></a>
         <?php if ($user_id): ?>
            <div id="user-btn" class="fas fa-user"></div>
         <?php endif; ?><!-- BOTÃO QUE ESTAVA FALTANDO -->

         <?php
         $wishlist_num_rows = 0;
         $cart_num_rows = 0;

         if (isset($conn) && $user_id) {
             $wishlist_query = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
             $wishlist_num_rows = mysqli_num_rows($wishlist_query);

             $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
             $cart_num_rows = mysqli_num_rows($cart_query);
         }
         ?>
         <a href="/wishlist"><i class="fas fa-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
         <a href="/cart"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
      </div>

      <?php if ($user_id): ?>
         <div class="account-box">
            <p>usuário: <span><?php echo htmlspecialchars($user_name); ?></span></p>
            <p>email: <span><?php echo htmlspecialchars($user_email); ?></span></p>
            <a href="/logout" class="delete-btn">sair</a>
         </div>
      <?php endif; ?>

   </div>
</header>

<!-- JavaScript para ativar o menu e a account-box -->
<script>
let userBox = document.querySelector('.header .flex .account-box');
let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#user-btn').onclick = () => {
    userBox.classList.toggle('active');
    navbar.classList.remove('active');
}

document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
    userBox.classList.remove('active');
}

window.onscroll = () => {
    userBox.classList.remove('active');
    navbar.classList.remove('active');
}
</script>

</body>
</html>
