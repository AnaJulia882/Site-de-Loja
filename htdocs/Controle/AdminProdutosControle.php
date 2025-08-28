<?php
@include_once 'config/config.php';
include_once 'model/ModeloProduto.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin-produtos');
    exit;
}

$produtoModelo = new ModeloProduto($conn);
$mensagem = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_produto'])) {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $preco = floatval(str_replace(',', '.', $_POST['preco']));
    $detalhes = mysqli_real_escape_string($conn, $_POST['detalhes']);
    
    $imagem = $_FILES['imagem']['name'];
    $imagem_tmp = $_FILES['imagem']['tmp_name'];
    $tamanho_imagem = $_FILES['imagem']['size'];
    $pasta_imagens = __DIR__ . '/../images/';
    $caminho_imagem = $pasta_imagens . $imagem;

    if ($produtoModelo->produtoExiste($nome)) {
        $mensagem[] = 'O nome do produto já existe!';
    } else {
        if ($produtoModelo->createProduto($nome, $detalhes, $preco, $imagem)) {
            if ($tamanho_imagem <= 2 * 1024 * 1024) {
                if (move_uploaded_file($imagem_tmp, $caminho_imagem)) {
                    $mensagem[] = 'Produto adicionado com sucesso!';
                } else {
                    $mensagem[] = 'Erro ao mover a imagem!';
                }
            } else {
                $mensagem[] = 'A imagem é muito grande!';
            }
        } else {
            $mensagem[] = 'Erro ao adicionar produto.';
        }
    }
}

if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $imagem = $produtoModelo->getImagemPorId($id);
    unlink('images/' . $imagem);
    $produtoModelo->deleteProduto($id);
    header('Location: /admin-produtos');
    exit;
}

$produtos = $produtoModelo->getAll();
include 'view/admin/admin_produtos.view.php';
?>
