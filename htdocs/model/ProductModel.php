<?php
class ProductModel {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function productExists($name) {
        $stmt = $this->conn->prepare("SELECT id FROM products WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function addProduct($name, $details, $price, $image) {
        $stmt = $this->conn->prepare("INSERT INTO products (name, details, price, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $name, $details, $price, $image);
        return $stmt->execute();
    }

    public function getAll() {
        return mysqli_query($this->conn, "SELECT * FROM products");
    }

    public function getImageById($id) {
        $query = mysqli_query($this->conn, "SELECT image FROM products WHERE id = '$id'");
        return mysqli_fetch_assoc($query)['image'];
    }

    public function deleteProduct($id) {
        mysqli_query($this->conn, "DELETE FROM wishlist WHERE pid = '$id'");
        mysqli_query($this->conn, "DELETE FROM cart WHERE pid = '$id'");
        return mysqli_query($this->conn, "DELETE FROM products WHERE id = '$id'");
    }

    public function searchByName($termo) {
        $termo = "%{$termo}%";
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE name LIKE ?");
        $stmt->bind_param("s", $termo);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function updateProductInfo($id, $name, $details, $price) {
        $stmt = $this->conn->prepare("UPDATE products SET name = ?, details = ?, price = ? WHERE id = ?");
        $stmt->bind_param("ssdi", $name, $details, $price, $id);
        return $stmt->execute();
    }

    public function updateProductImage($id, $image) {
        $stmt = $this->conn->prepare("UPDATE products SET image = ? WHERE id = ?");
        $stmt->bind_param("si", $image, $id);
        return $stmt->execute();
    }

}
?>