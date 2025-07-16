<?php
class AuthModel {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserByCredentials($email, $pass) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $pass);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}

?>