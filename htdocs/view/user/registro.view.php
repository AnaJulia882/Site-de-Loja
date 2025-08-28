<?php @include 'shared/footer.php'; ?>
<?php @include 'shared/header.php'; ?>

<section class="form-container">
   <form action="" method="POST">
      <h3>Cadastre-se</h3>
      <?php
      if (!empty($mensagens)) {
         foreach ($mensagens as $msg) {
            echo '<div class="message">' . $msg . '</div>';
         }
      }
      ?>
      <input type="text" name="nome" required placeholder="Digite seu nome" class="box">
      <input type="email" name="email" required placeholder="Digite seu e-mail" class="box">
      <input type="password" name="senha" required placeholder="Digite sua senha" class="box">
      <input type="password" name="confirmar_senha" required placeholder="Confirme sua senha" class="box">
      <input type="submit" name="enviar" value="Cadastrar" class="btn">
   <p>Já tem uma conta? <a href="/login">Entrar agora</a></p>
   </form>
</section>
