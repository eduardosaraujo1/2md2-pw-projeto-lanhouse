DROP SCHEMA IF EXISTS `bd_empresa`;

CREATE SCHEMA IF NOT EXISTS `bd_empresa`;

USE `bd_empresa`;

CREATE TABLE
    IF NOT EXISTS `bd_empresa`.`tb_cliente` (
        `id_cliente` INT NOT NULL AUTO_INCREMENT,
        `nm_cliente` VARCHAR(30) NOT NULL,
        `nm_sobrenome` VARCHAR(30) NOT NULL,
        `nm_email` VARCHAR(100) NOT NULL,
        `nr_telefone` VARCHAR(11) NOT NULL,
        `nm_endereco` VARCHAR(100) NOT NULL,
        PRIMARY KEY (`id_cliente`)
    );

CREATE TABLE
    IF NOT EXISTS `bd_empresa`.`tb_fornecedor` (
        `id_fornecedor` INT NOT NULL AUTO_INCREMENT,
        `nm_fornecedor` VARCHAR(50) NOT NULL,
        `nm_contato` VARCHAR(30) NOT NULL,
        `nm_email` VARCHAR(50) NOT NULL,
        `nr_telefone` VARCHAR(11) NOT NULL,
        `nm_endereco` VARCHAR(100) NOT NULL,
        PRIMARY KEY (`id_fornecedor`)
    );

CREATE TABLE
    IF NOT EXISTS `bd_empresa`.`tb_funcionario` (
        `id_funcionario` INT NOT NULL AUTO_INCREMENT,
        `nm_funcionario` VARCHAR(30) NOT NULL,
        `nm_sobrenome` VARCHAR(30) NOT NULL,
        `dt_nascimento` DATE NOT NULL,
        `nm_cargo` VARCHAR(30) NOT NULL,
        `nr_salario` DECIMAL(7, 2) NOT NULL,
        `dt_admissao` DATE NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `nm_senha` TEXT NOT NULL,
        PRIMARY KEY (`id_funcionario`)
    );

CREATE TABLE
    IF NOT EXISTS `bd_empresa`.`tb_categoria` (
        `id_categoria` INT NOT NULL AUTO_INCREMENT,
        `nome` VARCHAR(50) NOT NULL,
        `descricao` VARCHAR(120) NULL,
        PRIMARY KEY (`id_categoria`)
    );

CREATE TABLE
    IF NOT EXISTS `bd_empresa`.`tb_lancamento` (
        `id_lancamento` INT NOT NULL AUTO_INCREMENT,
        `valor` DECIMAL(8, 2) NOT NULL,
        `tipo` TINYINT NOT NULL,
        `data_lancamento` DATE NOT NULL,
        `descricao` VARCHAR(300) NULL,
        `fk_id_categoria` INT NOT NULL,
        `fk_id_funcionario` INT NOT NULL,
        PRIMARY KEY (`id_lancamento`),
        FOREIGN KEY (`fk_id_funcionario`) REFERENCES `bd_empresa`.`tb_funcionario` (`id_funcionario`),
        FOREIGN KEY (`fk_id_categoria`) REFERENCES `bd_empresa`.`tb_categoria` (`id_categoria`)
    );