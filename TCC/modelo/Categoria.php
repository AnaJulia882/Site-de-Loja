<?php
// Inclui o arquivo Banco.php, que provavelmente contém funcionalidades relacionadas ao banco de dados
require_once ("modelo/Banco.php");

// Definição da classe Cargo, que implementa a interface JsonSerializable
class Cargo implements JsonSerializable
{
    // Propriedades privadas da classe
    private $idCargo;
    private $nomeCargo;

    // Método necessário pela interface JsonSerializable para serialização do objeto para JSON
    public function jsonSerialize()
    {
        // Cria um objeto stdClass para armazenar os dados do cargo
        $objetoResposta = new stdClass();
        // Define as propriedades do objeto com os valores das propriedades da classe
        $objetoResposta->idCargo = $this->idCargo;
        $objetoResposta->nomeCargo = $this->nomeCargo;

        // Retorna o objeto para serialização
        return $objetoResposta;
    }
    public function createFromCSV()
    {
        $conexao = Banco::getConexao(); // Obtém a conexão com o banco de dados
        // Define a consulta SQL para inserir um novo funcionário
        $SQL = "INSERT into Funcionario
        (nomeFuncionario, email, senha, recebeValeTransporte,Cargo_idCargo)
        VALUES(?,?,?,?,(SELECT idCargo FROM cargo WHERE nomeCargo = ? ))";
        $prepararSQL = $conexao->prepare($SQL); // Prepara a consulta
        $nomeCargo = $this->cargo->getNomeCargo(); // Obtém o nome do cargo do funcionário
        $prepararSQL->bind_param("sssis", $this->nomeFuncionario, $this->email, $this->senha, $this->recebeValeTransporte, $nomeCargo);
        // Executa a consulta
        $executar = $prepararSQL->execute();
        // Obtém o ID do funcionário cadastrado
        $idCadastrado = $conexao->insert_id;
        // Define o ID do funcionário na instância atual da classe
        $this->setIdFuncionario($idCadastrado);
        // Fecha a consulta
        $prepararSQL->close();
        // Retorna se a operação foi executada com sucesso
        return $executar;
    }
    // Método para criar um novo cargo no banco de dados
    public function create()
    {
        // Obtém a conexão com o banco de dados
        $conexao = Banco::getConexao();
        // Define a consulta SQL para inserir um novo cargo
        $SQL = "INSERT INTO cargo (nomeCargo)VALUES(?);";
        // Prepara a consulta
        $prepareSQL = $conexao->prepare($SQL);
        // Define o parâmetro da consulta com o nome do cargo
        $prepareSQL->bind_param("s", $this->nomeCargo);
        // Executa a consulta
        $executou = $prepareSQL->execute();
        // Obtém o ID do cargo inserido
        $idCadastrado = $conexao->insert_id;
        // Define o ID do cargo na instância atual da classe
        $this->setIdCargo($idCadastrado);
        // Retorna se a operação foi executada com sucesso
        return $executou;
    }

    // Método para excluir um cargo do banco de dados
    public function delete()
    {
        // Obtém a conexão com o banco de dados
        $conexao = Banco::getConexao();
        // Define a consulta SQL para excluir um cargo pelo ID
        $SQL = "delete from cargo where idCargo=?;";
        // Prepara a consulta
        $prepareSQL = $conexao->prepare($SQL);
        // Define o parâmetro da consulta com o ID do cargo
        $prepareSQL->bind_param("i", $this->idCargo);
        // Executa a consulta
        return $prepareSQL->execute();
    }

    // Método para atualizar os dados de um cargo no banco de dados
    public function update()
    {
        // Obtém a conexão com o banco de dados
        $conexao = Banco::getConexao();
        // Define a consulta SQL para atualizar o nome do cargo pelo ID
        $SQL = "update cargo set nomeCargo = ? where idCargo=?";
        // Prepara a consulta
        $prepareSQL = $conexao->prepare($SQL);
        // Define os parâmetros da consulta com o novo nome do cargo e o ID do cargo
        $prepareSQL->bind_param("si", $this->nomeCargo, $this->idCargo);
        // Executa a consulta
        $executou = $prepareSQL->execute();
        // Retorna se a operação foi executada com sucesso
        return $executou;
    }

