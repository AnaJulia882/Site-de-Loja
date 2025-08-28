<?php
class ModeloViewProduto
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getProdutoById($id)
    {
    $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
    }
}
