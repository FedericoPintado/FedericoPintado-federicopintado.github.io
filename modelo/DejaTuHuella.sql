

USE DejaTuHuella_bd;


CREATE TABLE tarjeta (
    id INT (5) AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR (10) NOT NULL,
    enlace VARCHAR(100) NOT NULL,
    imagen BLOB,
    descripcion VARCHAR(50),
    categoria VARCHAR(10),
    fecha DATE,
    autor VARCHAR(10)
);


