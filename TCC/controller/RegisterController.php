<?php
@include_once 'config/config.php';
include_once 'model/RegisterModel.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$model = new RegisterModel($conn);
$message = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $pass     = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass    = mysqli_real_escape_string($conn, $_POST['cpassword']);

    if ($model->emailExists($email)) {
        $message[] = 'Email já cadastrado!';
    } elseif ($pass !== $cpass) {
        $message[] = 'As senhas não coincidem!';
    } else {
        $model->registerUser($name, $email, $pass);
        $message[] = 'Conta criada com sucesso!';
        header('Location: /login');
        exit;
    }
}

include 'view/user/register.view.php';

?>