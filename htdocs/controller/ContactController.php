<?php
@include_once 'config/config.php';
include_once 'model/ContactModel.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: /contact');
    exit;
}

$user_id = $_SESSION['user_id'];
$model = new ContactModel($conn);
$message = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send'])) {
    $name   = mysqli_real_escape_string($conn, $_POST['name']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $msg    = mysqli_real_escape_string($conn, $_POST['message']);

    if ($model->messageExists($name, $email, $number, $msg)) {
        $message[] = 'Mensagem já enviada anteriormente!';
    } else {
        $model->saveMessage($user_id, $name, $email, $number, $msg);
        $message[] = 'Mensagem enviada com sucesso!';
    }
}

include 'view/user/contact.view.php';
?>