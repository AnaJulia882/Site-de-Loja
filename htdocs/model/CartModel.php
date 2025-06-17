<?php
class CartModel {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getCartItems($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function updateQuantity($cart_id, $quantity) {
        $stmt = $this->conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
        $stmt->bind_param("ii", $quantity, $cart_id);
        return $stmt->execute();
    }

    public function removeItem($cart_id) {
        $stmt = $this->conn->prepare("DELETE FROM cart WHERE id = ?");
        $stmt->bind_param("i", $cart_id);
        return $stmt->execute();
    }

    public function clearCart($user_id) {
        $stmt = $this->conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }

    public function getItemCount($user_id) {
        $res = mysqli_query($this->conn, "SELECT COUNT(*) as total FROM cart WHERE user_id = '$user_id'");
        return mysqli_fetch_assoc($res)['total'] ?? 0;
    }
}

?>