
DROP DATABASE IF EXISTS gestion_notes;
CREATE DATABASE IF NOT EXISTS gestion_notes;


USE gestion_notes;

CREATE TABLE etudiants(
	etudiant_id int(10) auto_increment primary key,
	etudiant_login varchar(50),
	etudiant_pwd varchar(50),
	etudiant_nom varchar(50),
	etudiant_prenom varchar(50),
	etudiant_cin varchar(50),
	etudiant_cne varchar(50),
	etudiant_filiere int(10),
	etudiant_date_naissance varchar(50),
	etudiant_email varchar(50)

);

CREATE TABLE reclamations (
	reclamation_id int(10) auto_increment primary key,
	etudiant_id int(10),
	element_id int(10)

);


CREATE TABLE professeurs(
	professeur_id int(10) auto_increment primary key,
	professeur_login varchar(50),
	professeur_pwd varchar(50),
	professeur_nom varchar(50),
	professeur_prenom varchar(50),
	professeur_email varchar(50),
	professeur_tel varchar(50),
	professeur_departement varchar(50)
);

CREATE TABLE administrateurs(
	admin_id int(10) auto_increment primary key,
	admin_login varchar(50),
	admin_pwd varchar(50),
	admin_nom varchar(50),
	admin_prenom varchar(50),
	admin_email varchar(50),
	admin_tel varchar(50)
);


CREATE TABLE modules(
	module_id int(10) auto_increment primary key,
	module_nom varchar(50)
);

CREATE TABLE elements(
	element_id int(10) auto_increment primary key,
	element_nom varchar(50),
	id_module int(10),
	id_professeur int(10)
);

CREATE TABLE notes(
	note_id int(10) auto_increment primary key,
	note_avant_ratt float(10),
	note_apres_ratt float(10),
	id_etudiant int(10),
	id_element int(10)
);

CREATE TABLE filieres(
	filiere_id int(10) auto_increment primary key,
	filiere_nom varchar(50)
);



ALTER TABLE etudiants ADD CONSTRAINT fk10 FOREIGN KEY (etudiant_filiere) references filieres(filiere_id);
ALTER TABLE notes ADD CONSTRAINT fk11 FOREIGN KEY (id_etudiant) references etudiants(etudiant_id);
ALTER TABLE notes ADD CONSTRAINT fk12 FOREIGN KEY (id_element) references elements(element_id);
ALTER TABLE elements ADD CONSTRAINT fk13 FOREIGN KEY (id_module) references modules(module_id);
ALTER TABLE elements ADD CONSTRAINT fk14 FOREIGN KEY (id_professeur) references professeurs(professeur_id);



INSERT INTO professeurs VALUES 
(null, 'hanane.elbakkali', '123456', 'El Bakkali', 'Hanane','h.elbakkali@um5s.net.ma', '+212648795313','Reseaux de Communication'),
(null,'driss.bouzidi','123456','Bouzidi','Driss','bdbouzidi4@fmail.com','+212697854632','Reseaux de Communication'),
(null, 'amine.berqia', '123456', 'Berqia', 'Amine','berqia@gmail.com', '+212684765513','Reseaux de Communication'),
(null, 'abdellatif.elfaker', '1234', 'El Faker', 'Abdellatif','abdel.elfaker@gmail.com', '+212612395313','Genie Logiciel'),
(null, 'rachida.ajhoun', '123456', 'Ajhoun', 'Rachida','ajhoun@gmail.com', '+212648723313','Reseaux de Communication');


INSERT INTO etudiants VALUES
(null, 'mouna.hissane', '123456', 'Hissane', 'Mouna', 'J530539', 'D143034434', 1, '24/06/1998', 'mounahissane90@gmail.com'),
(null, 'hamza.elguechati', '123456', 'El Guechati', 'Hamza', 'S779603', '16798523', 1, '08/08/1998', 'Hamza.elguechati@um5s.net.ma'),
(null, 'hanaa.aitouarghazi', '1234', 'Hanaa', 'Ait Ouargazi', 'EE821502', '16986532', 2, '10/10/1998', 'hanaaaitouarghazi@gmail.com'),
(null, 'chadi.jbara', '12345', 'Jbara', 'Chadi', 'G719115', '16435297', 3, '06/12/1998', 'chadijbara@gmail.com');


INSERT INTO administrateurs VALUES 
(null,'admin.admin','123456', 'Admin','Admin','admin@gmail.com', '+212646798523');


INSERT INTO filieres VALUES 
(null, 'SSI'),
(null, 'GL'),
(null, 'ISEM'),
(null, 'IWIM'),
(null, 'Iel'),
(null, 'eMBI');


INSERT INTO modules VALUES
(null, 'M1.1 : Algorithmique et Programmation'),
(null, 'M1.2 : Structures de Données'),
(null, 'M1.3 : Electronique numérique et Circuits'),
(null, 'M1.4 : Architecture des ordinateurs et Microprocesseur'),
(null, 'M1.5 : Eléments de Recherche Opérationnelle'),
(null, 'M1.6 : Probabilités et statistiques'),
(null, 'M1.7 : Gestion, Economie et Finance 1'),
(null, 'M1.8 : Langues et communication'),
(null, 'M2.1 : Bases de données'),
(null, 'M2.2 : Informatique théorique'),
(null, 'M2.3 : Systèmes et réseaux 1'),
(null, 'M2.4 : Système d exploiatation'),
(null, 'M2.5 : Programmation Orientée Objet'),
(null, 'M2.7 : Projet de Fin d Annee'),
(null, 'M2.7 : Economie, gestion, finance 2'),
(null, 'M2.8 : Langues et communication2');


INSERT INTO elements VALUES

(null, 'M1.2.1 Structures de Données dynamiques', 2, 4),
(null, 'M2.2.3 Logique I', 'M2.2 : Informatique théorique', 2),
(null, 'M2.5.1 Paradigme Objet', 'M2.5 : Programmation Orientée Objet', 4),
(null, 'M2.5.2 Programmation Objet', 'M2.5 : Programmation Orientée Objet', 4),
(null, 'M2.7.1 : Projet de Fin d Annee', 'M2.7 : Projet de Fin d Annee', 6);
