create database gestion_rh;
\c gestion_rh;

-- **************************************BACK-OFFICE************************************************

-- MODULE, SERVICE, POSTE, DIPLOME, NATIONALITE, SITUATION_MATRIMONIALE, REGION
create table Module (
    id serial primary key,
    type varchar(50)
);

create table Service (
    id serial primary key,
    type varchar(50)
);

create table Poste (
    id serial primary key,
    type varchar(50)
);

create table Diplome (
    id serial primary key,
    type varchar(50)
);

create table Nationalite (
    id serial primary key,
    type varchar(50)
);

create table Situation_Matrimoniale (
    id serial primary key,
    type varchar(50)
);

create table Region (
    id serial primary key,
    type varchar(50)
);

create table Ville (
    id serial primary key,
    idRegion int,
    type varchar(50),
    foreign key (idRegion) references Region(id)
);


-- AUTHENTIFICATION
create table Administrateur (
    id serial primary key,
    nom varchar(50),
    prenom varchar(150),
    email varchar(70),
    mot_de_passe varchar(12),
    idModule int,
    foreign key (idModule) references Module(id)
);

create table Client (
    id serial primary key,
    nom varchar(50),
    prenom varchar(150),
    email varchar(70),
    mot_de_passe varchar(12),
    date_naissance date,
    idGenre int
);

insert into Client (nom,prenom,email,mot_de_passe,date_naissance, idGenre) values
('ANDRIAMANANTSOA', 'Tojo', 'tojo@gmail.com', 'tojo', '2003-10-07', 1),
('RAKOTONIRIANA', 'Sandy', 'sandy@gmail.com', 'sandy', '1998-02-15', 2);

-- BESOIN
create table Besoin (
    id serial primary key,
    idPoste int,
    idService int,
    besoin_horaire time,
    heure_jour_homme time,
    foreign key (idPoste) references Poste(id),
    foreign key (idService) references Service(id)
);

ALTER TABLE besoin add column id_type_contrat INT;
ALTER TABLE besoin
ADD CONSTRAINT fk_type_contrat
FOREIGN KEY (id_type_contrat)
REFERENCES type_contrat(id);
-- DETAILS BESOIN
-- Details_Besoin_Genre, Details_Besoin_Age, Details_Besoin_Diplome, Details_Besoin_Experience, Details_Besoin_Matrimoniale
-- Details_Besoin_Salaire, Details_Besoin_Nationalite, Details_Besoin_Region, Details_Besoin_Ville

create table Details_Besoin_Genre(
    id serial primary key,
    idBesoin int,
    idGenre int,
    note double precision default 0,
    foreign key (idBesoin) references Besoin(id)
);

create table Details_Besoin_Age(
    id serial primary key,
    idBesoin int,
    min int,
    max int,
    note double precision default 0,
    foreign key (idBesoin) references Besoin(id)
);

create table Details_Besoin_Diplome(
    id serial primary key,
    idBesoin int,
    idDiplome int,
    note double precision default 0,
    foreign key (idBesoin) references Besoin(id),
    foreign key (idDiplome) references Diplome(id)
);

create table Details_Besoin_Experience(
    id serial primary key,
    idBesoin int,
    annee_experience int,
    note double precision default 0,
    foreign key (idBesoin) references Besoin(id)
);

create table Details_Besoin_Matrimoniale(
    id serial primary key,
    idBesoin int,
    idMatrimoniale int,
    note double precision default 0,
    foreign key (idBesoin) references Besoin(id),
    foreign key (idMatrimoniale) references Situation_Matrimoniale(id)
);

create table Details_Besoin_Salaire(
    id serial primary key,
    idBesoin int,
    min double precision default 0,
    max double precision default 0,
    note double precision default 0,
    foreign key (idBesoin) references Besoin(id)
);

create table Details_Besoin_Nationalite(
    id serial primary key,
    idBesoin int,
    idNationalite int,
    note double precision default 0,
    foreign key (idBesoin) references Besoin(id),
    foreign key (idNationalite) references Nationalite(id)
);

create table Details_Besoin_Region(
    id serial primary key,
    idBesoin int,
    idRegion int,
    note double precision default 0,
    foreign key (idBesoin) references Besoin(id),
    foreign key (idRegion) references Region(id)
);

create table Details_Besoin_Ville(
    id serial primary key,
    idBesoin int,
    idVille int,
    note double precision default 0,
    foreign key (idBesoin) references Besoin(id),
    foreign key (idVille) references Ville(id)
);


-- ALTER:
ALTER TABLE Besoin DROP COLUMN besoin_horaire;
ALTER TABLE Besoin DROP COLUMN heure_jour_homme;
ALTER TABLE besoin ADD COLUMN besoin_horaire DOUBLE PRECISION;
ALTER TABLE besoin ADD COLUMN heure_jour_homme DOUBLE PRECISION;
ALTER TABLE besoin ADD COLUMN description VARCHAR(150);

-- fb0 amdi-calendar-import

-- **************************************FRONT-OFFICE************************************************

-- CV ----------------------tsy vita
    create table cv(
        id serial primary key,
        idClient int,
        idBesoin int,
        idDiplome int,
        experiences int,
        idMatrimoniale int,
        idVille int,
        foreign key (idClient) references Client(id),
        foreign key (idBesoin) references Besoin(id),
        foreign key (idDiplome) references Diplome(id),
        foreign key (idMatrimoniale) references Situation_Matrimoniale(id),
        foreign key (idVille) references Ville(id)
    );

-- DETAILS CV
-- Details_Cv_Salaire, Details_Cv_Diplome, Details_Cv_Travail_Anterieur

