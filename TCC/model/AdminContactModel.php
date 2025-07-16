<?php
class AdminContactModel {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllMessages() {
        return mysqli_query($this->conn, "SELECT * FROM message");
    }

    public function deleteMessage($id) {
        $stmt = $this->conn->prepare("DELETE FROM message WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

?>