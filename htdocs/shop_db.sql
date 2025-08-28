CREATE DATABASE IF NOT EXISTS shop_db;
USE shop_db;

-- Tabela de usuários
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  senha VARCHAR(100) NOT NULL,
  tipo_usuario VARCHAR(20) NOT NULL DEFAULT 'user'
);

-- Tabela de produtos
CREATE TABLE produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  detalhes VARCHAR(500) NOT NULL,
  preco INT NOT NULL,
  imagem VARCHAR(100) NOT NULL
);

-- Tabela de carrinho
CREATE TABLE carrinho (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  id_produto INT NOT NULL,
  nome VARCHAR(100) NOT NULL,
  preco INT NOT NULL,
  quantidade INT NOT NULL,
  imagem VARCHAR(100) NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
  FOREIGN KEY (id_produto) REFERENCES produtos(id) ON DELETE CASCADE
);

-- Tabela de lista de desejos (wishlist)
CREATE TABLE wishlist (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  id_produto INT NOT NULL,
  nome VARCHAR(100) NOT NULL,
  preco INT NOT NULL,
  imagem VARCHAR(100) NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
  FOREIGN KEY (id_produto) REFERENCES produtos(id) ON DELETE CASCADE
);

-- Tabela de mensagens
CREATE TABLE mensagens (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  telefone VARCHAR(12) NOT NULL,
  mensagem VARCHAR(500) NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabela de pedidos
CREATE TABLE pedidos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  nome VARCHAR(100) NOT NULL,
  telefone VARCHAR(12) NOT NULL,
  email VARCHAR(100) NOT NULL,
  metodo_pagamento VARCHAR(50) NOT NULL,
  endereco VARCHAR(500) NOT NULL,
  produtos_totais VARCHAR(1000) NOT NULL,
  preco_total INT NOT NULL,
  realizado_em VARCHAR(50) NOT NULL,
  status_pagamento VARCHAR(20) NOT NULL DEFAULT 'pending',
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);