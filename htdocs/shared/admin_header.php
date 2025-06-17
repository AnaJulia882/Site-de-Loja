<header class="header">
   <div class="flex">

      <a href="/admin-dashboard" class="logo">Painel<span>Admin</span></a>

      <nav class="navbar">
         <ul>
            <li><a href="/admin-dashboard">Início</a></li>
            <li><a href="/admin-products">Produtos</a></li>
            <li><a href="/admin-orders">Pedidos</a></li>
            <li><a href="/admin-users">Usuários</a></li>
            <li><a href="/admin-contacts">Mensagens</a></li>
         </ul>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>Usuário: <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>E-mail: <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="/logout" class="delete-btn">Sair</a>
         <div>Novo <a href="/login">Login</a> | <a href="/register">Cadastro</a></div>
      </div>

   </div>
</header>
