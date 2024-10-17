CREATE DATABASE robson_pinturas;
USE robson_pinturas;

CREATE TABLE usuarios (
    ID_Usuario INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    googleID VARCHAR(255) NOT NULL,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    fotoPerfil VARCHAR(255) DEFAULT NULL,
    criadoEm TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    isAdmin TINYINT(1) DEFAULT 0  -- Campo para controle de administrador
);

CREATE TABLE agendamentos (
    ID_Agendamento INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ID_Usuario INT(11) NOT NULL,
    googleEventID VARCHAR(255) DEFAULT NULL,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT DEFAULT NULL,
    localizacao VARCHAR(255) DEFAULT NULL,
    dataHoraInicio DATETIME NOT NULL,
    dataHoraFim DATETIME NOT NULL,
    criadoEm TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ID_Usuario) REFERENCES usuarios(ID_Usuario) ON DELETE CASCADE
);

CREATE TABLE catalogos (
    ID_Catalogo INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	cor VARCHAR(7) NOT NULL,
    nomeTinta VARCHAR(255) NOT NULL
);

CREATE TABLE empresa (
    ID_Empresa INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    historia VARCHAR(255) NOT NULL,
    missao VARCHAR(255) NOT NULL,
	visao VARCHAR(255) NOT NULL
);

CREATE TABLE blog (
    ID_Blog INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    conteudo TEXT NOT NULL,
    dataPublicacao DATETIME DEFAULT CURRENT_TIMESTAMP,
	autor VARCHAR(255) DEFAULT NULL
);

UPDATE usuarios SET isAdmin = 1 WHERE email = 'theircodes@gmail.com';

INSERT INTO catalogos (cor, nomeTinta) 
VALUES ('#FFCCE6', 'Vermelhos e Rosas'),
	   ('#', 'Laranjas');
	   ('#', 'Amarelos')
       ('#', 'Azuis');
	   ('#', 'Verdes');
	   ('#', 'Violetas');
	   ('#', 'Beges e Marrons');
	   ('#', 'Cinzas');
