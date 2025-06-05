<?php
require_once("Banco.php");

class Categoria implements JsonSerializable {
    private $id_categoria;
    private $nome;
    private $descricao;

    public function jsonSerialize(): mixed {
        $obj = new stdClass();
        $obj->id_categoria = $this->getId();
        $obj->nome = $this->getNome();
        $obj->descricao = $this->getDescricao();
        return $obj;
    }

    public function create() {
        $conexao = Banco::getConexao();
        $sql = "INSERT INTO categorias (nome, descricao) VALUES (?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ss", $this->nome, $this->descricao);
        $stmt->execute();
        $this->id_categoria = $conexao->insert_id;
        return $stmt->affected_rows > 0;
    }

    public static function readAll() {
        $conexao = Banco::getConexao();
        $sql = "SELECT * FROM categorias";
        $resultado = $conexao->query($sql);

        $categorias = [];

        while ($linha = $resultado->fetch_object()) {
            $categoria = new Categoria();
            $categoria->setId($linha->id_categoria);
            $categoria->setNome($linha->nome);
            $categoria->setDescricao($linha->descricao);
            $categorias[] = $categoria;
        }

        return $categorias;
    }

    public function readById($id) {
        $conexao = Banco::getConexao();
        $sql = "SELECT * FROM categorias WHERE id_categoria = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $dados = $resultado->fetch_object();

        if ($dados) {
            $this->setId($dados->id_categoria);
            $this->setNome($dados->nome);
            $this->setDescricao($dados->descricao);
            return $this;
        }
        return null;
    }

    public function update($id, $nome, $descricao) {
        $conexao = Banco::getConexao();
        $sql = "UPDATE categorias SET nome = ?, descricao = ? WHERE id_categoria = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssi", $nome, $descricao, $id);
        return $stmt->execute();
    }

    public function delete() {
        $conexao = Banco::getConexao();
        $sql = "DELETE FROM categorias WHERE id_categoria = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $this->id_categoria);
        return $stmt->execute();
    }

    // Getters e Setters
    public function setId($id) {
        $this->id_categoria = $id;
    }
    public function getId() {
        return $this->id_categoria;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function getNome() {
        return $this->nome;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    public function getDescricao() {
        return $this->descricao;
    }
}
?>
