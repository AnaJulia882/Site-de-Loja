<?php 
class AdminPedidoModelo {     
    private $conexao;     

    public function __construct($conexao) {         
        $this->conexao = $conexao;     
    }      

    public function getAllPedidos() {         
        return mysqli_query($this->conexao, "SELECT * FROM pedidos");     
    }      

    public function updateStatusPagamento($id_pedido, $status) {         
        $stmt = $this->conexao->prepare("UPDATE pedidos SET status_pagamento = ? WHERE id = ?");         
        $stmt->bind_param("si", $status, $id_pedido);         
        return $stmt->execute();     
    }      

    public function deletePedido($id_pedido) {         
        $stmt = $this->conexao->prepare("DELETE FROM pedidos WHERE id = ?");         
        $stmt->bind_param("i", $id_pedido);         
        return $stmt->execute();     
    } 
}  
?>
