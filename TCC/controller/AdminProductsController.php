<?php
@include_once 'config/config.php';
include_once 'model/ProductModel.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin-products');
    exit;
}

$productModel = new ProductModel($conn);
$message = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = floatval(str_replace(',', '.', $_POST['price']));
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder = __DIR__ . '/../images/';
    $image_path = $image_folder . $image;

    if ($productModel->productExists($name)) {
        $message[] = 'O nome do produto já existe!';
    } else {
        if ($productModel->addProduct($name, $details, $price, $image)) {
            if ($image_size <= 2 * 1024 * 1024) {
                if (move_uploaded_file($image_tmp, $image_path)) {
                    $message[] = 'Produto adicionado com sucesso!';
                } else {
                    $message[] = 'Erro ao mover a imagem!';
                }
            } else {
                $message[] = 'A imagem é muito grande!';
            }
        } else {
            $message[] = 'Erro ao adicionar produto.';
        }
    }

}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $image = $productModel->getImageById($id);
    unlink('images/' . $image);
    $productModel->deleteProduct($id);
    header('Location: /admin-products');
    exit;
}

$products = $productModel->getAll();
include 'view/admin/admin_products.view.php';

?>