    // Método para verificar se um cargo já existe no banco de dados
    public function isCargo()
    {
        // Obtém a conexão com o banco de dados
        $conexao = Banco::getConexao();
        // Define a consulta SQL para contar quantos cargos possuem o mesmo nome
        $SQL = "SELECT COUNT(*) AS qtd FROM cargo WHERE nomeCargo =?;";
        // Prepara a consulta
        $prepareSQL = $conexao->prepare($SQL);
        // Define o parâmetro da consulta com o nome do cargo
        $prepareSQL->bind_param("s", $this->nomeCargo);
        // Executa a consulta
        $executou = $prepareSQL->execute();

        // Obtém o resultado da consulta
        $matrizTuplas = $prepareSQL->get_result();

        // Extrai o objeto da tupla
        $objTupla = $matrizTuplas->fetch_object();
        // Retorna se a quantidade de cargos encontrados é maior que zero
        return $objTupla->qtd > 0;

    }

    // Método para ler todos os cargos do banco de dados
    public function readAll()
    {
        // Obtém a conexão com o banco de dados
        $conexao = Banco::getConexao();
        // Define a consulta SQL para selecionar todos os cargos ordenados por nome
        $SQL = "Select * from cargo order by nomeCargo";
        // Prepara a consulta
        $prepareSQL = $conexao->prepare($SQL);
        // Executa a consulta
        $executou = $prepareSQL->execute();
        // Obtém o resultado da consulta
        $matrizTuplas = $prepareSQL->get_result();
        // Inicializa um vetor para armazenar os cargos
        $vetorCargos = array();
        $i = 0;
        // Itera sobre as tuplas do resultado
        while ($tupla = $matrizTuplas->fetch_object()) {
            // Cria uma nova instância de Cargo para cada tupla encontrada
            $vetorCargos[$i] = new Cargo();
            // Define o ID e o nome do cargo na instância
            $vetorCargos[$i]->setIdCargo($tupla->idCargo);
            $vetorCargos[$i]->setNomeCargo($tupla->nomeCargo);
            $i++;
        }
        // Retorna o vetor com os cargos encontrados
        return $vetorCargos;
    }

    // Método para ler um cargo do banco de dados com base no ID
    public function readByID()
    {
        // Obtém a conexão com o banco de dados
        $conexao = Banco::getConexao();
        // Define a consulta SQL para selecionar um cargo pelo ID
        $SQL = "SELECT * FROM cargo WHERE idCargo=?;";
        // Prepara a consulta
        $prepareSQL = $conexao->prepare($SQL);
        // Define o parâmetro da consulta com o ID do cargo
        $prepareSQL->bind_param("i", $this->idCargo);
        // Executa a consulta
        $executou = $prepareSQL->execute();
        // Obtém o resultado da consulta
        $matrizTuplas = $prepareSQL->get_result();
        // Inicializa um vetor para armazenar os cargos
        $vetorCargos = array();
        $i = 0;
        // Itera sobre as tuplas do resultado
        while ($tupla = $matrizTuplas->fetch_object()) {
            // Cria uma nova instância de Cargo para cada tupla encontrada
            $vetorCargos[$i] = new Cargo();
            // Define o ID e o nome do cargo na instância
            $vetorCargos[$i]->setIdCargo($tupla->idCargo);
            $vetorCargos[$i]->setNomeCargo($tupla->nomeCargo);
            $i++;
        }
        // Retorna o vetor com os cargos encontrados
        return $vetorCargos;
    }

    // Método getter para idCargo
    public function getIdCargo()
    {
        return $this->idCargo;
    }

    // Método setter para idCargo
    public function setIdCargo($idCargo)
    {
        $this->idCargo = $idCargo;

        return $this;
    }

    // Método getter para nomeCargo
    public function getNomeCargo()
    {
        return $this->nomeCargo;
    }

    // Método setter para nomeCargo
    public function setNomeCargo($nameCargo)
    {
        $this->nomeCargo = $nameCargo;

        return $this;
    }
}

?>