create table Details_Cv_Salaire(
    id serial primary key,
    idCv int,
    min double precision default 0,
    max double precision default 0,
    foreign key (idCv) references Cv(id)
);

create table Details_Cv_Diplome(
    id serial primary key,
    idCv int,
    nom_pdf varchar(150),
    foreign key (idCv) references Cv(id)
);

create table Details_Cv_Travail_Anterieur(
    id serial primary key,
    idCv int,
    nom_pdf varchar(150),
    foreign key (idCv) references Cv(id)
);

-- NOTE CV
create table Note_Cv(
    id serial primary key,
    idCv int,
    note double precision default 0,
    foreign key (idCv) references Cv(id),
);

create table qcm_admis(
    id_qcm serial primary key,
    titre varchar(200) not null,
    description varchar(200) not null,
    durer int not null,
    note_total int not null,
);

alter table qcm_admis add COLUMN id_annonce int not null;
alter table qcm_admis add  foreign key (id_annonce) references Besoin(id);

-- insert into qcm_admis(id_qcm, titre, description, durer, note_total, id_annonce, id_cv) values
-- (1, 'xd', 'xd', 1, 13, 1, 2),
-- (2, 'xd', 'xd', 1, 12, 1, 3),
-- (3, 'xd', 'xd', 1, 150, 1, 4);

-- alter table qcm_admis drop COLUMN id_cv;


create table question_posée(
    id_q serial primary key,
    questions varchar(200) not null,
    note int not null,
    id_qcm int not null,
    foreign key (id_qcm) references qcm_admis(id_qcm)
);
alter table question_posée drop column note;
alter table question_posée add COLUMN note int default 5;
--ALTER TABLE question_posée RENAME TO question_posee;

create table reponse_q(
    id_r serial primary key,
    id_question int not null,
    reponse varchar(200) not null,
    foreign key (id_question) references question_posée(id_q)
);
alter table reponse_q add COLUMN note int default 0;

create table reponse_faux(
    id_f serial primary key,
    id_q int not null,
    reponse_f varchar(200) not null,
    foreign key (id_q) references question_posée(id_q)
);
alter table reponse_faux add COLUMN note int default 0;


create table qcm_result(
    id_r serial primary key,
    qcm int not null,
    notes_r int not null,
    foreign key (qcm) references qcm_admis(id_qcm)
);
alter table qcm_result drop COLUMN notes_r ;
alter table qcm_result add COLUMN notes_r int default 0 ;

-- insert into qcm_result (id_r, qcm, notes_r) values 
-- (1, 1, 15),
-- (2, 2, 16),
-- (3, 3, 12);

--entretient
create table afaka_qcm (
    id_as serial primary key,
    qcm_r int not null,
    id_users int not null,
    foreign key (qcm_r) references qcm_result(id_r),
    foreign key (id_users) references Client(id)
);

insert into afaka_qcm (id_as, qcm_r, id_users) values
(1, 36, 1),
(2, 36, 2),
(3, 36, 4);

create table entretient(
    id_e serial primary key,
    aa int not null,
    dates date not null,
    heures int not null,
    lieu varchar(200) not null,
    foreign key (aa) references afaka_qcm(id_as)
);

insert into entretient (id_e, aa, dates, heures, lieu) values
(1, 1, '2023-10-10', 14, 'Mahabo'),
(2, 2, '2023-10-10', 15, 'Mahabo'),
(3, 3, '2023-10-11', 8, 'Mahabo');

--etat
create table etats(
    id_et serial primary key,
    nom_etats varchar(200) not null
);
insert into etats values (1, 'Pere'), (2, 'Mere'), (3, 'Conjoint'), (4, 'Enfant'), (12, 'Entretient Fini'), (15, 'Contrat essaie'), (20, 'Embauché'), (10, 'Debauché');
insert into etats values (7, 'Annuler'), (8, 'Valider');

create table ok_vita (
    id_o serial primary key,
    id_e int not null,
    id_et int not null,
    foreign key (id_e) references entretient(id_e),
    foreign key (id_et) references etats(id_et)
);

create table tafiditra_mpiasa(
    id_taf serial primary key,
    id_ok int not null,
    foreign key (id_ok) references ok_vita(id_o)
);

--liste employer
create table employer (
    id_emp varchar(200) primary key,
    idClient int,
    cin varchar(12) default NULL,
    telephone varchar(10) default NULL,
    adresse varchar(30) default NULL,
    etat int,
    foreign key (idClient) references Client(id),
    foreign key (etat) references Etats(id_et)
);

insert into employer (id_emp, idClient, etat) values ('EMP0000001', 1, 12);
insert into employer (id_emp, idClient, etat) values ('EMP0000002', 2, 12);
insert into employer (id_emp, idClient, etat) values ('EMP0000003', 4, 12);

create table historique_embauche (
    id serial,
    id_emp varchar(200),
    date date,
    etat int,
    foreign key (etat) references Etats(id_et),
    foreign key (id_emp) references Employer(id_emp)
);

insert into historique_embauche (id_emp, date, etat) values ('EMP0000001', '2023-10-10', 12);
insert into historique_embauche (id_emp, date, etat) values ('EMP0000002', '2023-10-10', 12);
insert into historique_embauche (id_emp, date, etat) values ('EMP0000003', '2023-10-11', 12);

create table salaire (
    id serial primary key,
    id_emp varchar(200),
    brut double precision default 0,
    net double precision default 0,
    date date,
    foreign key (id_emp) references Employer(id_emp)
);

