<?php
class ModeloAutenticacao
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUsuarioByCredenciais($email, $senha)
    {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
