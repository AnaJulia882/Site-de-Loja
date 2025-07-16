<?php @include 'shared/header.php'; ?>

<section class="form-container">
   <form action="" method="POST">
      <h3>Cadastre-se</h3>
      <?php
      if (!empty($message)) {
         foreach ($message as $msg) {
            echo '<div class="message">' . $msg . '</div>';
         }
      }
      ?>
      <input type="text" name="name" required placeholder="Digite seu nome" class="box">
      <input type="email" name="email" required placeholder="Digite seu e-mail" class="box">
      <input type="password" name="password" required placeholder="Digite sua senha" class="box">
      <input type="password" name="cpassword" required placeholder="Confirme sua senha" class="box">
      <input type="submit" name="submit" value="Cadastrar" class="btn">
      <p>Já tem uma conta? <a href="login.php">Entrar agora</a></p>
   </form>
</section>
