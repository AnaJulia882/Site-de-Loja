<?php @include 'shared/header.php'; ?>

<section class="heading">
    <h3>Fale conosco</h3>
    <p> <a href="/home">Início</a> / Contato </p>
</section>

<section class="contact">
    <?php
    if (!empty($message)) {
        foreach ($message as $msg) {
            echo '<div class="message">' . $msg . '</div>';
        }
    }
    ?>

    <form action="" method="POST">
        <h3>Envie sua mensagem!</h3>
        <input type="text" name="name" placeholder="Digite seu nome" class="box" required>
        <input type="email" name="email" placeholder="Digite seu e-mail" class="box" required>
        <input type="text" name="number" placeholder="Digite seu telefone" class="box" required>
        <textarea name="message" class="box" placeholder="Digite sua mensagem" required cols="30" rows="10"></textarea>
        <input type="submit" value="Enviar mensagem" name="send" class="btn">
    </form>
</section>

<?php @include 'shared/footer.php'; ?>