insert into salaire (id_emp, brut, net, date) values ('EMP0000001', 2700000, 1600000, '2023-10-10');
insert into salaire (id_emp, brut, net, date) values ('EMP0000002', 2500000, 1400000, '2023-10-10');
insert into salaire (id_emp, brut, net, date) values ('EMP0000001', 3000000, 2400000, '2023-10-11');

-- Annexe
create table liste_Adresse_entreprise (
    id serial primary key,
    adresse varchar(200)
);
Alter table liste_Adresse_entreprise add date Date default Null;

insert into liste_Adresse_entreprise (adresse) values ('M 203 Mahabo Andoharanofotsy');
insert into liste_Adresse_entreprise (adresse) values ('Lot F-102 Fiadanamanga');

-- Contrat d'essaie
create table contrat_essaie (
    id serial primary key,
    id_emp varchar(200),
    lieu_travail int,
    date_debut date,
    date_fin date,
    obligation varchar(500),
    foreign key (id_emp) references Employer(id_emp),
    foreign key (lieu_travail) references liste_Adresse_entreprise(id)
);

-- ALTER TABLE contrat_essaie add obligation varchar(500);
ALTER TABLE contrat_essaie add superieur varchar(200);
Alter TABLE contrat_essaie add  foreign key (id_emp) references Employer(id_emp);

create table proche (
    id serial primary key,
    id_emp varchar(200),
    nom varchar(50),
    prenom varchar(50),
    dateDeNaissance date,
    idGenre varchar(50),
    etat int,
    foreign key (id_emp) references Employer(id_emp),
    foreign key (etat) references Etats(id_et)
);

-- Avanatge en nature
create table type_avantage_nature (
    id serial primary key,
    type varchar(50)
);

insert into type_avantage_nature (type) values ('Telephone'), ('Voiture'), ('Maison'), ('Secretaire');

create table avantage_nature (
    id serial,
    id_emp varchar(200),
    idAvantage int,
    date date,
    etat int,
    foreign key (id_emp) references Employer(id_emp),
    foreign key (etat) references Etats(id_et),
    foreign key (idAvantage) references type_avantage_nature(id)
);


-- Conge
create table type_conge(
    id serial primary key,
    Nom VARCHAR(150),
    politique VARCHAR(250),
    commentaires VARCHAR(250)
);

alter table type_conge add column day_default DOUBLE PRECISION;

create table conge(
    id SERIAL PRIMARY KEY,
    id_employer VARCHAR(100),
    id_type_conge INT,
    Raison VARCHAR(250),
    debut TIMESTAMP,
    fin TIMESTAMP,
    Statut INT, -- 1: en attente, 21: approuve, 41: refuse
    Justificatif VARCHAR(250),
    foreign key (id_employer) references employer(id_emp), 
    foreign key (id_type_conge) references type_conge(id)
);

create table confirmation_date(
    id SERIAL PRIMARY KEY,
    idconge INT,
    depart TIMESTAMP,
    retour TIMESTAMP,
    commentaires VARCHAR(100),
    foreign key (idconge) references conge(id)
);

create table solde_conge(
    id SERIAL PRIMARY KEY,
    idconge INT,
    conge_consomme DOUBLE PRECISION,
    solde_actuel DOUBLE PRECISION,
    foreign key (idconge) references conge(id)
);

create view conf_conge as 
select conge.*, conf_date.depart, conf_date.retour from conge left join confirmation_date as conf_date on conge.id = conf_date.idconge;


SELECT *,
       EXTRACT(MONTH FROM AGE(retour, depart)) AS monthsDifference
FROM conf_conge;
-- WHERE id_employer = 'your_employee_id';

create table type_contrat(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(250),
    Acronyme VARCHAR(50)
);

---CNAPS
CREATE SEQUENCE seqCnaps
    increment by 1
    start WITH 1
    minValue 1;

create function nextSeqCnaps() returns integer
AS
    $$
Declare
retour integer;
BEGIN
SELECT coalesce(nextval('seqCnaps'),1) into retour;
return retour;
END
$$ LANGUAGE plpgsql;

create table cnaps (
    id varchar(10) primary key,
    id_emp varchar(10),
    date date,
    etat int default 8,
    foreign key (id_emp) references Employer(id_emp),
    foreign key (etat) references Etats(id_et)
);

--pointage
create table pointage(
    id SERIAL PRIMARY KEY,
    id_employer VARCHAR(100),
    date TIMESTAMP,
    etat INT, -- 50 : arrive && 100 : sortie
    jour_nuit INT, -- 25 : jour && 55 : nuit
    securite INT,
    foreign key (id_employer) references employer(id_emp),
    foreign key (securite) references Administrateur(id)
);

--majoration heure sup de nuit 4 iany no tokony ho majoration
create table majoration_nuit ( 
    id serial,
    debut int,
    fin int,
    majoration double precision default 0,
    date Date
);
-- insert into majoration_nuit (debut, fin, majoration, date) values 
-- (0, 8, 50, '2023-09-01'),
-- (8, 15, 60, '2023-09-01'),
-- (15, 20, 70, '2023-09-01'),
-- (20, 1000, 100, '2023-09-01');

--prime
create table type_prime (
    id serial primary key,
    prime varchar(25)
);
-- insert into type_prime(prime) values ('Prime de Rendement'), ('Prime anciennete'), ('Prime divers');

create table prime (
    id serial,
    id_employe varchar(200),
    type int,
    montant double precision default 0,
    date date,
    foreign key (type) references type_prime(id),
    foreign key (id_employe) references employer(id_emp)
);
-- insert into prime (id_employe, type, montant, date) values 
-- ('EMP0000001', 1, 300000, '2023-10-31'),
-- ('EMP0000002', 1, 150000, '2023-10-31');

