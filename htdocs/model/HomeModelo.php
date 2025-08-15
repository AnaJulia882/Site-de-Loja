<?php
class HomeModelo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function obterProdutosRecentes($limite = 6)
    {
        $stmt = $this->conn->prepare("SELECT * FROM produtos LIMIT ?");
        $stmt->bind_param("i", $limite);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function estaNaListaDesejos($id_usuario, $nome)
    {
        $stmt = $this->conn->prepare("SELECT id FROM wishlist WHERE nome = ? AND id_usuario = ?");
        $stmt->bind_param("si", $nome, $id_usuario);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function estaNoCarrinho($id_usuario, $nome)
    {
        $stmt = $this->conn->prepare("SELECT id FROM carrinho WHERE nome = ? AND id_usuario = ?");
        $stmt->bind_param("si", $nome, $id_usuario);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function adicionarListaDesejos($id_usuario, $id_produto, $nome, $preco, $imagem)
    {
        $stmt = $this->conn->prepare("INSERT INTO wishlist (id_usuario, id_produto, nome, preco, imagem) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisis", $id_usuario, $id_produto, $nome, $preco, $imagem);
        return $stmt->execute();
    }

    public function removerListaDesejos($id_usuario, $nome)
    {
        $stmt = $this->conn->prepare("DELETE FROM wishlist WHERE nome = ? AND id_usuario = ?");
        $stmt->bind_param("si", $nome, $id_usuario);
        return $stmt->execute();
    }

    public function adicionarCarrinho($id_usuario, $id_produto, $nome, $preco, $quantidade, $imagem)
    {
        $stmt = $this->conn->prepare("INSERT INTO carrinho (id_usuario, id_produto, nome, preco, quantidade, imagem) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisis", $id_usuario, $id_produto, $nome, $preco, $quantidade, $imagem);
        return $stmt->execute();
    }
}
