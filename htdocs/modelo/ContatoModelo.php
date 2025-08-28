<?php
class ContatoModelo
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function mensagemExiste($nome, $email, $telefone, $mensagem)
    {
    $stmt = $this->conn->prepare("SELECT * FROM mensagens WHERE nome = ? AND email = ? AND telefone = ? AND mensagem = ?");
    $stmt->bind_param("ssss", $nome, $email, $telefone, $mensagem);
    $stmt->execute();
    return $stmt->get_result()->num_rows > 0;
    }

    public function salvarMensagem($id_usuario, $nome, $email, $telefone, $mensagem)
    {
    $stmt = $this->conn->prepare("INSERT INTO mensagens (id_usuario, nome, email, telefone, mensagem) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $id_usuario, $nome, $email, $telefone, $mensagem);
    return $stmt->execute();
    }
}