create table retenu_cnaps (
    id serial,
    plafond double precision default 0,
    date date
);
-- insert into retenu_cnaps (plafond, date) values (20000, '2023-01-01');

create table tranche_irsa (
    id serial,
    debut double precision default 0,
    fin double precision default 0,
    majoration double precision default 0,
    date date
);

-- insert into tranche_irsa (debut, fin, majoration, date) values
-- (1, 350000, 0, '2023-01-01'),
-- (350001, 400000, 5, '2023-01-01'),
-- (400001, 500000, 10, '2023-01-01'),
-- (500001, 600000, 15, '2023-01-01'),
-- (600001, 10000000000, 20, '2023-01-01');

---Employe
CREATE SEQUENCE seqEmploye
    increment by 1
    start WITH 1
    minValue 1;

create function nextSeqEmploye() returns integer
AS
    $$
Declare
retour integer;
BEGIN
SELECT coalesce(nextval('seqEmploye'),1) into retour;
return retour;
END
$$ LANGUAGE plpgsql;

--majoration heure sup de nuit 4 iany no tokony ho majoration
create table majoration_nuit ( 
    id serial,
    debut int,
    fin int,
    majoration double precision default 0,
    date Date
);
-- insert into majoration_nuit (debut, fin, majoration, date) values 
-- (0, 8, 50, '2023-09-01'),
-- (8, 15, 60, '2023-09-01'),
-- (15, 20, 70, '2023-09-01'),
-- (20, 1000, 100, '2023-09-01');

--prime
create table type_prime (
    id serial primary key,
    prime varchar(25)
);
-- insert into type_prime(prime) values ('Prime de Rendement'), ('Prime anciennete'), ('Prime divers');

create table prime (
    id serial,
    id_employe varchar(200),
    type int,
    montant double precision default 0,
    date date,
    foreign key (type) references type_prime(id),
    foreign key (id_employe) references employer(id_emp)
);
-- insert into prime (id_employe, type, montant, date) values 
-- ('EMP0000001', 1, 300000, '2023-10-31'),
-- ('EMP0000002', 1, 150000, '2023-10-31');

create table retenu_cnaps (
    id serial,
    plafond double precision default 0,
    date date
);
-- insert into retenu_cnaps (plafond, date) values (20000, '2023-01-01');

create table tranche_irsa (
    id serial,
    debut double precision default 0,
    fin double precision default 0,
    majoration double precision default 0,
    date date
);

-- insert into tranche_irsa (debut, fin, majoration, date) values
-- (1, 350000, 0, '2023-01-01'),
-- (350001, 400000, 5, '2023-01-01'),
-- (400001, 500000, 10, '2023-01-01'),
-- (500001, 600000, 15, '2023-01-01'),
-- (600001, 10000000000, 20, '2023-01-01');

---Employe
CREATE SEQUENCE seqEmploye
    increment by 1
    start WITH 1
    minValue 1;

create function nextSeqEmploye() returns integer
AS
    $$
Declare
retour integer;
BEGIN
SELECT coalesce(nextval('seqEmploye'),1) into retour;
return retour;
END
$$ LANGUAGE plpgsql;

--- IMPOT
create table impot(
    id Serial PRIMARY KEY,
    plafond_minimum DOUBLE PRECISION,
    plafond_maximum DOUBLE PRECISION,
    pourcentage DOUBLE PRECISION
);

create table avance(
    id Serial PRIMARY KEY,
    id_employe VARCHAR(200),
    avance DOUBLE PRECISION,
    date DATE,
    foreign key (id_employe) references employer(id_emp)
);

-- ACHAT
create table fournisseur (
    id SERIAL PRIMARY KEY,
    nom varchar(70),
    email varchar(150),
    adresse varchar(70),
    telephone varchar(20),
    responsable varchar(100)
);

create table article (
    id varchar(10) primary key,
    article varchar(50)
);

create table employer_module (
    id serial primary key,
    idModule int,
    idEmploye varchar(10),
    foreign key (idModule) references Module(id),
    foreign key (idEmploye) references Employer(id_emp)
);

create table besoin_achat (
    id serial primary key,
    idModule int,
    idArticle varchar(10),
    nombre int,
    date date,
    idDemande varchar(10) default NULL,
    etat int,
    foreign key (idModule) references Module(id),
    foreign key (idArticle) references Article(id),
    foreign key (etat) references Etats(id_et)
);

CREATE SEQUENCE seqDemande
increment by 1
start WITH 1
minValue 1;

create function nextSeqD(prefix text, taille integer) 
returns text AS
$$
    Declare
        nextId int;
        nextIdString text;
        id text;
        i integer;
    BEGIN
        SELECT coalesce(nextval('seqDemande'),1) into nextId;
        nextIdString := nextId::varchar;
        taille := taille - LENGTH(prefix) - LENGTH(nextIdString);
        id := prefix;
        FOR i IN 1..taille LOOP
            id := id || '0'; 
        END LOOP;
        id := id || nextIdString; 
        return id;
    END
$$ LANGUAGE plpgsql;

create table demande (
    id serial primary key,
    date date,
    nom varchar(200),
    idDemande varchar(10),
    idFournisseur int,
    etat int,
    foreign key (idFournisseur) references fournisseur(id)
);

create table proformat (
    id serial primary key,
    idDemande varchar(10),
    idFournisseur int,
    idArticle varchar(10),
    prixUnitaire double precision default 0,
    tva double precision default 0,
    date date,
    foreign key (idFournisseur) references fournisseur(id),
    foreign key (idArticle) references Article(id)
);

