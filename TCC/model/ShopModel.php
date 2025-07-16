<?php
class ShopModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Pega todos os produtos (você pode melhorar com filtros/pagination)
    public function getAllProducts() {
        $sql = "SELECT * FROM products ORDER BY created_at DESC"; // ajuste o nome da tabela e campos conforme seu DB
        $result = $this->conn->query($sql);

        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }

    // Exemplo: Buscar produtos por categoria
    public function getProductsByCategory($category_id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE category_id = ? ORDER BY created_at DESC");
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }

    // Você pode adicionar mais métodos relacionados à loja aqui, tipo busca, filtros, etc.
}
