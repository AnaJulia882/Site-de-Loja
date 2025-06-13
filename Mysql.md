CREATE DATABASE IF NOT EXISTS loja_db;
USE loja_db;

CREATE TABLE carrinho (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  id_produto INT NOT NULL,
  nome VARCHAR(100) NOT NULL,
  preco INT NOT NULL,
  quantidade INT NOT NULL,
  imagem VARCHAR(100) NOT NULL
);

INSERT INTO carrinho (id, id_usuario, id_produto, nome, preco, quantidade, imagem) VALUES
(129, 14, 16, 'rosa lavanda', 13, 1, 'lavendor rose.jpg'),
(130, 14, 18, 'tulipa vermelha', 11, 1, 'red tulipa.jpg'),
(131, 14, 15, 'rosa cottage', 15, 1, 'cottage rose.jpg'),
(132, 15, 13, 'rosa rosa', 10, 1, 'pink roses.jpg'),
(133, 15, 15, 'rosa cottage', 15, 1, 'cottage rose.jpg'),
(134, 15, 16, 'rosa lavanda', 13, 3, 'lavendor rose.jpg');

CREATE TABLE mensagem (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  telefone VARCHAR(12) NOT NULL,
  mensagem VARCHAR(500) NOT NULL
);

INSERT INTO mensagem (id, id_usuario, nome, email, telefone, mensagem) VALUES
(13, 14, 'shaikh anas', 'shaikh@gmail.com', '0987654321', 'oi, como você está?');

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
  data_pedido VARCHAR(50) NOT NULL,
  status_pagamento VARCHAR(20) NOT NULL DEFAULT 'pendente'
);

INSERT INTO pedidos (id, id_usuario, nome, telefone, email, metodo_pagamento, endereco, produtos_totais, preco_total, data_pedido, status_pagamento) VALUES
(17, 14, 'shaikh anas', '0987654321', 'shaikh@gmail.com', 'cartão de crédito', 'apto nº 321, jogeshwari, mumbai, índia - 654321', ', rosa cottage (3) , buquê rosa (1) , rosa rainha amarela (1) ', 80, '11-Mar-2022', 'pendente'),
(18, 14, 'shaikh anas', '1234567899', 'shaikh@gmail.com', 'paypal', 'apto nº 321, jogeshwari, mumbai, índia - 654321', ', rosa rainha amarela (1) , rosa rosa (2) ', 40, '11-Mar-2022', 'concluído');

CREATE TABLE produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  detalhes VARCHAR(500) NOT NULL,
  preco INT NOT NULL,
  imagem VARCHAR(100) NOT NULL
);

INSERT INTO produtos (id, nome, detalhes, preco, imagem) VALUES
(13, 'rosa rosa', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque error earum quasi facere optio tenetur.', 12, 'pink roses.jpg'),
(15, 'rosa cottage', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque error earum quasi facere optio tenetur.', 15, 'cottage rose.jpg'),
(16, 'rosa lavanda', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rem, nobis tenetur voluptatibus officiis odit minus fugit dolore accusantium fuga ipsa!', 13, 'lavendor rose.jpg'),
(17, 'tulipa amarela', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque error earum quasi facere optio tenetur.', 14, 'yellow tulipa.jpg'),
(18, 'tulipa vermelha', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rem, nobis tenetur voluptatibus officiis odit minus fugit dolore accusantium fuga ipsa!', 11, 'red tulipa.jpg'),
(19, 'buquê rosa', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque error earum quasi facere optio tenetur.', 15, 'pink bouquet.jpg'),
(20, 'rosa rainha rosa', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque error earum quasi facere optio tenetur.', 24, 'pink queen rose.jpg');

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  senha VARCHAR(100) NOT NULL,
  tipo_usuario VARCHAR(20) NOT NULL DEFAULT 'usuario'
);

INSERT INTO usuarios (id, nome, email, senha, tipo_usuario) VALUES
(10, 'admin A', 'admin01@gmail.com', '698d51a19d8a121ce581499d7b701668', 'admin'),
(14, 'usuario A', 'user01@gmail.com', '698d51a19d8a121ce581499d7b701668', 'usuario'),
(15, 'usuario B', 'user02@gmail.com', '698d51a19d8a121ce581499d7b701668', 'usuario');

CREATE TABLE lista_desejos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  id_produto INT NOT NULL,
  nome VARCHAR(100) NOT NULL,
  preco INT NOT NULL,
  imagem VARCHAR(100) NOT NULL
);

INSERT INTO lista_desejos (id, id_usuario, id_produto, nome, preco, imagem) VALUES
(60, 14, 19, 'buquê rosa', 15, 'pink bouquet.jpg');
