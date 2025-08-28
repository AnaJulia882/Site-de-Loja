<?php
// model/ModeloPedido.php
class ModeloPedido
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getPedidosByIdUsuario($id_usuario)
    {
    $stmt = $this->conn->prepare("SELECT * FROM pedidos WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    return $stmt->get_result();
    }
}
