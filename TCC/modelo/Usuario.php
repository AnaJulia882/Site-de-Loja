<?php
require_once("modelo/Banco.php");

class Usuario implements JsonSerializable {
    private $id_usuario;
    private $nome;
    private $senha;
    private $email;
    private $tipo;

    public function jsonSerialize(): mixed {
        $obj = new stdClass();
        $obj->id_usuario = $this->getId();
        $obj->nome = $this->getNome();
        $obj->email = $this->getEmail();
        $obj->tipo = $this->getTipo();
        return $obj;
    }

    public function verificarUsuarioSenha() {
        $conexao = Banco::getConexao();
        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = md5(?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ss", $this->email, $this->senha);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_object();

        if ($usuario) {
            $this->setId($usuario->id_usuario);
            $this->setNome($usuario->nome);
            $this->setEmail($usuario->email);
            $this->setTipo($usuario->tipo);
            return true;
        }
        return false;
    }

    public function verificarEmail() {
        $conexao = Banco::getConexao();
        $sql = "SELECT COUNT(*) AS qtd FROM usuarios WHERE email = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $dados = $resultado->fetch_object();
        return $dados->qtd > 0;
    }

    public static function readById($id) {
        $conexao = Banco::getConexao();
        $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $linha = $resultado->fetch_object();

        if ($linha) {
            $usuario = new Usuario();
            $usuario->setId($linha->id_usuario);
            $usuario->setNome($linha->nome);
            $usuario->setEmail($linha->email);
            $usuario->setTipo($linha->tipo);
            return $usuario;
        }

        return null;
    }


    public function create() {
        $conexao = Banco::getConexao();
        $this->senha = md5($this->senha);

        $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssss", $this->nome, $this->email, $this->senha, $this->tipo);
        $stmt->execute();
        $this->id_usuario = $conexao->insert_id;
        return $stmt->affected_rows > 0;
    }

    public function updateSenha() {
        $conexao = Banco::getConexao();
        $this->senha = md5($this->senha);

        $sql = "UPDATE usuarios SET senha = ? WHERE email = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ss", $this->senha, $this->email);
        return $stmt->execute();
    }

    public function delete() {
        $conexao = Banco::getConexao();
        $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $this->id_usuario);
        return $stmt->execute();
    }

    public static function readAll() {
    $conexao = Banco::getConexao();
    $sql = "SELECT * FROM usuarios";
    $resultado = $conexao->query($sql);

    $usuarios = [];

    while ($linha = $resultado->fetch_object()) {
        $usuario = new Usuario();
        $usuario->setId($linha->id_usuario);
        $usuario->setNome($linha->nome);
        $usuario->setEmail($linha->email);
        $usuario->setTipo($linha->tipo);
        // NÃO pega a senha por segurança.

        $usuarios[] = $usuario;
    }

    return $usuarios;
}

public function update($id, $nome, $email, $tipo) {
    $conexao = Banco::getConexao();
    
    $sql = "UPDATE usuarios SET nome = ?, email = ?, tipo = ? WHERE id_usuario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssi", $nome, $email, $tipo, $id);
    
    return $stmt->execute();
}


    public function setId($id) {
        $this->id_usuario = $id;
    }
    public function getId() {
        return $this->id_usuario;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function getNome() {
        return $this->nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    public function getEmail() {
        return $this->email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }
    public function getSenha() {
        return $this->senha;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    public function getTipo() {
        return $this->tipo;
    }
}
?>