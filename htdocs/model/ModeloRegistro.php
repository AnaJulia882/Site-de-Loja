<?php
class ModeloRegistro
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function emailExiste($email)
    {
        $stmt = $this->conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function registrarUsuario($nome, $email, $senha)
    {
        // Criptografar a senha
        $senha_hash = password_hash($senha, PASSWORD_BCRYPT);
    
        // Salvar o usuário com a senha criptografada
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $senha_hash);
        return $stmt->execute();
    }
}
