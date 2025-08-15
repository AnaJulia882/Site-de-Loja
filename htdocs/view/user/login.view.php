<?php @include '../../shared/header.php'; ?>
<section class="form-container">
   <form action="" method="POST">
      <h3>Entrar</h3>
      <?php
      if (!empty($mensagens)) {
         foreach ($mensagens as $msg) {
            echo '<div class="message">' . $msg . '</div>';
         }
      }
      ?>
      <input type="email" name="email" required placeholder="Digite seu e-mail" class="box">
      <input type="password" name="senha" required placeholder="Digite sua senha" class="box">
      <input type="submit" name="enviar" value="Entrar" class="btn">
      <p>Não tem uma conta? <a href="/register">Cadastre-se agora</a></p>
   </form>
</section>
