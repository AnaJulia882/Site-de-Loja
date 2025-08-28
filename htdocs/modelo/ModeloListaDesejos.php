<?php
class ModeloListaDesejos
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function obterListaDesejosPorUsuarioId($id_usuario)
    {
    return mysqli_query($this->conn, "SELECT * FROM wishlist WHERE id_usuario = '$id_usuario'");
    }

    public function deletarItem($id)
    {
    return mysqli_query($this->conn, "DELETE FROM wishlist WHERE id = '$id'");
    }

    public function deletarTodosPorUsuario($id_usuario)
    {
    return mysqli_query($this->conn, "DELETE FROM wishlist WHERE id_usuario = '$id_usuario'");
    }
}
