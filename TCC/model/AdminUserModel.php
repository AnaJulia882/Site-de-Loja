<?php
class AdminUserModel {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllUsers() {
        return mysqli_query($this->conn, "SELECT * FROM users");
    }

    public function deleteUser($user_id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }
}

?>