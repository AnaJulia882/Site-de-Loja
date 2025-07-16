<?php
require_once("Banco.php");

class Pedido implements JsonSerializable {
    private $id_pedido;
    private $data_pedido;
    private $status;
    private $total;
    private $usuarios_id_usuario;

    public function jsonSerialize(): mixed {
        $obj = new stdClass();
        $obj->id_pedido = $this->getId();
        $obj->data_pedido = $this->getDataPedido();
        $obj->status = $this->getStatus();
        $obj->total = $this->getTotal();
        $obj->usuarios_id_usuario = $this->getUsuarioId();
        return $obj;
    }

    public function create() {
        $conexao = Banco::getConexao();
        $sql = "INSERT INTO pedidos (usuarios_id_usuario, total, status) VALUES (?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ids", $this->usuarios_id_usuario, $this->total, $this->status);
        $stmt->execute();
        $this->id_pedido = $conexao->insert_id;
        return $stmt->affected_rows > 0;
    }

    public static function readAll() {
        $conexao = Banco::getConexao();
    // Consulta com JOIN para trazer os dados do usuário
    $sql = "
        SELECT p.*, u.nome AS usuario_nome, u.email AS usuario_email
        FROM pedidos p
        JOIN usuarios u ON p.usuarios_id_usuario = u.id_usuario
    ";
    $resultado = $conexao->query($sql);

    $pedidos = [];

    while ($linha = $resultado->fetch_object()) {
        $pedido = new Pedido();
        $pedido->setId($linha->id_pedido);
        $pedido->setDataPedido($linha->data_pedido);
        $pedido->setStatus($linha->status);
        $pedido->setTotal($linha->total);
        $pedido->setUsuarioId($linha->usuarios_id_usuario);

        // Adiciona os dados do usuário no pedido
        $pedido->usuario_nome = $linha->usuario_nome;
        $pedido->usuario_email = $linha->usuario_email;

        $pedidos[] = $pedido;
    }

    return $pedidos;
    }

    public function readById($id) {
        $conexao = Banco::getConexao();
        $sql = "SELECT * FROM pedidos WHERE id_pedido = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $dados = $resultado->fetch_object();

        if ($dados) {
            $this->setId($dados->id_pedido);
            $this->setDataPedido($dados->data_pedido);
            $this->setStatus($dados->status);
            $this->setTotal($dados->total);
            $this->setUsuarioId($dados->usuarios_id_usuario);
            return $this;
        }
        return null;
    }

    public function update($id, $status, $total) {
        $conexao = Banco::getConexao();
        $sql = "UPDATE pedidos SET status = ?, total = ? WHERE id_pedido = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sdi", $status, $total, $id);
        return $stmt->execute();
    }

    public function delete() {
        $conexao = Banco::getConexao();
        $sql = "DELETE FROM pedidos WHERE id_pedido = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $this->id_pedido);
        return $stmt->execute();
    }

    // Getters e Setters
    public function setId($id) {
        $this->id_pedido = $id;
    }
    public function getId() {
        return $this->id_pedido;
    }

    public function setDataPedido($data) {
        $this->data_pedido = $data;
    }
    public function getDataPedido() {
        return $this->data_pedido;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
    public function getStatus() {
        return $this->status;
    }

    public function setTotal($total) {
        $this->total = $total;
    }
    public function getTotal() {
        return $this->total;
    }

    public function setUsuarioId($id) {
        $this->usuarios_id_usuario = $id;
    }
    public function getUsuarioId() {
        return $this->usuarios_id_usuario;
    }
}
?>
