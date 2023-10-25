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