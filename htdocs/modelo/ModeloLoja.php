<?php
class ModeloShop
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Pega todos os produtos (pode melhorar com filtros/paginação)
    public function getAllProdutos()
    {
        $sql = "SELECT * FROM produtos ORDER BY id DESC"; // removi created_at pois não tem na sua tabela
        $result = $this->conn->query($sql);

        $produtos = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $produtos[] = $row;
            }
        }
        return $produtos;
    }

    // Exemplo: Buscar produtos por categoria (se você adicionar categoria na tabela)
    public function obterProdutosPorCategoria($id_categoria)
    {
        // Se não tiver campo categoria, vai dar erro, ajuste conforme necessário
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE categoria_id = ? ORDER BY id DESC");
        $stmt->bind_param("i", $id_categoria);
        $stmt->execute();
        $result = $stmt->get_result();

        $produtos = [];
        while ($row = $result->fetch_assoc()) {
            $produtos[] = $row;
        }
        return $produtos;
        // Ajuste conforme sua tabela, se não houver categoria remova este método
        return [];
    }

    // Adicione outros métodos de loja aqui (busca, filtros, etc)
}
