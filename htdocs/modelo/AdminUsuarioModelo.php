<?php
class AdminUsuarioModelo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllUsuarios()
    {
    return mysqli_query($this->conn, "SELECT * FROM usuarios");
    }

    public function deleteUsuario($usuario_id)
    {
    $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $usuario_id);
    return $stmt->execute();
    }
}
