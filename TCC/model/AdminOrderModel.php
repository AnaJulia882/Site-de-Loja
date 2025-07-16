<?php
class AdminOrderModel {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllOrders() {
        return mysqli_query($this->conn, "SELECT * FROM orders");
    }

    public function updatePaymentStatus($order_id, $status) {
        $stmt = $this->conn->prepare("UPDATE orders SET payment_status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $order_id);
        return $stmt->execute();
    }

    public function deleteOrder($order_id) {
        $stmt = $this->conn->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->bind_param("i", $order_id);
        return $stmt->execute();
    }
}

?>