CREATE SEQUENCE seqSortie
increment by 1
start WITH 1
minValue 1;

create table sortie(
    id varchar(10) default 'S' || LPAD(nextval('seqSortie')::text, 3, '0') not null primary key,
    dates date,
    produits varchar(10) references article(id),
    etats varchar(10) references type_sortie(id),
    entre varchar(10) references entre_stock(ide),
    quantite int
);

CREATE SEQUENCE seqConso
increment by 1
start WITH 1
minValue 1;


create table historique(
    id varchar(10) default 'H' || LPAD(nextval('seqConso')::text, 3, '0') not null primary key,
    dates date,
    identre varchar(10) references entre_stock(ide),
    produits varchar references article(id),
    quantite int,
    prix double precision,
    montant double precision
);



create or replace view  entre as select b.id, b.date, b.id_bon_commande as commande , a.article, l.quantite , 
l.prixunitaire, l.prixht, l.prixat, b.id_recepteur from bon_reception as b
 join liste_details_bon_de_commande as l on b.id_bon_commande = l.idboncommande
 join article as a on l.idarticle = a.id;

create view details_entre as select e.date, commande, a.article,quantite,prixunitaire, prixht, prixat 
from entre as e join article as a on e.idarticle = a.id;

create table entre_stock as 
select  CONCAT('E', LPAD(CAST(nextval('seqentre') AS VARCHAR), 3, '0')) AS idE,
id, date, commande, article, quantite, prixunitaire,prixat,prixht from entre;

alter table entre_stock
    add constraint entre_stock_pk
        primary key (ide);