CREATE DATABASE IF NOT EXISTS lfstock;
USE lfstock;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(50) UNIQUE NOT NULL,
  senha VARCHAR(255) NOT NULL
);

INSERT INTO usuarios (usuario, senha) VALUES ('user123','123');

CREATE TABLE produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  categoria VARCHAR(100) NOT NULL,
  quantidade INT NOT NULL,
  preco DECIMAL(10,2) NOT NULL,
  sku VARCHAR(100) NOT NULL,
  fornecedor VARCHAR(100) NOT NULL,
  descricao VARCHAR(200)
);


INSERT INTO produtos (nome, categoria, quantidade, preco, sku, fornecedor, descricao) VALUES
('Notebook Gamer', 'Eletrônicos', 15, 7500.00, 'NTBK-GM-001', 'TechSolutions Inc.', 'Notebook de alto desempenho para jogos, com processador de última geração e placa de vídeo dedicada.'),
('Smartphone Ultra', 'Eletrônicos', 50, 4200.50, 'SMART-ULTRA-002', 'Global Devices Co.', 'Celular com câmera de 108MP e tela OLED de 6.7 polegadas.'),
('Fone de Ouvido Bluetooth', 'Acessórios', 120, 150.80, 'FONE-BT-003', 'AudioMaster Corp.', 'Fone de ouvido sem fio, com bateria de longa duração e som estéreo de alta qualidade.'),
('Mouse Ergonômico', 'Periféricos', 200, 75.90, 'MOUSE-ERG-004', 'ErgoGear Ltd.', 'Mouse projetado para conforto, ideal para longas horas de uso.'),
('Teclado Mecânico RGB', 'Periféricos', 85, 350.00, 'TCL-MEC-RGB-005', 'KeyCrafters LLC', 'Teclado com switches mecânicos e iluminação RGB personalizável.'),
('Monitor Curvo 27"', 'Monitores', 30, 1899.99, 'MON-CURV-27-006', 'ViewSonic Inc.', 'Monitor com tela curva de 27 polegadas, ideal para imersão em jogos e filmes.'),
('Webcam Full HD', 'Periféricos', 95, 210.00, 'WEBCAM-FHD-007', 'StreamCam Co.', 'Webcam com resolução Full HD 1080p, microfone embutido e autofoco.');
