CREATE DATABASE tcc;
USE tcc;

-- Tabela de usuários
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('cliente', 'admin') DEFAULT 'cliente'
);

-- Tabela de categorias
CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    descricao TEXT
);

-- Tabela de produtos
CREATE TABLE produtos (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    tamanho VARCHAR(10),
    cor VARCHAR(30),
    estoque INT DEFAULT 0,
    imagem_url TEXT,
    categorias_id_categoria INT,
    FOREIGN KEY (categorias_id_categoria) REFERENCES categorias(id_categoria)
);

-- Tabela de pedidos
CREATE TABLE pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    data_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(30) DEFAULT 'Pendente',
    total DECIMAL(10, 2),
    usuarios_id_usuario INT,
    FOREIGN KEY (usuarios_id_usuario) REFERENCES usuarios(id_usuario)
);

-- Tabela de carrinho
CREATE TABLE carrinho (
    id_carrinho INT AUTO_INCREMENT PRIMARY KEY,
    quantidade INT NOT NULL DEFAULT 1,
    usuarios_id_usuario INT,
    produtos_id_produto INT,
    pedidos_id_pedido INT,
    FOREIGN KEY (produtos_id_produto) REFERENCES produtos(id_produto),
    FOREIGN KEY (pedidos_id_pedido) REFERENCES pedidos(id_pedido)
);