-- bon de commande
create table bon_commande (
    id varchar(10) primary key,
    date date,
    idPayement int,
    delaiLivarison double precision default 0,
    etat int,
    foreign key (etat) references Etats(id_et) 
);

create table details_bon_commande (
    id serial,
    idBonCommande varchar(10),
    idProformat int,
    etat int,
    foreign key (etat) references Etats(id_et),
    foreign key (idBonCommande) references bon_commande(id),
    foreign key (idProformat) references proformat(id)

);

CREATE SEQUENCE seqBonCommande
increment by 1
start WITH 1
minValue 1;

create or replace function nextID(sequence text, prefix text, taille integer) 
returns text AS
$$
    Declare
        nextId int;
        nextIdString text;
        id text;
        i integer;
    BEGIN
        SELECT coalesce(nextval(sequence),1) into nextId;
        nextIdString := nextId::varchar;
        taille := taille - LENGTH(prefix) - LENGTH(nextIdString);
        id := prefix;
        FOR i IN 1..taille LOOP
            id := id || '0'; 
        END LOOP;
        id := id || nextIdString; 
        return id;
    END
$$ LANGUAGE plpgsql;


--view liste_contrat_a_renouveler
create view liste_contrat_a_renouveler as
select id, ce.id_emp, lieu_travail, date_debut, date_fin , obligation, superieur, etat from contrat_essaie ce 
    join employer e on ce.id_emp = e.id_emp
    where etat = 15;

create view liste_afaka_qcm as 
select id_e, aa, dates, id_as, qcm_r, id_users from entretient e 
    join afaka_qcm aq on e.aa = aq.id_as;

create view liste_personnel as
    select * from employer where etat = 20;

create view liste_besoin_achat as
select idArticle, sum(nombre) nombre from besoin_achat where etat = 28 group by idArticle;

create view demande_proformat as
select iddemande from besoin_achat where etat = 32 group by idDemande;

create or replace view liste_demande as
select date, nom, idDemande, etat from demande group by date, nom, idDemande, etat;

create or replace view liste_demande_en_attente_proformat as
select l.* from demande_proformat d join liste_demande l on d.idDemande = l.idDemande where etat = 1;

create view liste_article_par_demande as
select idArticle, idDemande from besoin_achat group by idDemande, idArticle;

create view liste_prix_proformat_min as
SELECT idDemande, idArticle, MIN(prixunitaire) AS prix_minimum FROM proformat GROUP BY idDemande, idArticle; 

create view liste_meilleur_proformat as
SELECT
    id,
    f1.idDemande,
    f1.idFournisseur,
    f1.idArticle,
    f2.prix_minimum prixunitaire,
    f1.tva,
    date
FROM
    proformat f1
JOIN
    liste_prix_proformat_min f2 ON f1.idDemande = f2.idDemande
              AND f1.idArticle = f2.idArticle
              AND f1.prixunitaire = f2.prix_minimum;

-- modifier par haingo
create view liste_besoin_achat_avec_quantite as
select idDemande, idArticle, sum(nombre) nombre, idModule from besoin_achat group by idDemande, idArticle, idModule;

create view liste_besoin_achat_avec_quantite_etats as
select idDemande, idArticle, sum(nombre) nombre, idModule, etat from besoin_achat group by idDemande, idArticle, idModule,etat;
-- fini


create or replace view prix_minimum_proformat as
select distinct l.id, l.idDemande, l.idFournisseur, l.idArticle, nombre quantite, prixUnitaire, tva, (nombre*prixUnitaire) prixHT, (prixUnitaire*((tva+100)/100)*nombre) prixAT  
    from liste_meilleur_proformat l 
    join liste_besoin_achat_avec_quantite b on l.idDemande = b.idDemande and l.idArticle = b.idArticle;

create view liste_details_bon_de_commande as 
    select d.id idDetails, idboncommande, p.*
    from details_bon_commande d 
    join prix_minimum_proformat p on d.idproformat = p.id
    where etat = 8;

create view liste_bon_commande_en_attente as
select * from bon_commande where etat < 40;

create or replace view liste_bon_commande_en_cours as
select * from bon_commande where etat = 40;

create view liste_bon_commande_terminer as
select * from bon_commande where etat = 45;

CREATE SEQUENCE seqBonLivraison
increment by 1
start WITH 1
minValue 1;

CREATE SEQUENCE seqBonReception
increment by 1
start WITH 1
minValue 1;


create table bon_reception(
    id varchar(10) primary key,
    lieu VARCHAR(100),
    date DATE,
    id_bon_commande VARCHAR(10),
    id_recepteur VARCHAR(10),
    etat INT,
    foreign key (id_bon_commande) references bon_commande(id),
    foreign key (etat) references Etats(id_et)
);

create table details_bon_reception(
    id_bon_reception varchar(10),
    id_article VARCHAR(10),
    id_fournisseur int,
    date DATE,
    etat INT,
    foreign key (id_bon_reception) references bon_reception(id),
    foreign key (id_fournisseur) references fournisseur(id),
    foreign key (id_article) references Article(id),
    foreign key (etat) references Etats(id_et)
);

create view V_Details_Bon_Reception as
    select
        bon_reception.*,
        details_bon_reception.id_article,
        details_bon_reception.id_fournisseur
    from
        bon_reception
        JOIN details_bon_reception on bon_reception.id = details_bon_reception.id_bon_reception;

