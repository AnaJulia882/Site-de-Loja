<?php
@include_once 'config/config.php';
include_once 'model/AuthModel.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$model = new AuthModel($conn);
$message = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $user = $model->getUserByCredentials($email, $pass);

    if ($user) {
        if ($user['user_type'] === 'admin') {
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];    
            $_SESSION['user_email'] = $user['email'];
            header('Location: index.php?page=admin-dashboard');
        } else {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];    
            $_SESSION['user_email'] = $user['email'];
            header('Location: index.php?page=home');
        }
        exit;
    } else {
        $message[] = 'Email ou senha incorretos!';
    }
}

include 'view/user/login.view.php';
?>
