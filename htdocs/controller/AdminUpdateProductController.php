<?php
@include_once 'config/config.php';
include_once 'model/ProductModel.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin-update-product');
    exit;
}

$model = new ProductModel($conn);
$message = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
    $id = $_POST['update_p_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = floatval($_POST['price']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $old_image = $_POST['update_p_image'];

    $model->updateProductInfo($id, $name, $details, $price);

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_path = 'uploaded_img/' . $image;

        if ($image_size > 2 * 1024 * 1024) {
            $message[] = 'O tamanho do arquivo de imagem é muito grande!';
        } else {
            $model->updateProductImage($id, $image);
            move_uploaded_file($image_tmp, $image_path);
            unlink('uploaded_img/' . $old_image);
            $message[] = 'Imagem atualizada com sucesso!';
        }
    }

    $message[] = 'Produto atualizado com sucesso!';
}

$product = isset($_GET['update']) ? $model->getProductById($_GET['update']) : null;
include 'view/admin/admin_update_product.view.php';
?>