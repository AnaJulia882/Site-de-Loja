<?php
class CheckoutModel {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getCartByUser($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function orderExists($name, $number, $email, $method, $address, $products, $total) {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
        $stmt->bind_param("ssssssi", $name, $number, $email, $method, $address, $products, $total);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function insertOrder($user_id, $name, $number, $email, $method, $address, $products, $total, $placed_on) {
        $stmt = $this->conn->prepare("INSERT INTO orders (user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssss", $user_id, $name, $number, $email, $method, $address, $products, $total, $placed_on);
        return $stmt->execute();
    }

    public function clearCart($user_id) {
        return mysqli_query($this->conn, "DELETE FROM cart WHERE user_id = '$user_id'");
    }
}
?>