<?php

class ContactModel {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function messageExists($name, $email, $number, $msg) {
        $stmt = $this->conn->prepare("SELECT * FROM message WHERE name = ? AND email = ? AND number = ? AND message = ?");
        $stmt->bind_param("ssss", $name, $email, $number, $msg);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function saveMessage($user_id, $name, $email, $number, $msg) {
        $stmt = $this->conn->prepare("INSERT INTO message (user_id, name, email, number, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $user_id, $name, $email, $number, $msg);
        return $stmt->execute();
    }
}
?>