-- Modification de haingo
-- VIEW 
CREATE VIEW V_Details_Bon_Reception_details AS
    select 
    bon_reception.id,
    bon_reception.lieu,
    bon_reception.date as date_reception,
    bon_commande.date as date_commande,
    details_bon_commande.idproformat as proformat, 
    proformat.prixUnitaire as prixUnitaire, 
    proformat.idArticle as article, 
    article.article as nom_article,
    proformat.idFournisseur as fournisseur, 
    proformat.idDemande as demande,
    proformat.tva,
    liste_besoin_achat_avec_quantite.nombre as quantite_article ,
    module.id as id_module,
    module.type as module
from 
    bon_reception
    join bon_commande on bon_reception.id_bon_commande = bon_commande.id
    join details_bon_commande on bon_reception.id_bon_commande = details_bon_commande.idboncommande
    join proformat on details_bon_commande.idproformat = proformat.id
    join article on proformat.idArticle = article.id
    join liste_besoin_achat_avec_quantite on proformat.idDemande = liste_besoin_achat_avec_quantite.idDemande
    join module on liste_besoin_achat_avec_quantite.idModule = module.id
    where proformat.idArticle = liste_besoin_achat_avec_quantite.idArticle 
    and etats_demande = 45
;

CREATE VIEW details_bon AS 
SELECT DISTINCT
    bon_reception.id,
    bon_reception.lieu,
    bon_reception.date AS date_reception,
    bon_commande.date AS date_commande,
    details_bon_commande.idproformat AS proformat, 
    proformat.prixUnitaire AS prixUnitaire, 
    proformat.idArticle AS article, 
    article.article AS nom_article,
    proformat.idFournisseur AS fournisseur, 
    proformat.idDemande AS demande,
    liste_besoin_achat_avec_quantite_etats.etat,
    proformat.tva,
    liste_besoin_achat_avec_quantite_etats.nombre AS quantite_article,
    module.id AS id_module,
    module.type AS module
FROM 
    bon_reception
JOIN bon_commande ON bon_reception.id_bon_commande = bon_commande.id
JOIN details_bon_commande ON bon_reception.id_bon_commande = details_bon_commande.idboncommande
JOIN proformat ON details_bon_commande.idproformat = proformat.id
JOIN demande ON proformat.idDemande = demande.iddemande
JOIN article ON proformat.idArticle = article.id
JOIN liste_besoin_achat_avec_quantite_etats ON proformat.idDemande = liste_besoin_achat_avec_quantite_etats.idDemande
JOIN module ON liste_besoin_achat_avec_quantite_etats.idModule = module.id
WHERE 
    liste_besoin_achat_avec_quantite_etats.etat = 45 
    AND proformat.idArticle = liste_besoin_achat_avec_quantite_etats.idArticle;



create sequence seqentre
increment by 1
start with 1
minValue 1;

create sequence seqSortie
increment by 1
start with 1
minValue 1;

create sequence seqHistorique
increment by 1
start with 1
minValue 1;

create sequence seqVente
increment by 1
start with 1
minValue 1;


create table entre(
    id varchar(256) default 'E' || LPAD(nextval('seqentre')::text, 4, '0') not null primary key,
    dates date,
    reception varchar(10) references bon_reception(id),
    article varchar(10) references article(id),
    quantite int,
    prix_Unitaire double precision,
    montant double precision,
    module int references module(id)
);

create table type_sortie(
    id serial primary key,
    types  varchar(20)
);

create table explication(
    id serial primary key,
    dates date,
    motif varchar(700),
    reception varchar(10) references bon_reception(id),
    module int references module(id),
    article varchar(10) references article(id),
    quantite int
);

create table historique(
    id varchar(256) default 'H' || LPAD(nextval('seqHistorique')::text, 4, '0') not null primary key,
    dates date,
    entre varchar(256) references entre(id),
    article varchar(10) references article(id),
    quantite int
);

create table sortie(
    id varchar(256) default 'S' || LPAD(nextval('seqSortie')::text, 3, '0') not null primary key,
    dates date,
    entre varchar(256) references entre(id),
    article varchar(10) references article(id),
    quantite int,
    types_sortie int references type_sortie(id)
);


CREATE TABLE sortie_Vente (
    id varchar(50) default 'V' || LPAD(nextval('seqVente')::text, 3, '0') not null primary key,
    lieu_vente varchar(200),
    details_sortie varchar(256) REFERENCES sortie(id),
    prix_Unitaire DOUBLE PRECISION,
    tva_origine INT,
    numero_caisse varchar(10),
    prix_TTC DOUBLE PRECISION,
    montantTotal DOUBLE PRECISION
);

create table sortie_Departement(
    id serial primary key,
    sortie_details varchar(256) references sortie(id),
    module int references module(id)
);

    alter table sortie_vente drop column prix_ttc;
    alter table sortie_vente drop column montanttotal;

-- creation de vue 
create view V_Entre as
    select entre.* ,article.article as nom_article, module.type from entre
    join article on entre.article = article.id
    join module on entre.module = module.id;

create view V_departement as 
select s.id, s.dates, s.article, article.article as nom_article, s.quantite, module.type from sortie_Departement
join sortie as s on sortie_Departement.sortie_details = s.id
join module on sortie_Departement.module = Module.id
join article on s.article = article.id;

create view v_vente as 
select v.lieu_vente, s.dates, s.article, article.article as nom_article, s.quantite, v.prix_Unitaire, v.numero_caisse from sortie_Vente as v
join sortie as s on v.details_sortie = s.id
join article on s.article = article.id;

create view v_sortie as 
select sortie.*, article.article as nom , type_sortie.types from sortie
join article on sortie.article = article.id
join type_sortie on sortie.types_sortie = type_sortie.id;


