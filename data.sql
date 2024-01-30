-- MODULE
    insert into module(type) values ('Ressource Humaine'),
                                    ('Secretariat');

-- DIPLOME
    insert into diplome(type) values ('BEPC'),
                                    ('BACC'),
                                    ('LICENCE'),
                                    ('MASTER'),
                                    ('DOCTORAT');

-- NATIONALITE
    insert into Nationalite(type) values    ('Americain'),
                                            ('Bresilien'),
                                            ('Chilien'),
                                            ('Chinois'),
                                            ('Coreen'),
                                            ('Cubain'),
                                            ('Danois'),
                                            ('Espagnol'),
                                            ('Francais'),
                                            ('Grecque'),
                                            ('Hongrois'),
                                            ('Indien'),
                                            ('Italien'),
                                            ('Malagasy'),
                                            ('Mexicain'),
                                            ('Norvegien'),
                                            ('Portugais'),
                                            ('Quebecois'),
                                            ('Roumain'),
                                            ('Russe'),
                                            ('Suedois');

-- SITUATION MATRIMONIALE
    insert into Situation_Matrimoniale(type) values ('Celibataire'),
                                                    ('Fiance(e)'),
                                                    ('Marie(e)'),
                                                    ('Divorce(e)'),
                                                    ('Veuf(ve)');

-- REGION
    insert into Region(type) values ('Itasy'),
                                                    ('Analamanga'),
                                                    ('Vakinankaratra'),
                                                    ('Bongolava'),
                                                    ('Diana'),
                                                    ('Sava'),
                                                    ('Amoron i Mania'),
                                                    ('Haute Matsiatra'),
                                                    ('Vatovavy-Fitovinany'),
                                                    ('Atsimo-Atsinanana'),
                                                    ('Ihorombe'),
                                                    ('Sofia'),
                                                    ('Boeny'),
                                                    ('Bestiboka'),
                                                    ('Melaky'),
                                                    ('Alaotra-Mangoro'),
                                                    ('Atsinanana'),
                                                    ('Analanjirofo'),
                                                    ('Menabe'),
                                                    ('Atsimo-Andrefana'),
                                                    ('Androy'),
                                                    ('Anosy');

insert into Ville(idRegion,type) values    (1,'Ampefy'),
                                            (1,'Miarinarivo'),
                                            (1,'Arivonimamo'),
                                            (2,'Tananarivo'),
                                            (2,'Anjozorobe'),
                                            (2,'Talatamaty'),
                                            (2,'Ambohidratrimo'),
                                            (2,'Alasora'),
                                            (3,'Betafo'),
                                            (3,'Faratsiho'),
                                            (3,'Mandoto'),
                                            (3,'Ampitatafika'),
                                            (4,'Tsiroanomandidy'),
                                            (4,'Fenoarivo'),
                                            (4,'Ambatolampy'),
                                            (4,'Alaotra-Mangoro'),
                                            (5,'Atsiranana'),
                                            (5,'Ambilobe'),
                                            (5,'Antsalaka'),
                                            (6,'Sambava'),
                                            (6,'Marovato'),
                                            (7,'Ambositra'),
                                            (7,'Sandradahy');

insert into type_contrat(nom, acronyme) values  ('Le contrat de travail à durée indéterminée ','CDI'),
                                                ('Le contrat de chantier ou d opération ','CCO'),
                                                ('Le contrat à durée déterminée  ','CDD'),
                                                ('Le CDD à objet défini ','CDDO'),
                                                ('Le CDD senior ','CDDS'),
                                                ('Le contrat de travail temporaire ','CTT'),
                                                ('Le contrat de travail à temps partiel ','CTTP'),
                                                ('Le travail intermittent  ','TI'),
                                                ('Le contrat saisonnier  ','CS'),
                                                ('Le contrat vendanges  ','CV'),
                                                ('Le titre emploi-service entreprise','TESE');


