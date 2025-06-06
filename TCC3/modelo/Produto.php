<?php

require_once("Banco.php");

class Produto implements JsonSerializable {
    private $id_produto;
    private $nome;
    private $descricao;
    private $preco;
    private $tamanho;
    private $cor;
    private $estoque;
    private $imagem_url;
    private $categorias_id_categoria;

    public function jsonSerialize(): mixed {
      $obj = new stdClass();
      $obj->id_produto = $this->getId();          
      $obj->nome = $this->getNome();              
      $obj->descricao = $this->getDescricao();    
      $obj->preco = $this->getPreco();           
      $obj->tamanho = $this->getTamanho();        
      $obj->cor = $this->getCor();                
      $obj->estoque = $this->getEstoque();        
      $obj->imagem_url = $this->getImagemUrl();   
      $obj->categorias_id_categoria = $this->getCategoriaId(); 
      return $obj;
    }

    public function create() {
        $conexao = Banco::getConexao();
        $sql = "INSERT INTO produtos (nome, descricao, preco, tamanho, cor, estoque, imagem_url, categorias_id_categoria) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssdsdssi", $this->nome, $this->descricao, $this->preco, $this->tamanho, $this->cor, $this->estoque, $this->imagem_url, $this->categorias_id_categoria);
        $stmt->execute();
        $this->id_produto = $conexao->insert_id;
        return $stmt->affected_rows > 0;
    }

    public static function readAll() {
        $conexao = Banco::getConexao();
        $sql = "SELECT * FROM produtos";
        $resultado = $conexao->query($sql);

        $produtos = [];

        while ($linha = $resultado->fetch_object()) {
            $produto = new Produto();
            $produto->setId($linha->id_produto);
            $produto->setNome($linha->nome);
            $produto->setDescricao($linha->descricao);
            $produto->setPreco($linha->preco);
            $produto->setTamanho($linha->tamanho);
            $produto->setCor($linha->cor);
            $produto->setEstoque($linha->estoque);
            $produto->setImagemUrl($linha->imagem_url);
            $produto->setCategoriaId($linha->categorias_id_categoria);
            $produtos[] = $produto;
        }

        return $produtos;
    }

    public function readById($id) {
        $conexao = Banco::getConexao();
        $sql = "SELECT * FROM produtos WHERE id_produto = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $dados = $resultado->fetch_object();

        if ($dados) {
            $this->setId($dados->id_produto);
            $this->setNome($dados->nome);
            $this->setDescricao($dados->descricao);
            $this->setPreco($dados->preco);
            $this->setTamanho($dados->tamanho);
            $this->setCor($dados->cor);
            $this->setEstoque($dados->estoque);
            $this->setImagemUrl($dados->imagem_url);
            $this->setCategoriaId($dados->categorias_id_categoria);
            return $this;
        }
        return null;
    }

    public function update() {
        $conexao = Banco::getConexao();
        $sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ?, tamanho = ?, cor = ?, estoque = ?, imagem_url = ?, categorias_id_categoria = ? 
                WHERE id_produto = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssdsdssii", $this->nome, $this->descricao, $this->preco, $this->tamanho, $this->cor, $this->estoque, $this->imagem_url, $this->categorias_id_categoria, $this->id_produto);
        return $stmt->execute();
    }

    public function delete() {
        $conexao = Banco::getConexao();
        $sql = "DELETE FROM produtos WHERE id_produto = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $this->id_produto);
        return $stmt->execute();
    }

    // Getters e Setters
    public function setId($id) {
        $this->id_produto = $id;
    }
    public function getId() {
        return $this->id_produto;
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

    public function setPreco($preco) {
        $this->preco = $preco;
    }
    public function getPreco() {
        return $this->preco;
    }

    public function setTamanho($tamanho) {
        $this->tamanho = $tamanho;
    }
    public function getTamanho() {
        return $this->tamanho;
    }

    public function setCor($cor) {
        $this->cor = $cor;
    }
    public function getCor() {
        return $this->cor;
    }

    public function setEstoque($estoque) {
        $this->estoque = $estoque;
    }
    public function getEstoque() {
        return $this->estoque;
    }

    public function setImagemUrl($imagem_url) {
        $this->imagem_url = $imagem_url;
    }
    public function getImagemUrl() {
        return $this->imagem_url;
    }

    public function setCategoriaId($categoria_id) {
        $this->categorias_id_categoria = $categoria_id;
    }
    public function getCategoriaId() {
        return $this->categorias_id_categoria;
    }
}
?>