-- modife zao
create view liste_besoin_achat_avec_quantite_etats as
select idDemande, idArticle, sum(nombre) nombre, idModule, etat from besoin_achat group by idDemande, idArticle, idModule,etat;


CREATE VIEW details_bon AS 
SELECT DISTINCT
    bon_reception.id,
    bon_reception.lieu,
    bon_reception.date AS date_reception,
    bon_commande.date AS date_commande,
    details_bon_commande.idproformat AS proformat, 
    proformat.prixUnitaire AS prixUnitaire, 
    proformat.idArticle AS article, 
    article.article AS nom_article,
    proformat.idFournisseur AS fournisseur, 
    proformat.idDemande AS demande,
    liste_besoin_achat_avec_quantite_etats.etat,
    proformat.tva,
    liste_besoin_achat_avec_quantite_etats.nombre AS quantite_article,
    module.id AS id_module,
    module.type AS module
FROM 
    bon_reception
JOIN bon_commande ON bon_reception.id_bon_commande = bon_commande.id
JOIN details_bon_commande ON bon_reception.id_bon_commande = details_bon_commande.idboncommande
JOIN proformat ON details_bon_commande.idproformat = proformat.id
JOIN demande ON proformat.idDemande = demande.iddemande
JOIN article ON proformat.idArticle = article.id
JOIN liste_besoin_achat_avec_quantite_etats ON proformat.idDemande = liste_besoin_achat_avec_quantite_etats.idDemande
JOIN module ON liste_besoin_achat_avec_quantite_etats.idModule = module.id
WHERE 
    liste_besoin_achat_avec_quantite_etats.etat = 45 
    AND proformat.idArticle = liste_besoin_achat_avec_quantite_etats.idArticle;

-- finance
create sequence seqCompte
increment by 1
start with 1
minValue 1;

create sequence seqMagasin
increment by 1
start with 1
minValue 1;

create sequence seqCaisse
increment by 1
start with 1
minValue 1;

create table compte (
    id varchar(50) primary key,
    nom varchar(150) not null,
    etat int references etats(id_et)
);

create table finance (
    id serial,
    idcompte varchar(50) references compte(id),
    entre double precision default 0,
    sortie double precision default 0,
    explication varchar(255),
    date date
);

create table caisse (
    id varchar(10) primary key,
    nom varchar(20),
    idcompte varchar(50) references compte(id)
);

create table magasin (
    id varchar(10) primary key,
    nom varchar(20) unique,
    lieu varchar(150), 
    date date
);

create table caisse_magasin (
    id serial,
    idMagasin varchar(10) references magasin(id),
    idCaisse varchar(10) references caisse(id),
    etat int default 1
);

create table historique_bon_commande (
    id serial,
    idBonCommande varchar(10) references bon_commande(id),
    etat int references etats(id_et),
    date date
);

create view reste_argents as
select idCompte, sum(entre) entre, sum(sortie) sortie, sum(entre)-sum(sortie) as reste from finance group by idCompte;

create view reste_argents_avec_nom_compte as
select idCompte, nom, entre, sortie, reste from reste_argents r join compte c on r.idCompte = c.id;

create view liste_caisse_magasin as 
select idMagasin, ca.id, nom, idCompte, etat from caisse_magasin c join caisse ca on c.idCaisse = ca.id;

ALTER TABLE sortie_Vente Add foreign key (lieu_vente) references magasin(id);
ALTER TABLE sortie_Vente Add foreign key (numero_caisse) references caisse(id);
ALTER TABLE sortie_Vente Add date date;
ALTER TABLE sortie_Vente Add article varchar(10) references article(id);
ALTER TABLE sortie_Vente Add quantite double precision default 0;
ALTER TABLE sortie_Vente drop details_sortie;

create view liste_total_entre_article_departement as
select article, sum(quantite) quantite from entre where module != 8 group by article;

create view liste_total_entre_article_achat as
select article, sum(quantite) quantite from entre where module = 8 group by article;

create view liste_total_sortie_article_departement as
select article, sum(quantite) quantite from sortie where types_sortie = 1 group by article;

create view liste_total_sortie_article_achat as
select article, sum(quantite) quantite from sortie where types_sortie = 2 group by article;

-- immobilisation
create view compte_mere_immobilisation as
select (SUBSTRING(id, 1, 2) || SUBSTRING(id, 3, 1)) as id from compte where id like '21%' group by SUBSTRING(id, 1, 2) || SUBSTRING(id, 3, 1);

create view type_immobilisation as
select c.* from compte_mere_immobilisation i join compte c on i.id = c.id;

create table besoin_immobilisation (
    id serial primary key,
    idModule int,
    idImmobilisation varchar(10),
    nombre int,
    date date,
    idDemande varchar(10) default NULL,
    etat int,
    description varchar(255),
    foreign key (idModule) references Module(id),
    foreign key (idImmobilisation) references compte(id),
    foreign key (etat) references Etats(id_et)
);

-- ALTER TABLE besoin_immobilisation
-- ALTER COLUMN idImmobilisation TYPE varchar(10);

-- create or replace view liste_besoin_achat as
-- (select idArticle, sum(nombre) nombre from besoin_achat where etat = 28 group by idArticle) union (select idimmobilisation, sum(nombre) nombre from besoin_immobilisation where etat = 28 group by idimmobilisation);

create view liste_besoin_achat_par_module as
SELECT * FROM besoin_achat
    UNION
SELECT id, idmodule, idimmobilisation AS idArticle, nombre, date, etat, iddemande, description FROM besoin_immobilisation;

