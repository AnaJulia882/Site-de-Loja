-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema tcc
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tcc
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tcc` DEFAULT CHARACTER SET utf8mb4 ;
USE `tcc` ;

-- -----------------------------------------------------
-- Table `tcc`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`usuarios` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `tipo` ENUM('cliente', 'admin') NULL DEFAULT 'cliente',
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `email` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `tcc`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`categorias` (
  `id_categoria` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `tcc`.`produtos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`produtos` (
  `id_produto` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  `tamanho` VARCHAR(10) NULL DEFAULT NULL,
  `cor` VARCHAR(30) NULL DEFAULT NULL,
  `estoque` INT(11) NULL DEFAULT 0,
  `id_categoria` INT(11) NULL DEFAULT NULL,
  `imagem_url` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id_produto`),
  INDEX `id_categoria` (`id_categoria` ASC),
  CONSTRAINT `produtos_ibfk_1`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `tcc`.`categorias` (`id_categoria`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `tcc`.`carrinho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`carrinho` (
  `id_carrinho` INT(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(11) NULL DEFAULT NULL,
  `id_produto` INT(11) NULL DEFAULT NULL,
  `quantidade` INT(11) NULL DEFAULT 1,
  PRIMARY KEY (`id_carrinho`),
  INDEX `id_usuario` (`id_usuario` ASC),
  INDEX `id_produto` (`id_produto` ASC),
  CONSTRAINT `carrinho_ibfk_1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `tcc`.`usuarios` (`id_usuario`),
  CONSTRAINT `carrinho_ibfk_2`
    FOREIGN KEY (`id_produto`)
    REFERENCES `tcc`.`produtos` (`id_produto`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `tcc`.`pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`pedidos` (
  `id_pedido` INT(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(11) NULL DEFAULT NULL,
  `data_pedido` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  `status` VARCHAR(30) NULL DEFAULT 'Pendente',
  `total` DECIMAL(10,2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  INDEX `id_usuario` (`id_usuario` ASC),
  CONSTRAINT `pedidos_ibfk_1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `tcc`.`usuarios` (`id_usuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
