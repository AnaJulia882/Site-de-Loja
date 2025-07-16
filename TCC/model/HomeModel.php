<?php

class HomeModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getLatestProducts($limit = 6) {
        $stmt = $this->conn->prepare("SELECT * FROM products LIMIT ?");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function isInWishlist($user_id, $name) {
        $stmt = $this->conn->prepare("SELECT id FROM wishlist WHERE name = ? AND user_id = ?");
        $stmt->bind_param("si", $name, $user_id);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function isInCart($user_id, $name) {
        $stmt = $this->conn->prepare("SELECT id FROM cart WHERE name = ? AND user_id = ?");
        $stmt->bind_param("si", $name, $user_id);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function addToWishlist($user_id, $pid, $name, $price, $image) {
        $stmt = $this->conn->prepare("INSERT INTO wishlist (user_id, pid, name, price, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisis", $user_id, $pid, $name, $price, $image);
        return $stmt->execute();
    }

    public function removeFromWishlist($user_id, $name) {
        $stmt = $this->conn->prepare("DELETE FROM wishlist WHERE name = ? AND user_id = ?");
        $stmt->bind_param("si", $name, $user_id);
        return $stmt->execute();
    }

    public function addToCart($user_id, $pid, $name, $price, $quantity, $image) {
        $stmt = $this->conn->prepare("INSERT INTO cart (user_id, pid, name, price, quantity, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisiss", $user_id, $pid, $name, $price, $quantity, $image);
        return $stmt->execute();
    }
}
?>