insert into type_conge(nom,politique,commentaires,day_default) values   ('Conge Maternite','conge accordee aux femmes','Pas de politique',30),
                                                                        ('Congé de paternité et accueil de l enfant','Pour les peres','Pas de commentaire',3),
                                                                        ('Congé en cas d hospitalisation immédiate de l enfant après sa naissance','Pour tous','Pas de commentaire',0),
                                                                        ('Congé d adoption','Pour ceux qui veulent adopter un enfant','Pas de commentaire',0),
                                                                        ('Mariage ou Pacs','Pour son propre mariage','Besoin de preuve',0),
                                                                        ('Mariage de son enfant','Son propre enfant ou celui que vous prenez pour enfant','Pas de commentaire',0),
                                                                        ('Décès d un membre de sa famille','En cas de décès','Pas de commentaire',0),
                                                                        ('Autres','Autres type de conge0','Pas de commentaire',0);

insert into module(type) values ('Securite');

 id | id_employer |        date         | etat | jour_nuit | securite
----+-------------+---------------------+------+-----------+----------
  1 | EMP0000001  | 2023-10-01 08:06:00 |   50 |        25 |       10

insert into pointage(id_employer, date, etat, securite) values  
('EMP0000001', '2023-10-03 08:06:00', 50, 10),
('EMP0000002', '2023-10-03', 50, 10),
('EMP0000003', '2023-10-03', 50, 10),

('EMP0000001', '2023-10-04', 50, 10),
('EMP0000002', '2023-10-04', 50, 10),
('EMP0000003', '2023-10-04', 50, 10),

('EMP0000001', '2023-10-05', 50, 10),
('EMP0000002', '2023-10-05', 50, 10),
('EMP0000003', '2023-10-05', 50, 10),

('EMP0000001', '2023-10-06', 50, 10),
('EMP0000002', '2023-10-06', 50, 10),
('EMP0000003', '2023-10-06', 50, 10),

('EMP0000002', '2023-10-07', 50, 10),

('EMP0000001', '2023-10-09', 50, 10),
('EMP0000002', '2023-10-09', 50, 10),
('EMP0000003', '2023-10-09', 50, 10),

('EMP0000001', '2023-10-10', 50, 10),
('EMP0000002', '2023-10-10', 50, 10),
('EMP0000003', '2023-10-10', 50, 10),

('EMP0000001', '2023-10-11', 50, 10),
('EMP0000002', '2023-10-11', 50, 10),
('EMP0000003', '2023-10-11', 50, 10),

('EMP0000001', '2023-10-12', 50, 10),
('EMP0000002', '2023-10-12', 50, 10),
('EMP0000003', '2023-10-12', 50, 10),

('EMP0000001', '2023-10-13', 50, 10),
('EMP0000002', '2023-10-13', 50, 10),
('EMP0000003', '2023-10-13', 50, 10),

('EMP0000003', '2023-10-14', 50, 10),

('EMP0000001', '2023-10-16', 50, 10),
('EMP0000002', '2023-10-16', 50, 10),
('EMP0000003', '2023-10-16', 50, 10),

('EMP0000002', '2023-10-17', 50, 10),
('EMP0000003', '2023-10-17', 50, 10),

('EMP0000001', '2023-10-18', 50, 10),
('EMP0000002', '2023-10-18', 50, 10),
('EMP0000003', '2023-10-18', 50, 10),

('EMP0000001', '2023-10-19', 50, 10),
('EMP0000002', '2023-10-19', 50, 10),
('EMP0000003', '2023-10-19', 50, 10),

('EMP0000001', '2023-10-20', 50, 10),
('EMP0000002', '2023-10-20', 50, 10),
('EMP0000003', '2023-10-20', 50, 10),

('EMP0000001', '2023-10-23', 50, 10),
('EMP0000002', '2023-10-23', 50, 10),

('EMP0000001', '2023-10-24', 50, 10),
('EMP0000002', '2023-10-24', 50, 10),

('EMP0000001', '2023-10-25', 50, 10),
('EMP0000002', '2023-10-25', 50, 10),

('EMP0000001', '2023-10-26', 50, 10),
('EMP0000003', '2023-10-26', 50, 10),

('EMP0000001', '2023-10-27', 50, 10),
('EMP0000002', '2023-10-27', 50, 10),
('EMP0000003', '2023-10-27', 50, 10),

('EMP0000003', '2023-10-28', 50, 10),

('EMP0000001', '2023-10-30', 50, 10),
('EMP0000002', '2023-10-30', 50, 10),
('EMP0000003', '2023-10-30', 50, 10),

('EMP0000001', '2023-10-31', 50, 10),
('EMP0000002', '2023-10-31', 50, 10);


