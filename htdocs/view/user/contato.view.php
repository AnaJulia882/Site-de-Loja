<?php @include 'shared/header.php'; ?>

<section class="heading">
    <h3>Fale Conosco</h3>
    <p> <a href="/home">Início</a> / Contato </p>
</section>

<section class="contact">

    <form action="" method="POST">
        <h3>Envie sua mensagem!</h3>
        <input type="text" name="nome" placeholder="Digite seu nome" class="box" required>
        <input type="email" name="email" placeholder="Digite seu e-mail" class="box" required>
        <input type="text" name="telefone" placeholder="Digite seu telefone" class="box" required>
        <textarea name="mensagem" class="box" placeholder="Digite sua mensagem" required cols="30" rows="10"></textarea>
        <input type="submit" value="Enviar mensagem" name="enviar" class="btn">
    </form>
</section>

<?php @include 'shared/footer.php'; ?>
