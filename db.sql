DROP DATABASE IF EXISTS artlocator;
CREATE DATABASE artlocator CHARACTER SET utf8 COLLATE utf8_general_ci;
USE artlocator;


CREATE TABLE museums
(
    pk_museum_id INT PRIMARY KEY AUTO_INCREMENT,
    name         VARCHAR(255)
);

CREATE TABLE portraits
(
    pk_portrait_id  INT PRIMARY KEY AUTO_INCREMENT,
    name            VARCHAR(255),
    fk_pk_museum_id INT,
    FOREIGN KEY (fk_pk_museum_id) REFERENCES museums (pk_museum_id) ON DELETE SET NULL
);