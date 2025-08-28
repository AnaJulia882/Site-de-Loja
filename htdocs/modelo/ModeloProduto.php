<?php
class ModeloProduto
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function produtoExiste($nome)
    {
    $stmt = $this->conn->prepare("SELECT id FROM produtos WHERE nome = ?");
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    return $stmt->get_result()->num_rows > 0;
    }

    public function createProduto($nome, $detalhes, $preco, $imagem)
    {
    $stmt = $this->conn->prepare("INSERT INTO produtos (nome, detalhes, preco, imagem) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $nome, $detalhes, $preco, $imagem);
    return $stmt->execute();
    }

    public function getAll()
    {
    return mysqli_query($this->conn, "SELECT * FROM produtos");
    }

    public function getImagemPorId($id)
    {
    $query = mysqli_query($this->conn, "SELECT imagem FROM produtos WHERE id = '$id'");
    return mysqli_fetch_assoc($query)['imagem'];
    }

    public function deleteProduto($id)
    {
    mysqli_query($this->conn, "DELETE FROM wishlist WHERE id_produto = '$id'");
    mysqli_query($this->conn, "DELETE FROM carrinho WHERE id_produto = '$id'");
    return mysqli_query($this->conn, "DELETE FROM produtos WHERE id = '$id'");
    }

    public function readPorNome($termo)
    {
    $termo = "%{$termo}%";
    $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE nome LIKE ?");
    $stmt->bind_param("s", $termo);
    $stmt->execute();
    return $stmt->get_result();
    }

    public function getById($id)
    {
    $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
    }

    public function updateProdutoInfo($id, $nome, $detalhes, $preco)
    {
    $stmt = $this->conn->prepare("UPDATE produtos SET nome = ?, detalhes = ?, preco = ? WHERE id = ?");
    $stmt->bind_param("ssii", $nome, $detalhes, $preco, $id);
    return $stmt->execute();
    }

    public function updateImagemProduto($id, $imagem)
    {
    $stmt = $this->conn->prepare("UPDATE produtos SET imagem = ? WHERE id = ?");
    $stmt->bind_param("si", $imagem, $id);
    return $stmt->execute();
    }
}
