<?php
class ModeloPesquisa
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getProdutos($termo)
    {
    $like = "%{$termo}%";
    $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE nome LIKE ?");
    $stmt->bind_param("s", $like);
    $stmt->execute();
    return $stmt->get_result();
    }
}