insert into impot VALUES    (default,0,1000000,0),
                            (default,1000000,3000000,2),
                            (default,3000000,10000000,5),
                            (default,10000000,15000000,6),
                            (default,15000000,20000000,8);


insert into module(type) values ('Informatique'), ('Finance'), ('Achat');

insert into fournisseur(nom, email, adresse, telephone, responsable) values
('Boum', 'boum@gmail.com', 'TH 203 Alasora', 0343945881, 'Mr RANDRIAMIANTA Tiavina'),
('TEKO', 'teko@gmail.com', 'AN 698 Anosy Avaratra', 0336987451, 'Mme FELAMANITRA Olive'),
('Poufy', 'poufy@gmail.com', 'H 963 Analakely', 0326548917, 'Mr RAKOTOMALALA Niriko');

insert into Article values
('G0001', 'Gel main'),
('S0001', 'Savon'),
('P0001', 'Papier A4'),
('E0001', 'Encre');

insert into employer_module (idModule, idEmploye) values
(6, 'EMP0000001'),
(6, 'EMP0000002'),
(6, 'EMP0000003');

insert into etats values
(25, 'Refuse'),
(28, 'Non Valide'),
(32, 'Valide'),
(35, 'Valide RH'),
(37, 'Valide Finance'),
(40, 'En Attende'),
(45, 'Termine');


insert into type_sortie values
(1, 'Departement'),
(2, 'Vente');

insert into etats values
(50, 'Recu et Confirme');

insert into module(type) values ('Immobilier');

insert into etat_immobilisation values  (default, 'Neuf'),
                                        (default, 'Occasion'),
                                        (default, 'Inutilisable'),
                                        (default, 'Utilisable');

    insert into type_ammortissement values  (1, 'Ammortissement Lineaire'),
                                            (10, 'Ammortissement Degressif');
create view detail_pv_rec as 
select pv_reception.* , c.nom as article from pv_reception join compte as c on pv_reception.id_article = c.id;

create sequence seq_Pv_Utilisation
start with 1
increment by 1;

create sequence seq_Inventaire
start with 1
increment by 1;

CREATE TABLE Immobilisation_reception(
    id_immobilisation VARCHAR(10) PRIMARY KEY,
    id_pv_reception VARCHAR(10),
    id_etat_immobilisation INT,
    foreign key (id_pv_reception) references pv_reception(id),
    foreign key (id_etat_immobilisation) references etat_immobilisation(id)
);

insert into immobilisation_reception values
('I_R0001','PR00000009',4),
('I_R0002','PR00000010',1),
('I_R0003','PR00000010',1),
('I_R0004','PR00000010',1),
('I_R0005','PR00000010',1);

create table pv_utilisation(
    id varchar(10) primary key,
    reception varchar(10) REFERENCES pv_reception(id),
    module int REFERENCES module(id),
    date date
);

create sequence seq_Details_utilisation
start with 1
increment by 1;

create table details_utilisation(
    idDU varchar(10) default 'DU' || LPAD(nextval('seq_Details_utilisation')::text, 5, '0') not null primary key,
    pv_utilisation varchar(10) references pv_utilisation(id),
    immobilisation varchar(10) references immobilisation_reception(id_immobilisation),
    description varchar(60),
    etat_immobilisation int references etat_immobilisation(id),
    etat int default 40
);

create table inventaire(
    id varchar(10) default 'IV' || LPAD(nextval('seq_Inventaire')::text, 5, '0') not null primary key,
    date date,
    immobilisation varchar(10) references immobilisation_reception(id_immobilisation),
    etat_immobilisation int references etat_immobilisation(id),
    taux int,
    ammortissement int references type_ammortissement(id),
    type_inventaire varchar(60),
    libeller varchar(60),
    description varchar(50)
);

create view view_pv_utilisation_valider as 
select pv_utilisation.* , details_utilisation.* from pv_utilisation
join details_utilisation on pv_utilisation.id = details_utilisation.pv_utilisation;

create view view_detail_utilisation as
select view_pv_utilisation_valider.* , module.type, etat_immobilisation.nom as type_etat from
view_pv_utilisation_valider join module on view_pv_utilisation_valider.module = module.id
join etat_immobilisation on view_pv_utilisation_valider.etat_immobilisation = etat_immobilisation.id ;