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





