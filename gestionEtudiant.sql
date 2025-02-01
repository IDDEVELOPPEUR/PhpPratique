create database gestionEtudiant;
use gestionEtudiant;
create table personne( idPersonne int auto_increment, 
    prenom varchar(50),
    nom varchar(30 ),
    adresse varchar(30),
    telephone int,
    email varchar(100), 
     profil varchar(30), 
    constraint PK_Personne primary key(idPersonne)) ;

create table compte(login varchar(50),
    motPasse varchar(100),
    idPersonne int ,
    constraint PK_Compte primary key(login),
    constraint PK_Personne foreign key(idPersonne) references personne(idPersonne) on delete cascade );
    
CREATE TABLE categorie (  
    codeCat INT,
    nomCat VARCHAR(30),
    CONSTRAINT PK_Categorie PRIMARY KEY (codeCat)
);

CREATE TABLE produit (  
    codeProd INT,  
    nom VARCHAR(30),  
    quantite INT,
    prix int,
    dateFab DATE,  
    dateExp DATE,
    codeCat int,
    CONSTRAINT PK_Produit PRIMARY KEY (codeProd),  
    CONSTRAINT FK_Categorie FOREIGN KEY(codeCat) REFERENCES categorie(codeCat) ON DELETE CASCADE  
);   
    
    
    select count(*) from personne;
        select * from personne;


show tables;
alter table etudiant rename to personne;
alter table compte change idEtudiant idPersonne int;
alter table personne change idEtudiant idPersonne int;
drop table compte;
drop	 table produit;
desc personne;
desc compte;
desc categorie;
show tables;
update categorie set nomCat="vetements" where codeCat=100;

select * from personne ;
select * from compte ;
 
select * from categorie;