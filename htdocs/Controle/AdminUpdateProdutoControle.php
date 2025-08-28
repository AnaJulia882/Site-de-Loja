<?php
@include_once 'config/config.php';
include_once 'model/ModeloProduto.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin-update-produto');
    exit;
}

$modelo = new ModeloProduto($conn);
$mensagem = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_produto'])) {
    $id = $_POST['update_p_id'];
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $preco = floatval($_POST['preco']);
    $detalhes = mysqli_real_escape_string($conn, $_POST['detalhes']);
    $old_imagem = $_POST['update_p_imagem'];

    $modelo->updateProdutoInfo($id, $nome, $detalhes, $preco);

    if (!empty($_FILES['imagem']['nome'])) {
        $imagem = $_FILES['imagemm']['nome'];
        $imagem_tmp = $_FILES['imagem']['tmp_nome'];
        $imagem_size = $_FILES['imagem']['size'];
        $imagem_path = 'uploaded_img/' . $imagem;

        if ($imagem_size > 2 * 1024 * 1024) {
            $mensagem[] = 'O tamanho do arquivo de imagem é muito grande!';
        } else {
            $modelo->updateImagemProduto($id, $imagem);
            move_uploaded_file($imagem_tmp, $imagem_path);
            unlink('uploaded_img/' . $old_imagem);
            $mensagem[] = 'Imagem atualizada com sucesso!';
        }
    }

    $mensagem[] = 'Produto atualizado com sucesso!';
}

$produto = isset($_GET['update']) ? $modelo->getById($_GET['update']) : null;
include 'view/admin/admin_update_produto.view.php';
?>