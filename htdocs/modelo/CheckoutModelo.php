<?php
class CheckoutModelo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getCarrinhoByUsuario($usuario_id)
    {
    $stmt = $this->conn->prepare("SELECT * FROM carrinho WHERE id_usuario = ?");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    return $stmt->get_result();
    }

    public function pedidoExiste($nome, $telefone, $email, $metodo, $endereco, $produtos, $total)
    {
    $stmt = $this->conn->prepare("SELECT * FROM pedidos WHERE nome = ? AND telefone = ? AND email = ? AND metodo_pagamento = ? AND endereco = ? AND produtos_totais = ? AND preco_total = ?");
    $stmt->bind_param("ssssssi", $nome, $telefone, $email, $metodo, $endereco, $produtos, $total);
    $stmt->execute();
    return $stmt->get_result()->num_rows > 0;
    }

    public function createPedido($usuario_id, $nome, $telefone, $email, $metodo, $endereco, $produtos, $total, $realizado_em)
    {
    $stmt = $this->conn->prepare("INSERT INTO pedidos (id_usuario, nome, telefone, email, metodo_pagamento, endereco, produtos_totais, preco_total, realizado_em) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssss", $usuario_id, $nome, $telefone, $email, $metodo, $endereco, $produtos, $total, $realizado_em);
    return $stmt->execute();
    }

    public function limparCarrinho($usuario_id)
    {
    return mysqli_query($this->conn, "DELETE FROM carrinho WHERE id_usuario = '$usuario_id'");
    }
}
