<?php
class AdminContatoModelo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllMensagens()
    {
        return mysqli_query($this->conn, "SELECT * FROM mensagens");
    }

    public function deleteMensagem($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM mensagens WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
