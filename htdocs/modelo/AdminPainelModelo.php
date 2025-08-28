<?php
class AdminPainelModelo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getSomaPorStatus($status)
    {
        $query = $this->conn->prepare("SELECT preco_total FROM pedidos WHERE status_pagamento = ?");
        $query->bind_param("s", $status);
        $query->execute();
        $result = $query->get_result();
        $soma = 0;
        while ($row = $result->fetch_assoc()) {
            $soma += $row['preco_total'];
        }
        return $soma;
    }

    public function countRows($tabela, $condicao = "")
    {
    $queryStr = "SELECT * FROM $tabela" . ($condicao ? " WHERE $condicao" : "");
    $result = mysqli_query($this->conn, $queryStr);
    return mysqli_num_rows($result);
    }
}
