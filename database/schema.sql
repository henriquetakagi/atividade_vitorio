CREATE DATABASE IF NOT EXISTS sistema_pdv CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sistema_pdv;

CREATE TABLE IF NOT EXISTS clientes (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(120) NOT NULL,
 cpf VARCHAR(14) NULL UNIQUE,
 telefone VARCHAR(25) NULL,
 email VARCHAR(120) NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS produtos (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(120) NOT NULL,
 descricao TEXT NULL,
 preco DECIMAL(10,2) NOT NULL,
 estoque INT NOT NULL DEFAULT 0,
 ativo TINYINT(1) NOT NULL DEFAULT 1,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS vendas (
 id INT AUTO_INCREMENT PRIMARY KEY,
 cliente_id INT NULL,
 data_venda TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 total DECIMAL(10,2) NOT NULL,
 forma_pagamento VARCHAR(30) NOT NULL,
 FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS itens_venda (
 id INT AUTO_INCREMENT PRIMARY KEY,
 venda_id INT NOT NULL,
 produto_id INT NOT NULL,
 quantidade INT NOT NULL,
 preco_unitario DECIMAL(10,2) NOT NULL,
 subtotal DECIMAL(10,2) NOT NULL,
 FOREIGN KEY (venda_id) REFERENCES vendas(id) ON DELETE CASCADE,
 FOREIGN KEY (produto_id) REFERENCES produtos(id)
) ENGINE=InnoDB;

INSERT INTO produtos (nome, descricao, preco, estoque) VALUES
('Caderno universitário', 'Caderno 10 matérias', 24.90, 20),
('Caneta azul', 'Caneta esferográfica', 2.50, 100),
('Mouse USB', 'Mouse óptico', 39.90, 10);
