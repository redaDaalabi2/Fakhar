CREATE DATABASE IF NOT EXISTS Fakhar;

use Fakhar;

-- DROP TABLE Utilisateurs;
CREATE TABLE IF NOT EXISTS Utilisateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(55),
    motdepasse VARCHAR(60),
    token varchar(255),
    role VARCHAR(12)
);

-- DROP TABLE Admin ;
CREATE TABLE IF NOT EXISTS Admin (
    id_Admin INT PRIMARY KEY,
    nom VARCHAR(55),
    prenom VARCHAR(55),
    FOREIGN KEY(id_Admin) REFERENCES Utilisateurs(id)
);

-- DROP TABLE Clients;
CREATE TABLE IF NOT EXISTS Clients (
    id_Client INT PRIMARY KEY,
    nom VARCHAR(55),
    prenom VARCHAR(55),
    genre VARCHAR(55),
    Telephone VARCHAR (13),
    adresse VARCHAR (255),
    FOREIGN KEY (id_Client) REFERENCES Utilisateurs(id)
);

-- DROP TABLE Categories;
CREATE TABLE IF NOT EXISTS Categories (
    id_Cate INT PRIMARY KEY AUTO_INCREMENT,
    nom_cate VARCHAR(55)
);

-- DROP TABLE Produits;
CREATE TABLE IF NOT EXISTS Produits(
    id_produit INT PRIMARY KEY AUTO_INCREMENT,
    Cate_Id INT,
    nom VARCHAR(255),
    quantite INT,
    prix INT(4),
    descreption TEXT,
    image VARCHAR(55),
    FOREIGN KEY (Cate_Id) REFERENCES Categories(id_Cate)ON UPDATE CASCADE ON DELETE CASCADE

);

-- DROP TABLE Commandes;
CREATE TABLE IF NOT EXISTS Commandes(
    id_com INT PRIMARY KEY AUTO_INCREMENT,
    Client_Id INT,
    date DATE,
    statut VARCHAR(55),
    prix_totale INT(4),
    FOREIGN KEY (Client_Id) REFERENCES Clients(id_Client) ON UPDATE CASCADE ON DELETE CASCADE
);

-- DROP TABLE linecmd;
CREATE TABLE IF NOT EXISTS linecmd(
    id_linecmd INT PRIMARY KEY AUTO_INCREMENT,
    com_Id INT,
    produit_Id INT,
    quantite INT(4),
    prix_totale INT(4),
    FOREIGN key (com_Id) REFERENCES Commandes(id_com)ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (produit_Id) REFERENCES Produits(id_produit)ON UPDATE CASCADE ON DELETE CASCADE
);

-- DROP TABLE Contact;
CREATE TABLE IF NOT EXISTS Contact(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(55),
    prenom VARCHAR(55),
    email VARCHAR(55),
    telephone VARCHAR (13),
    message TEXT
);
