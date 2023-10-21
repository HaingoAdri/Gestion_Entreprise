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
    foreign key (idCv) references Cv(id)
);

create table qcm_admis(
    id_qcm serial primary key,
    titre varchar(200) not null,
    description varchar(200) not null,
    durer int not null,
    id_cv int not null,
    note_total int not null,
    foreign key (id_cv) references Note_Cv(id)
);

alter table qcm_admis drop COLUMN id_cv;
alter table qcm_admis add COLUMN id_annonce int not null;
alter table qcm_admis add  foreign key (id_annonce) references Besoin(id);

create table question_posée(
    id_q serial primary key,
    questions varchar(200) not null,
    note int not null,
    id_qcm int not null,
    foreign key (id_qcm) references qcm_admis(id_qcm)
);
alter table question_posée drop column note;
alter table question_posée add COLUMN note int default 5;

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


--entretient
create table afaka_qcm (
    id_as serial primary key,
    qcm_r int not null,
    id_users int not null,
    foreign key (qcm_r) references qcm_result(id_r),
    foreign key (id_users) references Client(id)
);

create table entretient(
    id_e serial primary key,
    aa int not null,
    dates date not null,
    heures int not null,
    lieu varchar(200) not null,
    foreign key (aa) references afaka_qcm(id_as)
);

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

<<<<<<< Updated upstream
create table qcm_admis(
    id_qcm serial primary key,
    titre varchar(200) not null,
    description varchar(200) not null,
    durer int not null,
    id_cv int not null,
    note_total int not null,
    foreign key (id_cv) references Note_Cv(id)
);

alter table qcm_admis drop COLUMN id_cv;
alter table qcm_admis add COLUMN id_annonce int not null;
alter table qcm_admis add  foreign key (id_annonce) references Besoin(id);

create table question_posée(
    id_q serial primary key,
    questions varchar(200) not null,
    note int not null,
    id_qcm int not null,
    foreign key (id_qcm) references qcm_admis(id_qcm)
);
alter table question_posée drop column note;
alter table question_posée add COLUMN note int default 5;

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


--entretient
create table afaka_qcm (
    id_as serial primary key,
    qcm_r int not null,
    id_users int not null,
    foreign key (qcm_r) references qcm_result(id_r),
    foreign key (id_users) references Client(id)
);

create table entretient(
    id_e serial primary key,
    aa int not null,
    dates date not null,
    heures int not null,
    lieu varchar(200) not null,
    foreign key (aa) references afaka_qcm(id_as)
);

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

=======
>>>>>>> Stashed changes
-- insert into employer (id_emp, idClient, etat) values ('EMP0000001', 1, 12);
-- insert into employer (id_emp, idClient, etat) values ('EMP0000002', 2, 12);
-- insert into employer (id_emp, idClient, etat) values ('EMP0000003', 4, 12);

create table historique_embauche (
    id serial,
    id_emp varchar(200),
    date date,
    etat int,
    foreign key (etat) references Etats(id_et),
    foreign key (id_emp) references Employer(id_emp)
);
<<<<<<< Updated upstream

-- insert into historique_embauche (id_emp, date, etat) values ('EMP0000001', '2023-10-20', 12);
-- insert into historique_embauche (id_emp, date, etat) values ('EMP0000002', '2023-10-20', 12);
-- insert into historique_embauche (id_emp, date, etat) values ('EMP0000003', '2023-10-20', 12);

create table salaire (
    id serial primary key,
    id_emp varchar(200),
    brut double precision default 0,
    net double precision default 0,
    date date,
    foreign key (id_emp) references Employer(id_emp)
);

-- insert into salaire (id_emp, brut, net, date) values ('EMP0000001', 2700000, 1600000, '2023-10-20');
-- insert into salaire (id_emp, brut, net, date) values ('EMP0000002', 2500000, 1400000, '2023-10-20');
-- insert into salaire (id_emp, brut, net, date) values ('EMP0000001', 3000000, 2400000, '2023-10-20');

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
    foreign key (id_emp) references Employer(id_emp),
    foreign key (lieu_travail) references liste_Adresse_entreprise(id)
);

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

--view liste_contrat_a_renouveler
create view liste_contrat_a_renouveler as
select id, ce.id_emp, lieu_travail, date_debut, date_fin , etat from contrat_essaie ce 
    join employer e on ce.id_emp = e.id_emp
    where etat = 15;

=======
>>>>>>> Stashed changes

-- insert into historique_embauche (id_emp, date, etat) values ('EMP0000001', '2023-10-20', 12);
-- insert into historique_embauche (id_emp, date, etat) values ('EMP0000002', '2023-10-20', 12);
-- insert into historique_embauche (id_emp, date, etat) values ('EMP0000003', '2023-10-20', 12);

create table salaire (
    id serial primary key,
    id_emp varchar(200),
    brut double precision default 0,
    net double precision default 0,
    date date,
    foreign key (id_emp) references Employer(id_emp)
);

-- insert into salaire (id_emp, brut, net, date) values ('EMP0000001', 2700000, 1600000, '2023-10-20');
-- insert into salaire (id_emp, brut, net, date) values ('EMP0000002', 2500000, 1400000, '2023-10-20');
-- insert into salaire (id_emp, brut, net, date) values ('EMP0000001', 3000000, 2400000, '2023-10-20');

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
    foreign key (id_emp) references Employer(id_emp),
    foreign key (lieu_travail) references liste_Adresse_entreprise(id)
);

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
    idAvanatge int,
    date date,
    etat int,
    foreign key (id_emp) references Employer(id_emp),
    foreign key (etat) references Etats(id_et),
    foreign key (idAvanatge) references type_avantage_nature(id)
);

-- Conge
create table type_conge(
    id serial primary key,
    Nom VARCHAR(150),
    politique VARCHAR(250),
    commentaires VARCHAR(250)
);

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
    foreign key (idconge) references conge(id)
);

create table solde_conge(
    id SERIAL PRIMARY KEY,
    idconge INT,
    conge_consomme DOUBLE PRECISION,
    solde_actuel DOUBLE PRECISION,
    foreign key (idconge) references conge(id)
);



