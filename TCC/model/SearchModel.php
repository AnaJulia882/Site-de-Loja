<?php
class SearchModel {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function searchProducts($term) {
        $like = "%{$term}%";
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE name LIKE ?");
        $stmt->bind_param("s", $like);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>