create view liste_besoin_immobilisation_non_valide as
select id, idmodule, idimmobilisation AS idArticle, nombre, date, etat, iddemande, description from besoin_immobilisation where etat = 28;

create or replace view demande_proformat as
select iddemande from besoin_achat where etat = 32 group by idDemande
UNION
select iddemande from besoin_immobilisation where etat = 32 group by idDemande;

create or replace view liste_article_par_demande as
select idArticle, idDemande from besoin_achat group by idDemande, idArticle
UNION
select idimmobilisation idArticle, idDemande from besoin_immobilisation group by idDemande, idimmobilisation;

ALTER TABLE proformat DROP CONSTRAINT proformat_idarticle_fkey;

create or replace view liste_besoin_achat_avec_quantite as
select idDemande, idArticle, sum(nombre) nombre, idModule from besoin_achat group by idDemande, idArticle, idModule
UNION
select idDemande, idImmobilisation, sum(nombre) nombre, idModule from besoin_immobilisation group by idDemande, idImmobilisation, idModule;

create or replace view liste_besoin_achat_avec_quantite_etats as
select idDemande, idArticle, sum(nombre) nombre, idModule, etat from besoin_achat group by idDemande, idArticle, idModule, etat
UNION
select idDemande, idImmobilisation, sum(nombre) nombre, idModule, etat from besoin_immobilisation group by idDemande, idImmobilisation, idModule, etat;

create or replace view prix_minimum_proformat as
select distinct l.id, l.idDemande, l.idFournisseur, l.idArticle, nombre quantite, prixUnitaire, tva, (nombre*prixUnitaire) prixHT, (prixUnitaire*((tva+100)/100)*nombre) prixAT  
    from liste_meilleur_proformat l 
    join liste_besoin_achat_avec_quantite b on l.idDemande = b.idDemande and l.idArticle = b.idArticle;


-- ALTER TABLE description drop type;
create table categorie (
    id varchar(10) primary key,
    categorie varchar(50) unique
);

create table sous_categorie_type (
    id serial,
    type varchar(50) references compte(id),
    idCategorie varchar(10) references categorie(id),
    etat int references etats(id_et) default 8
);

-- ALTER TABLE description add idCategorie varchar(50) references categorie(id);
create table description (
    id serial,
    idCategorie varchar(50) references categorie(id)
    description varchar(200) not null
);

create view liste_sous_categorie_par_type as
select type, idcategorie, categorie from sous_categorie_type s join categorie c on s.idcategorie = c.id;

create view liste_description_type_immobilisation as
select d.id, type, nom, description from description d join compte c on d.type = c.id;

-- PV de reception
CREATE TABLE type_ammortissement(
    id INT PRIMARY KEY,
    nom VARCHAR(155)
);

CREATE TABLE Lieu(
    id VARCHAR(10) PRIMARY KEY,
    nom VARCHAR(100),
    id_etat INT,
    foreign key (id_etat) references Etats(id_et)
);

CREATE TABLE etat_immobilisation(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255)
);

create sequence seqNumero increment by 1 start with 1 minValue 1;
create sequence seqPvReception increment by 1 start with 1 minValue 1;

create function nextSeqNumero() returns integer
AS
    $$
Declare
retour integer;
BEGIN
SELECT coalesce(nextval('seqNumero'),1) into retour;
return retour;
END
$$ LANGUAGE plpgsql;

CREATE TABLE pv_reception(
    id VARCHAR(10) PRIMARY KEY,
    date DATE,
    code VARCHAR(255),
    id_etat_immobilisation INT,
    id_type_ammortissement INT,
    taux DOUBLE PRECISION,
    id_receptionneur VARCHAR(10),
    id_livreur VARCHAR(10),
    id_bon_commande VARCHAR(10),
    id_article VARCHAR(50),
    id_categorie VARCHAR(50),
    quantite DOUBLE PRECISION,
    foreign key (id_article) references compte(id),
    foreign key (id_categorie) references categorie(id),
    foreign key (id_bon_commande) references bon_commande(id),
    foreign key (id_type_ammortissement) references type_ammortissement(id)
);

CREATE TABLE details_pv_reception(
    id_pv_reception VARCHAR(10),
    id_description INT,
    information VARCHAR(255),
    foreign key (id_pv_reception) references pv_reception(id)
);

CREATE TABLE livreur(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255),
    contact VARCHAR(255),
    id_fournisseur INT,
    foreign key (id_fournisseur) references fournisseur(id)
);


insert into etats values (100, 'Besoin achat');
insert into etats values (110, 'Besoin immobilier');    

ALTER table demande add type int references etats(id_et) default 100;

ALTER table bon_commande add type int references etats(id_et) default 100;

create view type_demande as
select idDemande, nom, type from demande group by idDemande, type, nom;

ALTER TABLE besoin_immobilisation add idCategorie varchar(10) references categorie(id);

-- Check quantite reception et demande
CREATE OR REPLACE VIEW v_liste_details_bon_de_commande_restante AS
    SELECT 
        ld.*, 
        COALESCE(qr.quantite_recue, 0) AS quantite_recue, 
        ld.quantite - COALESCE(qr.quantite_recue, 0) AS quantite_restante
    FROM 
        liste_details_bon_de_commande AS ld
    LEFT JOIN 
        (SELECT 
            id_bon_commande, 
            id_article, 
            SUM(quantite) AS quantite_recue
        FROM 
            pv_reception
        GROUP BY 
            id_bon_commande, 
            id_article) AS qr
    ON 
        ld.idboncommande = qr.id_bon_commande AND ld.idarticle = qr.id_article;
