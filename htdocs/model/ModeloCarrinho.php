<?php
class ModeloCarrinho
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getCarrinhoItems($id_usuario)
    {
        $stmt = $this->conn->prepare("SELECT * FROM carrinho WHERE id_usuario = ?");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function updateQuantidade($carrinho_id, $quantidade)
    {
        $stmt = $this->conn->prepare("UPDATE carrinho SET quantidade = ? WHERE id = ?");
        $stmt->bind_param("ii", $quantidade, $carrinho_id);
        return $stmt->execute();
    }

    public function deleteItem($carrinho_id)
    {
        $stmt = $this->conn->prepare("DELETE FROM carrinho WHERE id = ?");
        $stmt->bind_param("i", $carrinho_id);
        return $stmt->execute();
    }

    public function deleteCarrinho($id_usuario)
    {
        $stmt = $this->conn->prepare("DELETE FROM carrinho WHERE id_usuario = ?");
        $stmt->bind_param("i", $id_usuario);
        return $stmt->execute();
    }

    public function obterQuantidadeItens($id_usuario)
    {
        $res = mysqli_query($this->conn, "SELECT COUNT(*) as total FROM carrinho WHERE id_usuario = '$id_usuario'");
        return mysqli_fetch_assoc($res)['total'] ?? 0;
    }

    public function adicionarItem($id_usuario, $post_data, $listaDesejosModelo = null)
    {
        $id_produto = $post_data['id_produto'];
        $nome_produto = $post_data['nome_produto'];
        $preco_produto = floatval(str_replace(',', '.', $post_data['preco_produto']));
        $imagem_produto = $post_data['imagem_produto'];
        $quantidade_produto = intval($post_data['quantidade_produto']);

        // Verificar se o item já está no carrinho
        $stmt = $this->conn->prepare("SELECT * FROM carrinho WHERE id_usuario = ? AND id_produto = ?");
        $stmt->bind_param("ii", $id_usuario, $id_produto);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return 'Produto já está no carrinho!';
        } else {
            $stmt = $this->conn->prepare("INSERT INTO carrinho (id_usuario, id_produto, nome, preco, imagem, quantidade) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iisisi", $id_usuario, $id_produto, $nome_produto, $preco_produto, $imagem_produto, $quantidade_produto);

            if ($stmt->execute()) {
                return 'Produto adicionado ao carrinho com sucesso!';
            } else {
                return 'Erro ao adicionar ao carrinho.';
            }
        }
    }
}
