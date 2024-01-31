--
-- PostgreSQL database dump
--

-- Dumped from database version 10.22
-- Dumped by pg_dump version 10.22

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: nextid(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.nextid(prefix text, taille integer) RETURNS text
    LANGUAGE plpgsql
    AS $$
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
$$;


ALTER FUNCTION public.nextid(prefix text, taille integer) OWNER TO postgres;

--
-- Name: nextid(text, text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.nextid(sequence text, prefix text, taille integer) RETURNS text
    LANGUAGE plpgsql
    AS $$
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
$$;


ALTER FUNCTION public.nextid(sequence text, prefix text, taille integer) OWNER TO postgres;

--
-- Name: nextseqcnaps(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.nextseqcnaps() RETURNS integer
    LANGUAGE plpgsql
    AS $$
Declare
retour integer;
BEGIN
SELECT coalesce(nextval('seqCnaps'),1) into retour;
return retour;
END
$$;


ALTER FUNCTION public.nextseqcnaps() OWNER TO postgres;

--
-- Name: nextseqdemande(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.nextseqdemande(prefix text, taille integer) RETURNS text
    LANGUAGE plpgsql
    AS $$
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
$$;


ALTER FUNCTION public.nextseqdemande(prefix text, taille integer) OWNER TO postgres;

--
-- Name: nextseqemploye(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.nextseqemploye() RETURNS integer
    LANGUAGE plpgsql
    AS $$
Declare
retour integer;
BEGIN
SELECT coalesce(nextval('seqEmploye'),1) into retour;
return retour;
END
$$;


ALTER FUNCTION public.nextseqemploye() OWNER TO postgres;

--
-- Name: nextseqnumero(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.nextseqnumero() RETURNS integer
    LANGUAGE plpgsql
    AS $$
Declare
retour integer;
BEGIN
SELECT coalesce(nextval('seqNumero'),1) into retour;
return retour;
END
$$;


ALTER FUNCTION public.nextseqnumero() OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: administrateur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.administrateur (
    id integer NOT NULL,
    nom character varying(50),
    prenom character varying(150),
    email character varying(70),
    mot_de_passe character varying(12),
    idmodule integer
);


ALTER TABLE public.administrateur OWNER TO postgres;

--
-- Name: administrateur_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.administrateur_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.administrateur_id_seq OWNER TO postgres;

--
-- Name: administrateur_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.administrateur_id_seq OWNED BY public.administrateur.id;


--
-- Name: afaka_qcm; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.afaka_qcm (
    id_as integer NOT NULL,
    qcm_r integer NOT NULL,
    id_users integer NOT NULL
);


ALTER TABLE public.afaka_qcm OWNER TO postgres;

--
-- Name: afaka_qcm_id_as_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.afaka_qcm_id_as_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.afaka_qcm_id_as_seq OWNER TO postgres;

--
-- Name: afaka_qcm_id_as_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.afaka_qcm_id_as_seq OWNED BY public.afaka_qcm.id_as;


--
-- Name: article; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.article (
    id character varying(10) NOT NULL,
    article character varying(50),
    method integer,
    types character varying(50)
);


ALTER TABLE public.article OWNER TO postgres;

--
-- Name: avance; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.avance (
    id integer NOT NULL,
    id_employe character varying(200),
    avance double precision,
    date date
);


ALTER TABLE public.avance OWNER TO postgres;

--
-- Name: avance_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.avance_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.avance_id_seq OWNER TO postgres;

--
-- Name: avance_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.avance_id_seq OWNED BY public.avance.id;


--
-- Name: avantage_nature; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.avantage_nature (
    id integer NOT NULL,
    id_emp character varying(200),
    idavantage integer,
    date date,
    etat integer
);


ALTER TABLE public.avantage_nature OWNER TO postgres;

--
-- Name: avantage_nature_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.avantage_nature_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.avantage_nature_id_seq OWNER TO postgres;

--
-- Name: avantage_nature_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.avantage_nature_id_seq OWNED BY public.avantage_nature.id;


--
-- Name: besoin; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.besoin (
    id integer NOT NULL,
    idposte integer,
    idservice integer,
    besoin_horaire double precision,
    heure_jour_homme double precision,
    description character varying(150),
    id_type_contrat integer
);


ALTER TABLE public.besoin OWNER TO postgres;

--
-- Name: besoin_achat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.besoin_achat (
    id integer NOT NULL,
    idmodule integer,
    idarticle character varying(10),
    nombre integer,
    date date,
    etat integer,
    iddemande character varying(10) DEFAULT NULL::character varying,
    description character varying(255)
);


ALTER TABLE public.besoin_achat OWNER TO postgres;

--
-- Name: besoin_achat_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.besoin_achat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.besoin_achat_id_seq OWNER TO postgres;

--
-- Name: besoin_achat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.besoin_achat_id_seq OWNED BY public.besoin_achat.id;


--
-- Name: besoin_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.besoin_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.besoin_id_seq OWNER TO postgres;

--
-- Name: besoin_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.besoin_id_seq OWNED BY public.besoin.id;


--
-- Name: besoin_immobilisation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.besoin_immobilisation (
    id integer NOT NULL,
    idmodule integer,
    idimmobilisation character varying(10),
    nombre integer,
    date date,
    iddemande character varying(10) DEFAULT NULL::character varying,
    etat integer,
    description character varying(255),
    idcategorie character varying(10)
);


ALTER TABLE public.besoin_immobilisation OWNER TO postgres;

--
-- Name: besoin_immobilisation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.besoin_immobilisation_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.besoin_immobilisation_id_seq OWNER TO postgres;

--
-- Name: besoin_immobilisation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.besoin_immobilisation_id_seq OWNED BY public.besoin_immobilisation.id;


--
-- Name: bon_commande; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bon_commande (
    id character varying(10) NOT NULL,
    date date,
    etat integer,
    idpayement integer,
    delailivarison double precision DEFAULT 0,
    type integer DEFAULT 100
);


ALTER TABLE public.bon_commande OWNER TO postgres;

--
-- Name: bon_reception; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bon_reception (
    id character varying(10) NOT NULL,
    lieu character varying(100),
    date date,
    id_bon_commande character varying(10),
    id_recepteur character varying(10),
    etat integer
);


ALTER TABLE public.bon_reception OWNER TO postgres;

--
-- Name: caisse; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.caisse (
    id character varying(10) NOT NULL,
    nom character varying(20),
    idcompte character varying(50)
);


ALTER TABLE public.caisse OWNER TO postgres;

--
-- Name: caisse_magasin; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.caisse_magasin (
    id integer NOT NULL,
    idmagasin character varying(10),
    idcaisse character varying(10),
    etat integer DEFAULT 1
);


ALTER TABLE public.caisse_magasin OWNER TO postgres;

--
-- Name: caisse_magasin_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.caisse_magasin_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.caisse_magasin_id_seq OWNER TO postgres;

--
-- Name: caisse_magasin_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.caisse_magasin_id_seq OWNED BY public.caisse_magasin.id;


--
-- Name: categorie; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categorie (
    id character varying(10) NOT NULL,
    categorie character varying(50)
);


ALTER TABLE public.categorie OWNER TO postgres;

--
-- Name: client; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.client (
    id integer NOT NULL,
    nom character varying(50),
    prenom character varying(150),
    email character varying(70),
    mot_de_passe character varying(12),
    date_naissance date,
    idgenre integer
);


ALTER TABLE public.client OWNER TO postgres;

--
-- Name: client_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.client_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.client_id_seq OWNER TO postgres;

--
-- Name: client_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.client_id_seq OWNED BY public.client.id;


--
-- Name: clientel; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.clientel (
    id character varying NOT NULL,
    prenom character varying,
    mail character varying,
    adresse character varying,
    genres character varying
);


ALTER TABLE public.clientel OWNER TO postgres;

--
-- Name: cnaps; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cnaps (
    id character varying(10) NOT NULL,
    id_emp character varying(10),
    date date,
    etat integer DEFAULT 8
);


ALTER TABLE public.cnaps OWNER TO postgres;

--
-- Name: compte; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.compte (
    id character varying(50) NOT NULL,
    nom character varying(150) NOT NULL,
    etat integer DEFAULT 8
);


ALTER TABLE public.compte OWNER TO postgres;

--
-- Name: compte_mere_immobilisation; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.compte_mere_immobilisation AS
 SELECT ("substring"((compte.id)::text, 1, 2) || "substring"((compte.id)::text, 3, 1)) AS id
   FROM public.compte
  WHERE ((compte.id)::text ~~ '21%'::text)
  GROUP BY ("substring"((compte.id)::text, 1, 2) || "substring"((compte.id)::text, 3, 1));


ALTER TABLE public.compte_mere_immobilisation OWNER TO postgres;

--
-- Name: confirmation_date; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.confirmation_date (
    id integer NOT NULL,
    idconge integer,
    depart timestamp without time zone,
    retour timestamp without time zone,
    commentaires character varying(100)
);


ALTER TABLE public.confirmation_date OWNER TO postgres;

--
-- Name: conge; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.conge (
    id integer NOT NULL,
    id_employer character varying(100),
    id_type_conge integer,
    raison character varying(250),
    debut timestamp without time zone,
    fin timestamp without time zone,
    statut integer,
    justificatif character varying(250)
);


ALTER TABLE public.conge OWNER TO postgres;

--
-- Name: conf_conge; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.conf_conge AS
 SELECT conge.id,
    conge.id_employer,
    conge.id_type_conge,
    conge.raison,
    conge.debut,
    conge.fin,
    conge.statut,
    conge.justificatif,
    conf_date.depart,
    conf_date.retour
   FROM (public.conge
     LEFT JOIN public.confirmation_date conf_date ON ((conge.id = conf_date.idconge)));


ALTER TABLE public.conf_conge OWNER TO postgres;

--
-- Name: confirmation_date_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.confirmation_date_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.confirmation_date_id_seq OWNER TO postgres;

--
-- Name: confirmation_date_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.confirmation_date_id_seq OWNED BY public.confirmation_date.id;


--
-- Name: conge_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.conge_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.conge_id_seq OWNER TO postgres;

--
-- Name: conge_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.conge_id_seq OWNED BY public.conge.id;


--
-- Name: contrat_essaie; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contrat_essaie (
    id integer NOT NULL,
    id_emp character varying(200),
    lieu_travail integer,
    date_debut date,
    date_fin date,
    obligation character varying(500),
    superieur character varying(200)
);


ALTER TABLE public.contrat_essaie OWNER TO postgres;

--
-- Name: contrat_essaie_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.contrat_essaie_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contrat_essaie_id_seq OWNER TO postgres;

--
-- Name: contrat_essaie_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.contrat_essaie_id_seq OWNED BY public.contrat_essaie.id;


--
-- Name: cv; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cv (
    id integer NOT NULL,
    idclient integer,
    idbesoin integer,
    iddiplome integer,
    experiences integer,
    idmatrimoniale integer,
    idville integer
);


ALTER TABLE public.cv OWNER TO postgres;

--
-- Name: cv_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cv_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cv_id_seq OWNER TO postgres;

--
-- Name: cv_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cv_id_seq OWNED BY public.cv.id;


--
-- Name: demande; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.demande (
    id integer NOT NULL,
    date date,
    nom character varying(200),
    iddemande character varying(10),
    idfournisseur integer,
    etat integer,
    type integer DEFAULT 100
);


ALTER TABLE public.demande OWNER TO postgres;

--
-- Name: demande_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.demande_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.demande_id_seq OWNER TO postgres;

--
-- Name: demande_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.demande_id_seq OWNED BY public.demande.id;


--
-- Name: demande_proformat; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.demande_proformat AS
 SELECT besoin_achat.iddemande
   FROM public.besoin_achat
  WHERE (besoin_achat.etat = 32)
  GROUP BY besoin_achat.iddemande
UNION
 SELECT besoin_immobilisation.iddemande
   FROM public.besoin_immobilisation
  WHERE (besoin_immobilisation.etat = 32)
  GROUP BY besoin_immobilisation.iddemande;


ALTER TABLE public.demande_proformat OWNER TO postgres;

--
-- Name: description; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.description (
    id integer NOT NULL,
    description character varying(200) NOT NULL,
    idcategorie character varying(50)
);


ALTER TABLE public.description OWNER TO postgres;

--
-- Name: description_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.description_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.description_id_seq OWNER TO postgres;

--
-- Name: description_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.description_id_seq OWNED BY public.description.id;


--
-- Name: pv_reception; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pv_reception (
    id character varying(10) NOT NULL,
    date date,
    code character varying(255),
    id_etat_immobilisation integer,
    id_type_ammortissement integer,
    taux double precision,
    id_receptionneur character varying(10),
    id_livreur character varying(10),
    id_bon_commande character varying(10),
    id_article character varying(50),
    id_categorie character varying(50),
    quantite double precision,
    duree_an integer
);


ALTER TABLE public.pv_reception OWNER TO postgres;

--
-- Name: detail_pv_rec; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.detail_pv_rec AS
 SELECT pv_reception.id,
    pv_reception.date,
    pv_reception.code,
    pv_reception.id_etat_immobilisation,
    pv_reception.id_type_ammortissement,
    pv_reception.taux,
    pv_reception.id_receptionneur,
    pv_reception.id_livreur,
    pv_reception.id_bon_commande,
    pv_reception.id_article,
    pv_reception.id_categorie,
    pv_reception.quantite,
    c.nom AS article
   FROM (public.pv_reception
     JOIN public.compte c ON (((pv_reception.id_article)::text = (c.id)::text)));


ALTER TABLE public.detail_pv_rec OWNER TO postgres;

--
-- Name: details_besoin_age; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_besoin_age (
    id integer NOT NULL,
    idbesoin integer,
    min integer,
    max integer,
    note double precision DEFAULT 0
);


ALTER TABLE public.details_besoin_age OWNER TO postgres;

--
-- Name: details_besoin_age_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.details_besoin_age_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.details_besoin_age_id_seq OWNER TO postgres;

--
-- Name: details_besoin_age_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.details_besoin_age_id_seq OWNED BY public.details_besoin_age.id;


--
-- Name: details_besoin_diplome; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_besoin_diplome (
    id integer NOT NULL,
    idbesoin integer,
    iddiplome integer,
    note double precision DEFAULT 0
);


ALTER TABLE public.details_besoin_diplome OWNER TO postgres;

--
-- Name: details_besoin_diplome_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.details_besoin_diplome_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.details_besoin_diplome_id_seq OWNER TO postgres;

--
-- Name: details_besoin_diplome_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.details_besoin_diplome_id_seq OWNED BY public.details_besoin_diplome.id;


--
-- Name: details_besoin_experience; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_besoin_experience (
    id integer NOT NULL,
    idbesoin integer,
    annee_experience integer,
    note double precision DEFAULT 0
);


ALTER TABLE public.details_besoin_experience OWNER TO postgres;

--
-- Name: details_besoin_experience_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.details_besoin_experience_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.details_besoin_experience_id_seq OWNER TO postgres;

--
-- Name: details_besoin_experience_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.details_besoin_experience_id_seq OWNED BY public.details_besoin_experience.id;


--
-- Name: details_besoin_genre; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_besoin_genre (
    id integer NOT NULL,
    idbesoin integer,
    idgenre integer,
    note double precision DEFAULT 0
);


ALTER TABLE public.details_besoin_genre OWNER TO postgres;

--
-- Name: details_besoin_genre_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.details_besoin_genre_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.details_besoin_genre_id_seq OWNER TO postgres;

--
-- Name: details_besoin_genre_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.details_besoin_genre_id_seq OWNED BY public.details_besoin_genre.id;


--
-- Name: details_besoin_matrimoniale; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_besoin_matrimoniale (
    id integer NOT NULL,
    idbesoin integer,
    idmatrimoniale integer,
    note double precision DEFAULT 0
);


ALTER TABLE public.details_besoin_matrimoniale OWNER TO postgres;

--
-- Name: details_besoin_matrimoniale_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.details_besoin_matrimoniale_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.details_besoin_matrimoniale_id_seq OWNER TO postgres;

--
-- Name: details_besoin_matrimoniale_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.details_besoin_matrimoniale_id_seq OWNED BY public.details_besoin_matrimoniale.id;


--
-- Name: details_besoin_nationalite; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_besoin_nationalite (
    id integer NOT NULL,
    idbesoin integer,
    idnationalite integer,
    note double precision DEFAULT 0
);


ALTER TABLE public.details_besoin_nationalite OWNER TO postgres;

--
-- Name: details_besoin_nationalite_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.details_besoin_nationalite_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.details_besoin_nationalite_id_seq OWNER TO postgres;

--
-- Name: details_besoin_nationalite_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.details_besoin_nationalite_id_seq OWNED BY public.details_besoin_nationalite.id;


--
-- Name: details_besoin_region; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_besoin_region (
    id integer NOT NULL,
    idbesoin integer,
    idregion integer,
    note double precision DEFAULT 0
);


ALTER TABLE public.details_besoin_region OWNER TO postgres;

--
-- Name: details_besoin_region_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.details_besoin_region_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.details_besoin_region_id_seq OWNER TO postgres;

--
-- Name: details_besoin_region_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.details_besoin_region_id_seq OWNED BY public.details_besoin_region.id;


--
-- Name: details_besoin_salaire; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_besoin_salaire (
    id integer NOT NULL,
    idbesoin integer,
    min double precision DEFAULT 0,
    max double precision DEFAULT 0,
    note double precision DEFAULT 0
);


ALTER TABLE public.details_besoin_salaire OWNER TO postgres;

--
-- Name: details_besoin_salaire_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.details_besoin_salaire_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.details_besoin_salaire_id_seq OWNER TO postgres;

--
-- Name: details_besoin_salaire_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.details_besoin_salaire_id_seq OWNED BY public.details_besoin_salaire.id;


--
-- Name: details_besoin_ville; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_besoin_ville (
    id integer NOT NULL,
    idbesoin integer,
    idville integer,
    note double precision DEFAULT 0
);


ALTER TABLE public.details_besoin_ville OWNER TO postgres;

--
-- Name: details_besoin_ville_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.details_besoin_ville_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.details_besoin_ville_id_seq OWNER TO postgres;

--
-- Name: details_besoin_ville_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.details_besoin_ville_id_seq OWNED BY public.details_besoin_ville.id;


--
-- Name: details_bon_commande; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_bon_commande (
    id integer NOT NULL,
    idboncommande character varying(10),
    idproformat integer,
    etat integer
);


ALTER TABLE public.details_bon_commande OWNER TO postgres;

--
-- Name: liste_besoin_achat_avec_quantite_etats; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_besoin_achat_avec_quantite_etats AS
 SELECT besoin_achat.iddemande,
    besoin_achat.idarticle,
    sum(besoin_achat.nombre) AS nombre,
    besoin_achat.idmodule,
    besoin_achat.etat
   FROM public.besoin_achat
  GROUP BY besoin_achat.iddemande, besoin_achat.idarticle, besoin_achat.idmodule, besoin_achat.etat
UNION
 SELECT besoin_immobilisation.iddemande,
    besoin_immobilisation.idimmobilisation AS idarticle,
    sum(besoin_immobilisation.nombre) AS nombre,
    besoin_immobilisation.idmodule,
    besoin_immobilisation.etat
   FROM public.besoin_immobilisation
  GROUP BY besoin_immobilisation.iddemande, besoin_immobilisation.idimmobilisation, besoin_immobilisation.idmodule, besoin_immobilisation.etat;


ALTER TABLE public.liste_besoin_achat_avec_quantite_etats OWNER TO postgres;

--
-- Name: module; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.module (
    id integer NOT NULL,
    type character varying(50)
);


ALTER TABLE public.module OWNER TO postgres;

--
-- Name: proformat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.proformat (
    id integer NOT NULL,
    iddemande character varying(10),
    idfournisseur integer,
    idarticle character varying(10),
    prixunitaire double precision DEFAULT 0,
    tva double precision DEFAULT 0,
    date date
);


ALTER TABLE public.proformat OWNER TO postgres;

--
-- Name: details_bon; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.details_bon AS
 SELECT DISTINCT bon_reception.id,
    bon_reception.lieu,
    bon_reception.date AS date_reception,
    bon_commande.date AS date_commande,
    details_bon_commande.idproformat AS proformat,
    proformat.prixunitaire,
    proformat.idarticle AS article,
    article.article AS nom_article,
    proformat.idfournisseur AS fournisseur,
    proformat.iddemande AS demande,
    liste_besoin_achat_avec_quantite_etats.etat,
    proformat.tva,
    liste_besoin_achat_avec_quantite_etats.nombre AS quantite_article,
    module.id AS id_module,
    module.type AS module
   FROM (((((((public.bon_reception
     JOIN public.bon_commande ON (((bon_reception.id_bon_commande)::text = (bon_commande.id)::text)))
     JOIN public.details_bon_commande ON (((bon_reception.id_bon_commande)::text = (details_bon_commande.idboncommande)::text)))
     JOIN public.proformat ON ((details_bon_commande.idproformat = proformat.id)))
     JOIN public.demande ON (((proformat.iddemande)::text = (demande.iddemande)::text)))
     JOIN public.article ON (((proformat.idarticle)::text = (article.id)::text)))
     JOIN public.liste_besoin_achat_avec_quantite_etats ON (((proformat.iddemande)::text = (liste_besoin_achat_avec_quantite_etats.iddemande)::text)))
     JOIN public.module ON ((liste_besoin_achat_avec_quantite_etats.idmodule = module.id)))
  WHERE ((liste_besoin_achat_avec_quantite_etats.etat = 45) AND ((proformat.idarticle)::text = (liste_besoin_achat_avec_quantite_etats.idarticle)::text));


ALTER TABLE public.details_bon OWNER TO postgres;

--
-- Name: details_bon_commande_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.details_bon_commande_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.details_bon_commande_id_seq OWNER TO postgres;

--
-- Name: details_bon_commande_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.details_bon_commande_id_seq OWNED BY public.details_bon_commande.id;


--
-- Name: details_bon_reception; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_bon_reception (
    id_bon_reception character varying(10),
    id_article character varying(10),
    id_fournisseur integer,
    date date,
    etat integer
);


ALTER TABLE public.details_bon_reception OWNER TO postgres;

--
-- Name: details_cv_diplome; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_cv_diplome (
    id integer NOT NULL,
    idcv integer,
    nom_pdf character varying(150)
);


ALTER TABLE public.details_cv_diplome OWNER TO postgres;

--
-- Name: details_cv_diplome_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.details_cv_diplome_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.details_cv_diplome_id_seq OWNER TO postgres;

--
-- Name: details_cv_diplome_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.details_cv_diplome_id_seq OWNED BY public.details_cv_diplome.id;


--
-- Name: details_cv_salaire; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_cv_salaire (
    id integer NOT NULL,
    idcv integer,
    min double precision DEFAULT 0,
    max double precision DEFAULT 0
);


ALTER TABLE public.details_cv_salaire OWNER TO postgres;

--
-- Name: details_cv_salaire_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.details_cv_salaire_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.details_cv_salaire_id_seq OWNER TO postgres;

--
-- Name: details_cv_salaire_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.details_cv_salaire_id_seq OWNED BY public.details_cv_salaire.id;


--
-- Name: details_cv_travail_anterieur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_cv_travail_anterieur (
    id integer NOT NULL,
    idcv integer,
    nom_pdf character varying(150)
);


ALTER TABLE public.details_cv_travail_anterieur OWNER TO postgres;

--
-- Name: details_cv_travail_anterieur_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.details_cv_travail_anterieur_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.details_cv_travail_anterieur_id_seq OWNER TO postgres;

--
-- Name: details_cv_travail_anterieur_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.details_cv_travail_anterieur_id_seq OWNED BY public.details_cv_travail_anterieur.id;


--
-- Name: details_pv_reception; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_pv_reception (
    id_pv_reception character varying(10),
    id_description integer,
    information character varying(255)
);


ALTER TABLE public.details_pv_reception OWNER TO postgres;

--
-- Name: details_sortie; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_sortie (
    id integer NOT NULL,
    sortie character varying(256),
    types_sortie integer
);


ALTER TABLE public.details_sortie OWNER TO postgres;

--
-- Name: details_sortie_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.details_sortie_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.details_sortie_id_seq OWNER TO postgres;

--
-- Name: details_sortie_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.details_sortie_id_seq OWNED BY public.details_sortie.id;


--
-- Name: seq_details_utilisation; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_details_utilisation
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_details_utilisation OWNER TO postgres;

--
-- Name: details_utilisation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.details_utilisation (
    iddu character varying(10) DEFAULT ('DU'::text || lpad((nextval('public.seq_details_utilisation'::regclass))::text, 5, '0'::text)) NOT NULL,
    pv_utilisation character varying(10),
    immobilisation character varying(10),
    description character varying(60),
    etat_immobilisation integer,
    etat integer DEFAULT 40
);


ALTER TABLE public.details_utilisation OWNER TO postgres;

--
-- Name: diplome; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.diplome (
    id integer NOT NULL,
    type character varying(50)
);


ALTER TABLE public.diplome OWNER TO postgres;

--
-- Name: diplome_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.diplome_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.diplome_id_seq OWNER TO postgres;

--
-- Name: diplome_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.diplome_id_seq OWNED BY public.diplome.id;


--
-- Name: employer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.employer (
    id_emp character varying(200) NOT NULL,
    idclient integer,
    cin character varying(12) DEFAULT NULL::character varying,
    telephone character varying(10) DEFAULT NULL::character varying,
    adresse character varying(30) DEFAULT NULL::character varying,
    etat integer
);


ALTER TABLE public.employer OWNER TO postgres;

--
-- Name: employer_module; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.employer_module (
    id integer NOT NULL,
    idmodule integer,
    idemploye character varying(10)
);


ALTER TABLE public.employer_module OWNER TO postgres;

--
-- Name: employer_module_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.employer_module_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.employer_module_id_seq OWNER TO postgres;

--
-- Name: employer_module_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.employer_module_id_seq OWNED BY public.employer_module.id;


--
-- Name: seqentre; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seqentre
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seqentre OWNER TO postgres;

--
-- Name: entre; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.entre (
    id character varying(256) DEFAULT ('E'::text || lpad((nextval('public.seqentre'::regclass))::text, 4, '0'::text)) NOT NULL,
    dates date,
    reception character varying(10),
    article character varying(10),
    quantite integer,
    prix_unitaire double precision,
    montant double precision,
    module integer
);


ALTER TABLE public.entre OWNER TO postgres;

--
-- Name: entretient; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.entretient (
    id_e integer NOT NULL,
    aa integer NOT NULL,
    dates date NOT NULL,
    heures integer NOT NULL,
    lieu character varying(200) NOT NULL
);


ALTER TABLE public.entretient OWNER TO postgres;

--
-- Name: entretient_id_e_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.entretient_id_e_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.entretient_id_e_seq OWNER TO postgres;

--
-- Name: entretient_id_e_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.entretient_id_e_seq OWNED BY public.entretient.id_e;


--
-- Name: etat_immobilisation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.etat_immobilisation (
    id integer NOT NULL,
    nom character varying(255)
);


ALTER TABLE public.etat_immobilisation OWNER TO postgres;

--
-- Name: etat_immobilisation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.etat_immobilisation_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.etat_immobilisation_id_seq OWNER TO postgres;

--
-- Name: etat_immobilisation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.etat_immobilisation_id_seq OWNED BY public.etat_immobilisation.id;


--
-- Name: etats; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.etats (
    id_et integer NOT NULL,
    nom_etats character varying(200) NOT NULL
);


ALTER TABLE public.etats OWNER TO postgres;

--
-- Name: etats_id_et_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.etats_id_et_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.etats_id_et_seq OWNER TO postgres;

--
-- Name: etats_id_et_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.etats_id_et_seq OWNED BY public.etats.id_et;


--
-- Name: explication; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.explication (
    id integer NOT NULL,
    dates date,
    motif character varying(700),
    reception character varying(10),
    module integer,
    article character varying(10),
    quantite integer
);


ALTER TABLE public.explication OWNER TO postgres;

--
-- Name: explication_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.explication_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.explication_id_seq OWNER TO postgres;

--
-- Name: explication_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.explication_id_seq OWNED BY public.explication.id;


--
-- Name: finance; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.finance (
    id integer NOT NULL,
    idcompte character varying(50),
    entre double precision DEFAULT 0,
    sortie double precision DEFAULT 0,
    explication character varying(255),
    date date
);


ALTER TABLE public.finance OWNER TO postgres;

--
-- Name: finance_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.finance_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.finance_id_seq OWNER TO postgres;

--
-- Name: finance_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.finance_id_seq OWNED BY public.finance.id;


--
-- Name: fournisseur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fournisseur (
    id integer NOT NULL,
    nom character varying(70),
    email character varying(150),
    adresse character varying(70),
    telephone character varying(20),
    responsable character varying(100)
);


ALTER TABLE public.fournisseur OWNER TO postgres;

--
-- Name: fournisseur_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.fournisseur_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fournisseur_id_seq OWNER TO postgres;

--
-- Name: fournisseur_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.fournisseur_id_seq OWNED BY public.fournisseur.id;


--
-- Name: seqhistorique; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seqhistorique
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seqhistorique OWNER TO postgres;

--
-- Name: historique; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.historique (
    id character varying(256) DEFAULT ('H'::text || lpad((nextval('public.seqhistorique'::regclass))::text, 4, '0'::text)) NOT NULL,
    dates date,
    entre character varying(256),
    article character varying(10),
    quantite integer
);


ALTER TABLE public.historique OWNER TO postgres;

--
-- Name: historique_bon_commande; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.historique_bon_commande (
    id integer NOT NULL,
    idboncommande character varying(10),
    etat integer,
    date date
);


ALTER TABLE public.historique_bon_commande OWNER TO postgres;

--
-- Name: historique_bon_commande_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.historique_bon_commande_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.historique_bon_commande_id_seq OWNER TO postgres;

--
-- Name: historique_bon_commande_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.historique_bon_commande_id_seq OWNED BY public.historique_bon_commande.id;


--
-- Name: historique_embauche; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.historique_embauche (
    id integer NOT NULL,
    id_emp character varying(200),
    date date,
    etat integer
);


ALTER TABLE public.historique_embauche OWNER TO postgres;

--
-- Name: historique_embauche_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.historique_embauche_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.historique_embauche_id_seq OWNER TO postgres;

--
-- Name: historique_embauche_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.historique_embauche_id_seq OWNED BY public.historique_embauche.id;


--
-- Name: immobilisation_reception; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.immobilisation_reception (
    id_immobilisation character varying(10) NOT NULL,
    id_pv_reception character varying(10),
    id_etat_immobilisation integer
);


ALTER TABLE public.immobilisation_reception OWNER TO postgres;

--
-- Name: impot; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.impot (
    id integer NOT NULL,
    plafond_minimum double precision,
    plafond_maximum double precision,
    pourcentage double precision
);


ALTER TABLE public.impot OWNER TO postgres;

--
-- Name: impot_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.impot_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.impot_id_seq OWNER TO postgres;

--
-- Name: impot_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.impot_id_seq OWNED BY public.impot.id;


--
-- Name: seq_inventaire; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_inventaire
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_inventaire OWNER TO postgres;

--
-- Name: inventaire; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.inventaire (
    id character varying(10) DEFAULT ('IV'::text || lpad((nextval('public.seq_inventaire'::regclass))::text, 5, '0'::text)) NOT NULL,
    date date,
    immobilisation character varying(10),
    etat_immobilisation integer,
    taux integer,
    ammortissement integer,
    type_inventaire character varying(60),
    libeller character varying(60),
    description character varying(200)
);


ALTER TABLE public.inventaire OWNER TO postgres;

--
-- Name: lieu; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lieu (
    id character varying(10) NOT NULL,
    nom character varying(100),
    id_etat integer
);


ALTER TABLE public.lieu OWNER TO postgres;

--
-- Name: liste_adresse_entreprise; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.liste_adresse_entreprise (
    id integer NOT NULL,
    adresse character varying(200),
    date date
);


ALTER TABLE public.liste_adresse_entreprise OWNER TO postgres;

--
-- Name: liste_adresse_entreprise_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.liste_adresse_entreprise_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.liste_adresse_entreprise_id_seq OWNER TO postgres;

--
-- Name: liste_adresse_entreprise_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.liste_adresse_entreprise_id_seq OWNED BY public.liste_adresse_entreprise.id;


--
-- Name: liste_afaka_qcm; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_afaka_qcm AS
 SELECT e.id_e,
    e.aa,
    e.dates,
    aq.id_as,
    aq.qcm_r,
    aq.id_users
   FROM (public.entretient e
     JOIN public.afaka_qcm aq ON ((e.aa = aq.id_as)));


ALTER TABLE public.liste_afaka_qcm OWNER TO postgres;

--
-- Name: liste_article_par_demande; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_article_par_demande AS
 SELECT besoin_achat.idarticle,
    besoin_achat.iddemande
   FROM public.besoin_achat
  GROUP BY besoin_achat.iddemande, besoin_achat.idarticle
UNION
 SELECT besoin_immobilisation.idimmobilisation AS idarticle,
    besoin_immobilisation.iddemande
   FROM public.besoin_immobilisation
  GROUP BY besoin_immobilisation.iddemande, besoin_immobilisation.idimmobilisation;


ALTER TABLE public.liste_article_par_demande OWNER TO postgres;

--
-- Name: liste_besoin_achat; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_besoin_achat AS
 SELECT besoin_achat.idarticle,
    sum(besoin_achat.nombre) AS nombre
   FROM public.besoin_achat
  WHERE (besoin_achat.etat = 28)
  GROUP BY besoin_achat.idarticle;


ALTER TABLE public.liste_besoin_achat OWNER TO postgres;

--
-- Name: liste_besoin_achat_avec_quantite; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_besoin_achat_avec_quantite AS
 SELECT besoin_achat.iddemande,
    besoin_achat.idarticle,
    sum(besoin_achat.nombre) AS nombre,
    besoin_achat.idmodule
   FROM public.besoin_achat
  GROUP BY besoin_achat.iddemande, besoin_achat.idarticle, besoin_achat.idmodule
UNION
 SELECT besoin_immobilisation.iddemande,
    besoin_immobilisation.idimmobilisation AS idarticle,
    sum(besoin_immobilisation.nombre) AS nombre,
    besoin_immobilisation.idmodule
   FROM public.besoin_immobilisation
  GROUP BY besoin_immobilisation.iddemande, besoin_immobilisation.idimmobilisation, besoin_immobilisation.idmodule;


ALTER TABLE public.liste_besoin_achat_avec_quantite OWNER TO postgres;

--
-- Name: liste_besoin_achat_avec_quantite_idmodule; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_besoin_achat_avec_quantite_idmodule AS
 SELECT besoin_achat.iddemande,
    besoin_achat.idarticle,
    sum(besoin_achat.nombre) AS nombre,
    besoin_achat.idmodule
   FROM public.besoin_achat
  GROUP BY besoin_achat.iddemande, besoin_achat.idarticle, besoin_achat.idmodule;


ALTER TABLE public.liste_besoin_achat_avec_quantite_idmodule OWNER TO postgres;

--
-- Name: liste_besoin_achat_avec_quantite_module; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_besoin_achat_avec_quantite_module AS
 SELECT besoin_achat.iddemande,
    besoin_achat.idarticle,
    sum(besoin_achat.nombre) AS nombre,
    besoin_achat.idmodule
   FROM public.besoin_achat
  GROUP BY besoin_achat.iddemande, besoin_achat.idarticle, besoin_achat.idmodule;


ALTER TABLE public.liste_besoin_achat_avec_quantite_module OWNER TO postgres;

--
-- Name: liste_besoin_achat_par_module; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_besoin_achat_par_module AS
 SELECT besoin_achat.id,
    besoin_achat.idmodule,
    besoin_achat.idarticle,
    besoin_achat.nombre,
    besoin_achat.date,
    besoin_achat.etat,
    besoin_achat.iddemande,
    besoin_achat.description
   FROM public.besoin_achat
UNION
 SELECT besoin_immobilisation.id,
    besoin_immobilisation.idmodule,
    besoin_immobilisation.idimmobilisation AS idarticle,
    besoin_immobilisation.nombre,
    besoin_immobilisation.date,
    besoin_immobilisation.etat,
    besoin_immobilisation.iddemande,
    besoin_immobilisation.description
   FROM public.besoin_immobilisation;


ALTER TABLE public.liste_besoin_achat_par_module OWNER TO postgres;

--
-- Name: liste_besoin_immobilisation_non_valide; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_besoin_immobilisation_non_valide AS
 SELECT besoin_immobilisation.id,
    besoin_immobilisation.idmodule,
    besoin_immobilisation.idimmobilisation AS idarticle,
    besoin_immobilisation.nombre,
    besoin_immobilisation.date,
    besoin_immobilisation.etat,
    besoin_immobilisation.iddemande,
    besoin_immobilisation.description
   FROM public.besoin_immobilisation
  WHERE (besoin_immobilisation.etat = 28);


ALTER TABLE public.liste_besoin_immobilisation_non_valide OWNER TO postgres;

--
-- Name: liste_bon_commande_en_attente; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_bon_commande_en_attente AS
 SELECT bon_commande.id,
    bon_commande.date,
    bon_commande.etat,
    bon_commande.idpayement,
    bon_commande.delailivarison
   FROM public.bon_commande
  WHERE (bon_commande.etat < 40);


ALTER TABLE public.liste_bon_commande_en_attente OWNER TO postgres;

--
-- Name: liste_bon_commande_en_cours; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_bon_commande_en_cours AS
 SELECT bon_commande.id,
    bon_commande.date,
    bon_commande.etat,
    bon_commande.idpayement,
    bon_commande.delailivarison,
    bon_commande.type
   FROM public.bon_commande
  WHERE (bon_commande.etat = 40);


ALTER TABLE public.liste_bon_commande_en_cours OWNER TO postgres;

--
-- Name: liste_bon_commande_terminer; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_bon_commande_terminer AS
 SELECT bon_commande.id,
    bon_commande.date,
    bon_commande.etat,
    bon_commande.idpayement,
    bon_commande.delailivarison,
    bon_commande.type
   FROM public.bon_commande
  WHERE (bon_commande.etat = 45);


ALTER TABLE public.liste_bon_commande_terminer OWNER TO postgres;

--
-- Name: liste_caisse_magasin; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_caisse_magasin AS
 SELECT c.idmagasin,
    ca.id,
    ca.nom,
    ca.idcompte,
    c.etat
   FROM (public.caisse_magasin c
     JOIN public.caisse ca ON (((c.idcaisse)::text = (ca.id)::text)));


ALTER TABLE public.liste_caisse_magasin OWNER TO postgres;

--
-- Name: liste_contrat_a_renouveler; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_contrat_a_renouveler AS
 SELECT ce.id,
    ce.id_emp,
    ce.lieu_travail,
    ce.date_debut,
    ce.date_fin,
    ce.obligation,
    ce.superieur,
    e.etat
   FROM (public.contrat_essaie ce
     JOIN public.employer e ON (((ce.id_emp)::text = (e.id_emp)::text)))
  WHERE (e.etat = 15);


ALTER TABLE public.liste_contrat_a_renouveler OWNER TO postgres;

--
-- Name: liste_demande; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_demande AS
 SELECT demande.date,
    demande.nom,
    demande.iddemande,
    demande.etat
   FROM public.demande
  GROUP BY demande.date, demande.nom, demande.iddemande, demande.etat;


ALTER TABLE public.liste_demande OWNER TO postgres;

--
-- Name: liste_demande_en_attente_proformat; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_demande_en_attente_proformat AS
 SELECT l.date,
    l.nom,
    l.iddemande,
    l.etat
   FROM (public.demande_proformat d
     JOIN public.liste_demande l ON (((d.iddemande)::text = (l.iddemande)::text)))
  WHERE (l.etat = 1);


ALTER TABLE public.liste_demande_en_attente_proformat OWNER TO postgres;

--
-- Name: liste_prix_proformat_min; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_prix_proformat_min AS
 SELECT proformat.iddemande,
    proformat.idarticle,
    min(proformat.prixunitaire) AS prix_minimum
   FROM public.proformat
  GROUP BY proformat.iddemande, proformat.idarticle;


ALTER TABLE public.liste_prix_proformat_min OWNER TO postgres;

--
-- Name: liste_meilleur_proformat; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_meilleur_proformat AS
 SELECT f1.id,
    f1.iddemande,
    f1.idfournisseur,
    f1.idarticle,
    f2.prix_minimum AS prixunitaire,
    f1.tva,
    f1.date
   FROM (public.proformat f1
     JOIN public.liste_prix_proformat_min f2 ON ((((f1.iddemande)::text = (f2.iddemande)::text) AND ((f1.idarticle)::text = (f2.idarticle)::text) AND (f1.prixunitaire = f2.prix_minimum))));


ALTER TABLE public.liste_meilleur_proformat OWNER TO postgres;

--
-- Name: prix_minimum_proformat; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.prix_minimum_proformat AS
 SELECT DISTINCT l.id,
    l.iddemande,
    l.idfournisseur,
    l.idarticle,
    b.nombre AS quantite,
    l.prixunitaire,
    l.tva,
    ((b.nombre)::double precision * l.prixunitaire) AS prixht,
    ((l.prixunitaire * ((l.tva + (100)::double precision) / (100)::double precision)) * (b.nombre)::double precision) AS prixat
   FROM (public.liste_meilleur_proformat l
     JOIN public.liste_besoin_achat_avec_quantite b ON ((((l.iddemande)::text = (b.iddemande)::text) AND ((l.idarticle)::text = (b.idarticle)::text))));


ALTER TABLE public.prix_minimum_proformat OWNER TO postgres;

--
-- Name: liste_details_bon_de_commande; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_details_bon_de_commande AS
 SELECT d.id AS iddetails,
    d.idboncommande,
    p.id,
    p.iddemande,
    p.idfournisseur,
    p.idarticle,
    p.quantite,
    p.prixunitaire,
    p.tva,
    p.prixht,
    p.prixat
   FROM (public.details_bon_commande d
     JOIN public.prix_minimum_proformat p ON ((d.idproformat = p.id)))
  WHERE (d.etat = 8);


ALTER TABLE public.liste_details_bon_de_commande OWNER TO postgres;

--
-- Name: liste_personnel; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_personnel AS
 SELECT employer.id_emp,
    employer.idclient,
    employer.cin,
    employer.telephone,
    employer.adresse,
    employer.etat
   FROM public.employer
  WHERE (employer.etat = 20);


ALTER TABLE public.liste_personnel OWNER TO postgres;

--
-- Name: sous_categorie_type; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sous_categorie_type (
    id integer NOT NULL,
    type character varying(50),
    idcategorie character varying(10),
    etat integer DEFAULT 8
);


ALTER TABLE public.sous_categorie_type OWNER TO postgres;

--
-- Name: liste_sous_categorie_par_type; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_sous_categorie_par_type AS
 SELECT s.type,
    s.idcategorie,
    c.categorie
   FROM (public.sous_categorie_type s
     JOIN public.categorie c ON (((s.idcategorie)::text = (c.id)::text)));


ALTER TABLE public.liste_sous_categorie_par_type OWNER TO postgres;

--
-- Name: liste_total_entre_article_achat; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_total_entre_article_achat AS
 SELECT entre.article,
    sum(entre.quantite) AS quantite
   FROM public.entre
  WHERE (entre.module = 8)
  GROUP BY entre.article;


ALTER TABLE public.liste_total_entre_article_achat OWNER TO postgres;

--
-- Name: liste_total_entre_article_departement; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_total_entre_article_departement AS
 SELECT entre.article,
    sum(entre.quantite) AS quantite
   FROM public.entre
  WHERE (entre.module <> 8)
  GROUP BY entre.article;


ALTER TABLE public.liste_total_entre_article_departement OWNER TO postgres;

--
-- Name: seqsortie; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seqsortie
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seqsortie OWNER TO postgres;

--
-- Name: sortie; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sortie (
    id character varying(256) DEFAULT ('S'::text || lpad((nextval('public.seqsortie'::regclass))::text, 3, '0'::text)) NOT NULL,
    dates date,
    entre character varying(256),
    article character varying(10),
    quantite integer,
    types_sortie integer
);


ALTER TABLE public.sortie OWNER TO postgres;

--
-- Name: liste_total_sortie_article_achat; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_total_sortie_article_achat AS
 SELECT sortie.article,
    sum(sortie.quantite) AS quantite
   FROM public.sortie
  WHERE (sortie.types_sortie = 2)
  GROUP BY sortie.article;


ALTER TABLE public.liste_total_sortie_article_achat OWNER TO postgres;

--
-- Name: liste_total_sortie_article_departement; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liste_total_sortie_article_departement AS
 SELECT sortie.article,
    sum(sortie.quantite) AS quantite
   FROM public.sortie
  WHERE (sortie.types_sortie = 1)
  GROUP BY sortie.article;


ALTER TABLE public.liste_total_sortie_article_departement OWNER TO postgres;

--
-- Name: livarison_attente; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.livarison_attente AS
 SELECT liste_bon_commande_en_cours.id,
    liste_bon_commande_en_cours.date,
    liste_bon_commande_en_cours.etat,
    liste_bon_commande_en_cours.idpayement,
    liste_bon_commande_en_cours.delailivarison,
    (liste_bon_commande_en_cours.date + (liste_bon_commande_en_cours.delailivarison * '1 day'::interval)) AS fin_delai
   FROM public.liste_bon_commande_en_cours;


ALTER TABLE public.livarison_attente OWNER TO postgres;

--
-- Name: livreur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.livreur (
    id integer NOT NULL,
    nom character varying(255),
    contact character varying(255),
    id_fournisseur integer
);


ALTER TABLE public.livreur OWNER TO postgres;

--
-- Name: livreur_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.livreur_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.livreur_id_seq OWNER TO postgres;

--
-- Name: livreur_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.livreur_id_seq OWNED BY public.livreur.id;


--
-- Name: magasin; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.magasin (
    id character varying(10) NOT NULL,
    nom character varying(20),
    lieu character varying(150),
    date date
);


ALTER TABLE public.magasin OWNER TO postgres;

--
-- Name: majoration_nuit; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.majoration_nuit (
    id integer NOT NULL,
    debut integer,
    fin integer,
    majoration double precision DEFAULT 0,
    date date
);


ALTER TABLE public.majoration_nuit OWNER TO postgres;

--
-- Name: majoration_nuit_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.majoration_nuit_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.majoration_nuit_id_seq OWNER TO postgres;

--
-- Name: majoration_nuit_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.majoration_nuit_id_seq OWNED BY public.majoration_nuit.id;


--
-- Name: method; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.method (
    types character varying,
    id integer NOT NULL
);


ALTER TABLE public.method OWNER TO postgres;

--
-- Name: method_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.method_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.method_id_seq OWNER TO postgres;

--
-- Name: method_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.method_id_seq OWNED BY public.method.id;


--
-- Name: module_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.module_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.module_id_seq OWNER TO postgres;

--
-- Name: module_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.module_id_seq OWNED BY public.module.id;


--
-- Name: mouvement; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mouvement (
    idmouvements integer NOT NULL,
    type character varying(20),
    dates date,
    produits character varying(20),
    quantite integer,
    prix double precision,
    idreception character varying
);


ALTER TABLE public.mouvement OWNER TO postgres;

--
-- Name: mouvement_idmouvements_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.mouvement_idmouvements_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.mouvement_idmouvements_seq OWNER TO postgres;

--
-- Name: mouvement_idmouvements_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.mouvement_idmouvements_seq OWNED BY public.mouvement.idmouvements;


--
-- Name: nationalite; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.nationalite (
    id integer NOT NULL,
    type character varying(50)
);


ALTER TABLE public.nationalite OWNER TO postgres;

--
-- Name: nationalite_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.nationalite_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.nationalite_id_seq OWNER TO postgres;

--
-- Name: nationalite_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.nationalite_id_seq OWNED BY public.nationalite.id;


--
-- Name: note_cv; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.note_cv (
    id integer NOT NULL,
    idcv integer,
    note double precision DEFAULT 0
);


ALTER TABLE public.note_cv OWNER TO postgres;

--
-- Name: note_cv_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.note_cv_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.note_cv_id_seq OWNER TO postgres;

--
-- Name: note_cv_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.note_cv_id_seq OWNED BY public.note_cv.id;


--
-- Name: ok_vita; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ok_vita (
    id_o integer NOT NULL,
    id_e integer NOT NULL,
    id_et integer NOT NULL
);


ALTER TABLE public.ok_vita OWNER TO postgres;

--
-- Name: ok_vita_id_o_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ok_vita_id_o_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ok_vita_id_o_seq OWNER TO postgres;

--
-- Name: ok_vita_id_o_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ok_vita_id_o_seq OWNED BY public.ok_vita.id_o;


--
-- Name: pointage; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pointage (
    id integer NOT NULL,
    id_employer character varying(100),
    date timestamp without time zone,
    etat integer,
    jour_nuit integer,
    securite integer
);


ALTER TABLE public.pointage OWNER TO postgres;

--
-- Name: pointage_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pointage_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pointage_id_seq OWNER TO postgres;

--
-- Name: pointage_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pointage_id_seq OWNED BY public.pointage.id;


--
-- Name: poste; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.poste (
    id integer NOT NULL,
    type character varying(50)
);


ALTER TABLE public.poste OWNER TO postgres;

--
-- Name: poste_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.poste_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.poste_id_seq OWNER TO postgres;

--
-- Name: poste_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.poste_id_seq OWNED BY public.poste.id;


--
-- Name: prime; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prime (
    id integer NOT NULL,
    id_employe character varying(200),
    type integer,
    montant double precision DEFAULT 0,
    date date
);


ALTER TABLE public.prime OWNER TO postgres;

--
-- Name: prime_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.prime_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.prime_id_seq OWNER TO postgres;

--
-- Name: prime_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.prime_id_seq OWNED BY public.prime.id;


--
-- Name: proche; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.proche (
    id integer NOT NULL,
    id_emp character varying(200),
    nom character varying(50),
    prenom character varying(50),
    datedenaissance date,
    idgenre character varying(50),
    etat integer
);


ALTER TABLE public.proche OWNER TO postgres;

--
-- Name: proche_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.proche_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.proche_id_seq OWNER TO postgres;

--
-- Name: proche_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.proche_id_seq OWNED BY public.proche.id;


--
-- Name: proformat_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.proformat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.proformat_id_seq OWNER TO postgres;

--
-- Name: proformat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.proformat_id_seq OWNED BY public.proformat.id;


--
-- Name: pv_utilisation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pv_utilisation (
    id character varying(10) NOT NULL,
    reception character varying(10),
    module integer,
    date date
);


ALTER TABLE public.pv_utilisation OWNER TO postgres;

--
-- Name: qcm_admis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.qcm_admis (
    id_qcm integer NOT NULL,
    titre character varying(200) NOT NULL,
    description character varying(200) NOT NULL,
    durer integer NOT NULL,
    note_total integer NOT NULL,
    id_annonce integer NOT NULL
);


ALTER TABLE public.qcm_admis OWNER TO postgres;

--
-- Name: qcm_admis_id_qcm_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.qcm_admis_id_qcm_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.qcm_admis_id_qcm_seq OWNER TO postgres;

--
-- Name: qcm_admis_id_qcm_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.qcm_admis_id_qcm_seq OWNED BY public.qcm_admis.id_qcm;


--
-- Name: qcm_result; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.qcm_result (
    id_r integer NOT NULL,
    qcm integer NOT NULL,
    notes_r integer DEFAULT 0
);


ALTER TABLE public.qcm_result OWNER TO postgres;

--
-- Name: qcm_result_id_r_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.qcm_result_id_r_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.qcm_result_id_r_seq OWNER TO postgres;

--
-- Name: qcm_result_id_r_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.qcm_result_id_r_seq OWNED BY public.qcm_result.id_r;


--
-- Name: question_posee; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.question_posee (
    id_q integer NOT NULL,
    questions character varying(200) NOT NULL,
    id_qcm integer NOT NULL,
    note integer DEFAULT 5
);


ALTER TABLE public.question_posee OWNER TO postgres;

--
-- Name: question_pos‚e_id_q_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."question_pos‚e_id_q_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."question_pos‚e_id_q_seq" OWNER TO postgres;

--
-- Name: question_pos‚e_id_q_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."question_pos‚e_id_q_seq" OWNED BY public.question_posee.id_q;


--
-- Name: region; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.region (
    id integer NOT NULL,
    type character varying(50)
);


ALTER TABLE public.region OWNER TO postgres;

--
-- Name: region_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.region_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.region_id_seq OWNER TO postgres;

--
-- Name: region_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.region_id_seq OWNED BY public.region.id;


--
-- Name: reponse_faux; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.reponse_faux (
    id_f integer NOT NULL,
    id_q integer NOT NULL,
    reponse_f character varying(200) NOT NULL,
    note integer DEFAULT 0
);


ALTER TABLE public.reponse_faux OWNER TO postgres;

--
-- Name: reponse_faux_id_f_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.reponse_faux_id_f_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reponse_faux_id_f_seq OWNER TO postgres;

--
-- Name: reponse_faux_id_f_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.reponse_faux_id_f_seq OWNED BY public.reponse_faux.id_f;


--
-- Name: reponse_q; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.reponse_q (
    id_r integer NOT NULL,
    id_question integer NOT NULL,
    reponse character varying(200) NOT NULL,
    note integer DEFAULT 0
);


ALTER TABLE public.reponse_q OWNER TO postgres;

--
-- Name: reponse_q_id_r_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.reponse_q_id_r_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reponse_q_id_r_seq OWNER TO postgres;

--
-- Name: reponse_q_id_r_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.reponse_q_id_r_seq OWNED BY public.reponse_q.id_r;


--
-- Name: reste_argents; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.reste_argents AS
 SELECT finance.idcompte,
    sum(finance.entre) AS entre,
    sum(finance.sortie) AS sortie,
    (sum(finance.entre) - sum(finance.sortie)) AS reste
   FROM public.finance
  GROUP BY finance.idcompte;


ALTER TABLE public.reste_argents OWNER TO postgres;

--
-- Name: reste_argents_avec_nom_compte; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.reste_argents_avec_nom_compte AS
 SELECT r.idcompte,
    c.nom,
    r.entre,
    r.sortie,
    r.reste
   FROM (public.reste_argents r
     JOIN public.compte c ON (((r.idcompte)::text = (c.id)::text)));


ALTER TABLE public.reste_argents_avec_nom_compte OWNER TO postgres;

--
-- Name: retenu_cnaps; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.retenu_cnaps (
    id integer NOT NULL,
    plafond double precision DEFAULT 0,
    date date
);


ALTER TABLE public.retenu_cnaps OWNER TO postgres;

--
-- Name: retenu_cnaps_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.retenu_cnaps_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.retenu_cnaps_id_seq OWNER TO postgres;

--
-- Name: retenu_cnaps_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.retenu_cnaps_id_seq OWNED BY public.retenu_cnaps.id;


--
-- Name: salaire; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.salaire (
    id integer NOT NULL,
    id_emp character varying(200),
    brut double precision DEFAULT 0,
    net double precision DEFAULT 0,
    date date
);


ALTER TABLE public.salaire OWNER TO postgres;

--
-- Name: salaire_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.salaire_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.salaire_id_seq OWNER TO postgres;

--
-- Name: salaire_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.salaire_id_seq OWNED BY public.salaire.id;


--
-- Name: seq_pv_utilisation; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_pv_utilisation
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_pv_utilisation OWNER TO postgres;

--
-- Name: seqboncommande; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seqboncommande
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seqboncommande OWNER TO postgres;

--
-- Name: seqbonlivraison; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seqbonlivraison
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seqbonlivraison OWNER TO postgres;

--
-- Name: seqbonreception; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seqbonreception
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seqbonreception OWNER TO postgres;

--
-- Name: seqcaisse; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seqcaisse
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seqcaisse OWNER TO postgres;

--
-- Name: seqcnaps; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seqcnaps
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seqcnaps OWNER TO postgres;

--
-- Name: seqcompte; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seqcompte
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seqcompte OWNER TO postgres;

--
-- Name: seqconso; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seqconso
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seqconso OWNER TO postgres;

--
-- Name: seqdemande; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seqdemande
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seqdemande OWNER TO postgres;

--
-- Name: seqemploye; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seqemploye
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seqemploye OWNER TO postgres;

--
-- Name: seqmagasin; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seqmagasin
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seqmagasin OWNER TO postgres;

--
-- Name: seqnumero; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seqnumero
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seqnumero OWNER TO postgres;

--
-- Name: seqpvreception; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seqpvreception
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seqpvreception OWNER TO postgres;

--
-- Name: seqvente; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seqvente
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seqvente OWNER TO postgres;

--
-- Name: service; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.service (
    id integer NOT NULL,
    type character varying(50)
);


ALTER TABLE public.service OWNER TO postgres;

--
-- Name: service_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.service_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_id_seq OWNER TO postgres;

--
-- Name: service_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.service_id_seq OWNED BY public.service.id;


--
-- Name: situation_matrimoniale; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.situation_matrimoniale (
    id integer NOT NULL,
    type character varying(50)
);


ALTER TABLE public.situation_matrimoniale OWNER TO postgres;

--
-- Name: situation_matrimoniale_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.situation_matrimoniale_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.situation_matrimoniale_id_seq OWNER TO postgres;

--
-- Name: situation_matrimoniale_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.situation_matrimoniale_id_seq OWNED BY public.situation_matrimoniale.id;


--
-- Name: solde_conge; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.solde_conge (
    id integer NOT NULL,
    idconge integer,
    conge_consomme double precision,
    solde_actuel double precision
);


ALTER TABLE public.solde_conge OWNER TO postgres;

--
-- Name: solde_conge_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.solde_conge_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.solde_conge_id_seq OWNER TO postgres;

--
-- Name: solde_conge_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.solde_conge_id_seq OWNED BY public.solde_conge.id;


--
-- Name: sortie_departement; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sortie_departement (
    id integer NOT NULL,
    sortie_details character varying(256),
    module integer
);


ALTER TABLE public.sortie_departement OWNER TO postgres;

--
-- Name: sortie_departement_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sortie_departement_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sortie_departement_id_seq OWNER TO postgres;

--
-- Name: sortie_departement_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sortie_departement_id_seq OWNED BY public.sortie_departement.id;


--
-- Name: sortie_vente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sortie_vente (
    id character varying(50) DEFAULT ('V'::text || lpad((nextval('public.seqvente'::regclass))::text, 3, '0'::text)) NOT NULL,
    lieu_vente character varying(200),
    prix_unitaire double precision,
    tva_origine integer,
    prix_ttc double precision,
    montanttotal double precision,
    date date,
    article character varying(10),
    quantite double precision DEFAULT 0,
    numero_caisse character varying(10)
);


ALTER TABLE public.sortie_vente OWNER TO postgres;

--
-- Name: sous_categorie_type_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sous_categorie_type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sous_categorie_type_id_seq OWNER TO postgres;

--
-- Name: sous_categorie_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sous_categorie_type_id_seq OWNED BY public.sous_categorie_type.id;


--
-- Name: tafiditra_mpiasa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tafiditra_mpiasa (
    id_taf integer NOT NULL,
    id_ok integer NOT NULL,
    dates date NOT NULL
);


ALTER TABLE public.tafiditra_mpiasa OWNER TO postgres;

--
-- Name: tafiditra_mpiasa_id_taf_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tafiditra_mpiasa_id_taf_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tafiditra_mpiasa_id_taf_seq OWNER TO postgres;

--
-- Name: tafiditra_mpiasa_id_taf_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tafiditra_mpiasa_id_taf_seq OWNED BY public.tafiditra_mpiasa.id_taf;


--
-- Name: tranche_irsa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tranche_irsa (
    id integer NOT NULL,
    debut double precision DEFAULT 0,
    fin double precision DEFAULT 0,
    majoration double precision DEFAULT 0,
    date date
);


ALTER TABLE public.tranche_irsa OWNER TO postgres;

--
-- Name: tranche_irsa_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tranche_irsa_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tranche_irsa_id_seq OWNER TO postgres;

--
-- Name: tranche_irsa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tranche_irsa_id_seq OWNED BY public.tranche_irsa.id;


--
-- Name: type_ammortissement; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.type_ammortissement (
    id integer NOT NULL,
    nom character varying(155)
);


ALTER TABLE public.type_ammortissement OWNER TO postgres;

--
-- Name: type_avantage_nature; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.type_avantage_nature (
    id integer NOT NULL,
    type character varying(50)
);


ALTER TABLE public.type_avantage_nature OWNER TO postgres;

--
-- Name: type_avantage_nature_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.type_avantage_nature_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.type_avantage_nature_id_seq OWNER TO postgres;

--
-- Name: type_avantage_nature_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.type_avantage_nature_id_seq OWNED BY public.type_avantage_nature.id;


--
-- Name: type_conge; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.type_conge (
    id integer NOT NULL,
    nom character varying(150),
    politique character varying(250),
    commentaires character varying(250),
    day_default double precision
);


ALTER TABLE public.type_conge OWNER TO postgres;

--
-- Name: type_conge_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.type_conge_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.type_conge_id_seq OWNER TO postgres;

--
-- Name: type_conge_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.type_conge_id_seq OWNED BY public.type_conge.id;


--
-- Name: type_contrat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.type_contrat (
    id integer NOT NULL,
    nom character varying(250),
    acronyme character varying(50)
);


ALTER TABLE public.type_contrat OWNER TO postgres;

--
-- Name: type_contrat_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.type_contrat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.type_contrat_id_seq OWNER TO postgres;

--
-- Name: type_contrat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.type_contrat_id_seq OWNED BY public.type_contrat.id;


--
-- Name: type_demande; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.type_demande AS
 SELECT demande.iddemande,
    demande.nom,
    demande.type
   FROM public.demande
  GROUP BY demande.iddemande, demande.type, demande.nom;


ALTER TABLE public.type_demande OWNER TO postgres;

--
-- Name: type_immobilisation; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.type_immobilisation AS
 SELECT c.id,
    c.nom,
    c.etat
   FROM (public.compte_mere_immobilisation i
     JOIN public.compte c ON ((i.id = (c.id)::text)));


ALTER TABLE public.type_immobilisation OWNER TO postgres;

--
-- Name: type_prime; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.type_prime (
    id integer NOT NULL,
    prime character varying(25)
);


ALTER TABLE public.type_prime OWNER TO postgres;

--
-- Name: type_prime_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.type_prime_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.type_prime_id_seq OWNER TO postgres;

--
-- Name: type_prime_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.type_prime_id_seq OWNED BY public.type_prime.id;


--
-- Name: type_sortie; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.type_sortie (
    id integer NOT NULL,
    types character varying(20)
);


ALTER TABLE public.type_sortie OWNER TO postgres;

--
-- Name: type_sortie_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.type_sortie_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.type_sortie_id_seq OWNER TO postgres;

--
-- Name: type_sortie_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.type_sortie_id_seq OWNED BY public.type_sortie.id;


--
-- Name: v_departement; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_departement AS
 SELECT s.id,
    s.dates,
    s.article,
    article.article AS nom_article,
    s.quantite,
    module.type
   FROM (((public.sortie_departement
     JOIN public.sortie s ON (((sortie_departement.sortie_details)::text = (s.id)::text)))
     JOIN public.module ON ((sortie_departement.module = module.id)))
     JOIN public.article ON (((s.article)::text = (article.id)::text)));


ALTER TABLE public.v_departement OWNER TO postgres;

--
-- Name: v_details_bon_commande_avec_proforma; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_details_bon_commande_avec_proforma AS
 SELECT details_bon_commande.id,
    details_bon_commande.idboncommande,
    details_bon_commande.idproformat,
    details_bon_commande.etat,
    bon_commande.date AS date_bon_commande,
    proformat.iddemande,
    proformat.idfournisseur,
    proformat.idarticle,
    proformat.prixunitaire,
    proformat.tva,
    proformat.date AS date_proformat
   FROM ((public.bon_commande
     JOIN public.details_bon_commande ON (((details_bon_commande.idboncommande)::text = (bon_commande.id)::text)))
     JOIN public.proformat ON ((details_bon_commande.idproformat = proformat.id)));


ALTER TABLE public.v_details_bon_commande_avec_proforma OWNER TO postgres;

--
-- Name: v_details_bon_commande_avec_proforma_avec_quantite; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_details_bon_commande_avec_proforma_avec_quantite AS
 SELECT v.id,
    v.idboncommande,
    v.idproformat,
    v.etat,
    v.date_bon_commande,
    v.iddemande,
    v.idfournisseur,
    v.idarticle,
    v.prixunitaire,
    v.tva,
    v.date_proformat,
    l.nombre
   FROM (public.v_details_bon_commande_avec_proforma v
     JOIN public.liste_besoin_achat_avec_quantite l ON (((v.idarticle)::text = (l.idarticle)::text)))
  WHERE ((l.iddemande)::text = (v.iddemande)::text);


ALTER TABLE public.v_details_bon_commande_avec_proforma_avec_quantite OWNER TO postgres;

--
-- Name: v_details_bon_reception; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_details_bon_reception AS
 SELECT bon_reception.id,
    bon_reception.lieu,
    bon_reception.date,
    bon_reception.id_bon_commande,
    bon_reception.id_recepteur,
    bon_reception.etat,
    details_bon_reception.id_article,
    details_bon_reception.id_fournisseur
   FROM (public.bon_reception
     JOIN public.details_bon_reception ON (((bon_reception.id)::text = (details_bon_reception.id_bon_reception)::text)));


ALTER TABLE public.v_details_bon_reception OWNER TO postgres;

--
-- Name: v_details_bon_reception_details; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_details_bon_reception_details AS
 SELECT bon_reception.id,
    bon_reception.lieu,
    bon_reception.date AS date_reception,
    bon_commande.date AS date_commande,
    details_bon_commande.idproformat AS proformat,
    proformat.prixunitaire,
    proformat.idarticle AS article,
    article.article AS nom_article,
    proformat.idfournisseur AS fournisseur,
    proformat.iddemande AS demande,
    proformat.tva,
    liste_besoin_achat_avec_quantite_idmodule.nombre AS quantite_article,
    module.id AS id_module,
    module.type AS module
   FROM ((((((public.bon_reception
     JOIN public.bon_commande ON (((bon_reception.id_bon_commande)::text = (bon_commande.id)::text)))
     JOIN public.details_bon_commande ON (((bon_reception.id_bon_commande)::text = (details_bon_commande.idboncommande)::text)))
     JOIN public.proformat ON ((details_bon_commande.idproformat = proformat.id)))
     JOIN public.article ON (((proformat.idarticle)::text = (article.id)::text)))
     JOIN public.liste_besoin_achat_avec_quantite_idmodule ON (((proformat.iddemande)::text = (liste_besoin_achat_avec_quantite_idmodule.iddemande)::text)))
     JOIN public.module ON ((liste_besoin_achat_avec_quantite_idmodule.idmodule = module.id)))
  WHERE ((proformat.idarticle)::text = (liste_besoin_achat_avec_quantite_idmodule.idarticle)::text);


ALTER TABLE public.v_details_bon_reception_details OWNER TO postgres;

--
-- Name: v_entre; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_entre AS
 SELECT entre.id,
    entre.dates,
    entre.reception,
    entre.article,
    entre.quantite,
    entre.prix_unitaire,
    entre.montant,
    entre.module,
    article.article AS nom_article,
    module.type
   FROM ((public.entre
     JOIN public.article ON (((entre.article)::text = (article.id)::text)))
     JOIN public.module ON ((entre.module = module.id)));


ALTER TABLE public.v_entre OWNER TO postgres;

--
-- Name: v_liste_details_bon_de_commande_restante; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_liste_details_bon_de_commande_restante AS
 SELECT ld.iddetails,
    ld.idboncommande,
    ld.id,
    ld.iddemande,
    ld.idfournisseur,
    ld.idarticle,
    ld.quantite,
    ld.prixunitaire,
    ld.tva,
    ld.prixht,
    ld.prixat,
    COALESCE(qr.quantite_recue, (0)::double precision) AS quantite_recue,
    ((ld.quantite)::double precision - COALESCE(qr.quantite_recue, (0)::double precision)) AS quantite_restante
   FROM (public.liste_details_bon_de_commande ld
     LEFT JOIN ( SELECT pv_reception.id_bon_commande,
            pv_reception.id_article,
            sum(pv_reception.quantite) AS quantite_recue
           FROM public.pv_reception
          GROUP BY pv_reception.id_bon_commande, pv_reception.id_article) qr ON ((((ld.idboncommande)::text = (qr.id_bon_commande)::text) AND ((ld.idarticle)::text = (qr.id_article)::text))));


ALTER TABLE public.v_liste_details_bon_de_commande_restante OWNER TO postgres;

--
-- Name: v_sortie; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_sortie AS
 SELECT sortie.id,
    sortie.dates,
    sortie.entre,
    sortie.article,
    sortie.quantite,
    sortie.types_sortie,
    article.article AS nom,
    type_sortie.types
   FROM ((public.sortie
     JOIN public.article ON (((sortie.article)::text = (article.id)::text)))
     JOIN public.type_sortie ON ((sortie.types_sortie = type_sortie.id)));


ALTER TABLE public.v_sortie OWNER TO postgres;

--
-- Name: view_pv_utilisation_valider; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.view_pv_utilisation_valider AS
 SELECT pv_utilisation.id,
    pv_utilisation.reception,
    pv_utilisation.module,
    pv_utilisation.date,
    details_utilisation.iddu,
    details_utilisation.pv_utilisation,
    details_utilisation.immobilisation,
    details_utilisation.description,
    details_utilisation.etat_immobilisation,
    details_utilisation.etat
   FROM (public.pv_utilisation
     JOIN public.details_utilisation ON (((pv_utilisation.id)::text = (details_utilisation.pv_utilisation)::text)));


ALTER TABLE public.view_pv_utilisation_valider OWNER TO postgres;

--
-- Name: view_detail_utilisation; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.view_detail_utilisation AS
 SELECT view_pv_utilisation_valider.id,
    view_pv_utilisation_valider.reception,
    view_pv_utilisation_valider.module,
    view_pv_utilisation_valider.date,
    view_pv_utilisation_valider.iddu,
    view_pv_utilisation_valider.pv_utilisation,
    view_pv_utilisation_valider.immobilisation,
    view_pv_utilisation_valider.description,
    view_pv_utilisation_valider.etat_immobilisation,
    view_pv_utilisation_valider.etat,
    module.type,
    etat_immobilisation.nom AS type_etat
   FROM ((public.view_pv_utilisation_valider
     JOIN public.module ON ((view_pv_utilisation_valider.module = module.id)))
     JOIN public.etat_immobilisation ON ((view_pv_utilisation_valider.etat_immobilisation = etat_immobilisation.id)));


ALTER TABLE public.view_detail_utilisation OWNER TO postgres;

--
-- Name: ville; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ville (
    id integer NOT NULL,
    idregion integer,
    type character varying(50)
);


ALTER TABLE public.ville OWNER TO postgres;

--
-- Name: ville_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ville_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ville_id_seq OWNER TO postgres;

--
-- Name: ville_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ville_id_seq OWNED BY public.ville.id;


--
-- Name: administrateur id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.administrateur ALTER COLUMN id SET DEFAULT nextval('public.administrateur_id_seq'::regclass);


--
-- Name: afaka_qcm id_as; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.afaka_qcm ALTER COLUMN id_as SET DEFAULT nextval('public.afaka_qcm_id_as_seq'::regclass);


--
-- Name: avance id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.avance ALTER COLUMN id SET DEFAULT nextval('public.avance_id_seq'::regclass);


--
-- Name: avantage_nature id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.avantage_nature ALTER COLUMN id SET DEFAULT nextval('public.avantage_nature_id_seq'::regclass);


--
-- Name: besoin id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin ALTER COLUMN id SET DEFAULT nextval('public.besoin_id_seq'::regclass);


--
-- Name: besoin_achat id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin_achat ALTER COLUMN id SET DEFAULT nextval('public.besoin_achat_id_seq'::regclass);


--
-- Name: besoin_immobilisation id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin_immobilisation ALTER COLUMN id SET DEFAULT nextval('public.besoin_immobilisation_id_seq'::regclass);


--
-- Name: caisse_magasin id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.caisse_magasin ALTER COLUMN id SET DEFAULT nextval('public.caisse_magasin_id_seq'::regclass);


--
-- Name: client id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client ALTER COLUMN id SET DEFAULT nextval('public.client_id_seq'::regclass);


--
-- Name: confirmation_date id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.confirmation_date ALTER COLUMN id SET DEFAULT nextval('public.confirmation_date_id_seq'::regclass);


--
-- Name: conge id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conge ALTER COLUMN id SET DEFAULT nextval('public.conge_id_seq'::regclass);


--
-- Name: contrat_essaie id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrat_essaie ALTER COLUMN id SET DEFAULT nextval('public.contrat_essaie_id_seq'::regclass);


--
-- Name: cv id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cv ALTER COLUMN id SET DEFAULT nextval('public.cv_id_seq'::regclass);


--
-- Name: demande id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.demande ALTER COLUMN id SET DEFAULT nextval('public.demande_id_seq'::regclass);


--
-- Name: description id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.description ALTER COLUMN id SET DEFAULT nextval('public.description_id_seq'::regclass);


--
-- Name: details_besoin_age id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_age ALTER COLUMN id SET DEFAULT nextval('public.details_besoin_age_id_seq'::regclass);


--
-- Name: details_besoin_diplome id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_diplome ALTER COLUMN id SET DEFAULT nextval('public.details_besoin_diplome_id_seq'::regclass);


--
-- Name: details_besoin_experience id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_experience ALTER COLUMN id SET DEFAULT nextval('public.details_besoin_experience_id_seq'::regclass);


--
-- Name: details_besoin_genre id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_genre ALTER COLUMN id SET DEFAULT nextval('public.details_besoin_genre_id_seq'::regclass);


--
-- Name: details_besoin_matrimoniale id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_matrimoniale ALTER COLUMN id SET DEFAULT nextval('public.details_besoin_matrimoniale_id_seq'::regclass);


--
-- Name: details_besoin_nationalite id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_nationalite ALTER COLUMN id SET DEFAULT nextval('public.details_besoin_nationalite_id_seq'::regclass);


--
-- Name: details_besoin_region id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_region ALTER COLUMN id SET DEFAULT nextval('public.details_besoin_region_id_seq'::regclass);


--
-- Name: details_besoin_salaire id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_salaire ALTER COLUMN id SET DEFAULT nextval('public.details_besoin_salaire_id_seq'::regclass);


--
-- Name: details_besoin_ville id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_ville ALTER COLUMN id SET DEFAULT nextval('public.details_besoin_ville_id_seq'::regclass);


--
-- Name: details_bon_commande id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_bon_commande ALTER COLUMN id SET DEFAULT nextval('public.details_bon_commande_id_seq'::regclass);


--
-- Name: details_cv_diplome id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_cv_diplome ALTER COLUMN id SET DEFAULT nextval('public.details_cv_diplome_id_seq'::regclass);


--
-- Name: details_cv_salaire id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_cv_salaire ALTER COLUMN id SET DEFAULT nextval('public.details_cv_salaire_id_seq'::regclass);


--
-- Name: details_cv_travail_anterieur id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_cv_travail_anterieur ALTER COLUMN id SET DEFAULT nextval('public.details_cv_travail_anterieur_id_seq'::regclass);


--
-- Name: details_sortie id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_sortie ALTER COLUMN id SET DEFAULT nextval('public.details_sortie_id_seq'::regclass);


--
-- Name: diplome id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diplome ALTER COLUMN id SET DEFAULT nextval('public.diplome_id_seq'::regclass);


--
-- Name: employer_module id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employer_module ALTER COLUMN id SET DEFAULT nextval('public.employer_module_id_seq'::regclass);


--
-- Name: entretient id_e; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entretient ALTER COLUMN id_e SET DEFAULT nextval('public.entretient_id_e_seq'::regclass);


--
-- Name: etat_immobilisation id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etat_immobilisation ALTER COLUMN id SET DEFAULT nextval('public.etat_immobilisation_id_seq'::regclass);


--
-- Name: etats id_et; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etats ALTER COLUMN id_et SET DEFAULT nextval('public.etats_id_et_seq'::regclass);


--
-- Name: explication id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.explication ALTER COLUMN id SET DEFAULT nextval('public.explication_id_seq'::regclass);


--
-- Name: finance id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.finance ALTER COLUMN id SET DEFAULT nextval('public.finance_id_seq'::regclass);


--
-- Name: fournisseur id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fournisseur ALTER COLUMN id SET DEFAULT nextval('public.fournisseur_id_seq'::regclass);


--
-- Name: historique_bon_commande id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historique_bon_commande ALTER COLUMN id SET DEFAULT nextval('public.historique_bon_commande_id_seq'::regclass);


--
-- Name: historique_embauche id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historique_embauche ALTER COLUMN id SET DEFAULT nextval('public.historique_embauche_id_seq'::regclass);


--
-- Name: impot id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.impot ALTER COLUMN id SET DEFAULT nextval('public.impot_id_seq'::regclass);


--
-- Name: liste_adresse_entreprise id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liste_adresse_entreprise ALTER COLUMN id SET DEFAULT nextval('public.liste_adresse_entreprise_id_seq'::regclass);


--
-- Name: livreur id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.livreur ALTER COLUMN id SET DEFAULT nextval('public.livreur_id_seq'::regclass);


--
-- Name: majoration_nuit id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.majoration_nuit ALTER COLUMN id SET DEFAULT nextval('public.majoration_nuit_id_seq'::regclass);


--
-- Name: method id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.method ALTER COLUMN id SET DEFAULT nextval('public.method_id_seq'::regclass);


--
-- Name: module id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.module ALTER COLUMN id SET DEFAULT nextval('public.module_id_seq'::regclass);


--
-- Name: mouvement idmouvements; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mouvement ALTER COLUMN idmouvements SET DEFAULT nextval('public.mouvement_idmouvements_seq'::regclass);


--
-- Name: nationalite id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nationalite ALTER COLUMN id SET DEFAULT nextval('public.nationalite_id_seq'::regclass);


--
-- Name: note_cv id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.note_cv ALTER COLUMN id SET DEFAULT nextval('public.note_cv_id_seq'::regclass);


--
-- Name: ok_vita id_o; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ok_vita ALTER COLUMN id_o SET DEFAULT nextval('public.ok_vita_id_o_seq'::regclass);


--
-- Name: pointage id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pointage ALTER COLUMN id SET DEFAULT nextval('public.pointage_id_seq'::regclass);


--
-- Name: poste id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.poste ALTER COLUMN id SET DEFAULT nextval('public.poste_id_seq'::regclass);


--
-- Name: prime id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prime ALTER COLUMN id SET DEFAULT nextval('public.prime_id_seq'::regclass);


--
-- Name: proche id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proche ALTER COLUMN id SET DEFAULT nextval('public.proche_id_seq'::regclass);


--
-- Name: proformat id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proformat ALTER COLUMN id SET DEFAULT nextval('public.proformat_id_seq'::regclass);


--
-- Name: qcm_admis id_qcm; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.qcm_admis ALTER COLUMN id_qcm SET DEFAULT nextval('public.qcm_admis_id_qcm_seq'::regclass);


--
-- Name: qcm_result id_r; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.qcm_result ALTER COLUMN id_r SET DEFAULT nextval('public.qcm_result_id_r_seq'::regclass);


--
-- Name: question_posee id_q; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.question_posee ALTER COLUMN id_q SET DEFAULT nextval('public."question_pos‚e_id_q_seq"'::regclass);


--
-- Name: region id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.region ALTER COLUMN id SET DEFAULT nextval('public.region_id_seq'::regclass);


--
-- Name: reponse_faux id_f; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reponse_faux ALTER COLUMN id_f SET DEFAULT nextval('public.reponse_faux_id_f_seq'::regclass);


--
-- Name: reponse_q id_r; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reponse_q ALTER COLUMN id_r SET DEFAULT nextval('public.reponse_q_id_r_seq'::regclass);


--
-- Name: retenu_cnaps id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.retenu_cnaps ALTER COLUMN id SET DEFAULT nextval('public.retenu_cnaps_id_seq'::regclass);


--
-- Name: salaire id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.salaire ALTER COLUMN id SET DEFAULT nextval('public.salaire_id_seq'::regclass);


--
-- Name: service id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service ALTER COLUMN id SET DEFAULT nextval('public.service_id_seq'::regclass);


--
-- Name: situation_matrimoniale id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.situation_matrimoniale ALTER COLUMN id SET DEFAULT nextval('public.situation_matrimoniale_id_seq'::regclass);


--
-- Name: solde_conge id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solde_conge ALTER COLUMN id SET DEFAULT nextval('public.solde_conge_id_seq'::regclass);


--
-- Name: sortie_departement id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sortie_departement ALTER COLUMN id SET DEFAULT nextval('public.sortie_departement_id_seq'::regclass);


--
-- Name: sous_categorie_type id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sous_categorie_type ALTER COLUMN id SET DEFAULT nextval('public.sous_categorie_type_id_seq'::regclass);


--
-- Name: tafiditra_mpiasa id_taf; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tafiditra_mpiasa ALTER COLUMN id_taf SET DEFAULT nextval('public.tafiditra_mpiasa_id_taf_seq'::regclass);


--
-- Name: tranche_irsa id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tranche_irsa ALTER COLUMN id SET DEFAULT nextval('public.tranche_irsa_id_seq'::regclass);


--
-- Name: type_avantage_nature id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type_avantage_nature ALTER COLUMN id SET DEFAULT nextval('public.type_avantage_nature_id_seq'::regclass);


--
-- Name: type_conge id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type_conge ALTER COLUMN id SET DEFAULT nextval('public.type_conge_id_seq'::regclass);


--
-- Name: type_contrat id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type_contrat ALTER COLUMN id SET DEFAULT nextval('public.type_contrat_id_seq'::regclass);


--
-- Name: type_prime id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type_prime ALTER COLUMN id SET DEFAULT nextval('public.type_prime_id_seq'::regclass);


--
-- Name: type_sortie id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type_sortie ALTER COLUMN id SET DEFAULT nextval('public.type_sortie_id_seq'::regclass);


--
-- Name: ville id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ville ALTER COLUMN id SET DEFAULT nextval('public.ville_id_seq'::regclass);


--
-- Data for Name: administrateur; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.administrateur (id, nom, prenom, email, mot_de_passe, idmodule) FROM stdin;
9	RAZAFIMANANTSOA	Rota Volamarosoa	rota@gmail.com	1234	1
10	RAKOTO	Mamy Heritiana	mamy@gmail.com	mamy	5
11	RAKOTONANDRASANA	Fabien	fabien@gmail.com	fabien	7
12	RAFALINIAINA	Faly Tiana	faly@gmail.com	faly	8
13	ANDRIAMANANTSOA	Veroniaina	vero@gmail.com	vero	2
14	RAZAFI	Adr	haingoadr@gmail.com	1234	9
15	ANJARATIANA	Layah	layah@gmail.com	layah	10
\.


--
-- Data for Name: afaka_qcm; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.afaka_qcm (id_as, qcm_r, id_users) FROM stdin;
1	36	1
2	36	2
3	36	4
\.


--
-- Data for Name: article; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.article (id, article, method, types) FROM stdin;
G0001	Gel main	1	FIFO
E0001	Encre	1	FIFO
S0001	Savon	2	LIFO
P0001	Papier A4	2	LIFO
\.


--
-- Data for Name: avance; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.avance (id, id_employe, avance, date) FROM stdin;
1	EMP0000002	100000	2023-10-15
\.


--
-- Data for Name: avantage_nature; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.avantage_nature (id, id_emp, idavantage, date, etat) FROM stdin;
5	EMP0000001	1	2023-10-12	8
6	EMP0000002	3	2023-10-13	8
7	EMP0000003	1	2023-10-13	8
\.


--
-- Data for Name: besoin; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.besoin (id, idposte, idservice, besoin_horaire, heure_jour_homme, description, id_type_contrat) FROM stdin;
1	9	1	300	8	Gerer les developpeurs a chaque projet	1
\.


--
-- Data for Name: besoin_achat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.besoin_achat (id, idmodule, idarticle, nombre, date, etat, iddemande, description) FROM stdin;
2	2	P0001	50	2023-11-01	50	DMD0000001	\N
1	6	P0001	50	2023-11-02	50	DMD0000001	\N
5	8	P0001	500	2023-11-06	50	DMD0000001	\N
6	1	S0001	10	2023-11-11	32	DMD0000002	\N
7	2	P0001	150	2023-11-11	32	DMD0000002	\N
8	7	P0001	200	2023-12-17	32	DMD0000002	\N
10	8	S0001	25	2023-12-23	37	DMD0000012	\N
12	8	G0001	25	2024-01-12	40	DMD0000015	\N
13	8	P0001	5	2024-01-20	32	DMD0000016	Pour faire des impressions
14	8	G0001	50	2024-01-23	32	DMD0000019	Protection contre les maladies
15	8	S0001	5	2024-01-23	32	DMD0000021	Rien
16	10	P0001	50	2024-01-24	28	\N	Pour faire des photocopies
9	8	G0001	2	2023-11-18	45	DMD0000011	\N
11	5	G0001	5	2023-12-13	40	DMD0000014	\N
4	5	G0001	15	2023-11-04	45	DMD0000001	\N
3	2	E0001	12	2023-11-01	45	DMD0000001	\N
\.


--
-- Data for Name: besoin_immobilisation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.besoin_immobilisation (id, idmodule, idimmobilisation, nombre, date, iddemande, etat, description, idcategorie) FROM stdin;
3	8	213	1	2024-01-24	\N	28	Faire des impressions, REF 10	IMP
2	8	212	1	2024-01-23	DMD0000020	32	Voiture MERCEDES, pour faire des transports personnels	VT
1	8	213	4	2024-01-20	DMD0000018	45	Un ordinateur COR-I 5, RAM 8Gb, disque 512 Gb SSD	OD
\.


--
-- Data for Name: bon_commande; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bon_commande (id, date, etat, idpayement, delailivarison, type) FROM stdin;
BC00000004	2023-12-05	45	10	26	100
BC00000007	2023-12-07	45	5	5	100
BOC0000001	2023-12-04	45	10	3	100
BC00000009	2023-12-15	40	5	2	100
BC00000011	2024-01-11	37	5	10	100
BC00000010	2024-01-11	40	5	5	100
BC00000015	2024-01-23	32	5	10	110
BC00000012	2024-01-20	45	10	25	110
\.


--
-- Data for Name: bon_reception; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bon_reception (id, lieu, date, id_bon_commande, id_recepteur, etat) FROM stdin;
BR00000006	J	2023-12-01	BC00000004	12	32
BR00000007	Andoharanofotsy	2023-12-18	BC00000007	12	32
BR00000008	Tanjombato	2023-12-20	BC00000009	12	32
\.


--
-- Data for Name: caisse; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.caisse (id, nom, idcompte) FROM stdin;
CS00000001	Caisse 1	521
CS00000002	Caisse 2	522
\.


--
-- Data for Name: caisse_magasin; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.caisse_magasin (id, idmagasin, idcaisse, etat) FROM stdin;
1	MG00000002	CS00000001	1
\.


--
-- Data for Name: categorie; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categorie (id, categorie) FROM stdin;
OD	Ordinateur
IMP	Imprimerie
VT	Voiture
\.


--
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.client (id, nom, prenom, email, mot_de_passe, date_naissance, idgenre) FROM stdin;
1	ANDRIAMANANTSOA	Tojo	tojo@gmail.com	tojo	2003-10-07	1
2	RAKOTONIRIANA	Sandy	sandy@gmail.com	sandy	1998-02-15	2
3	MAMPIONONA	Natalie	natalie@gmail.com	natalie	2002-10-09	2
4	TANIAH	Fiderana	taniah@gmail.com	fiderana	1997-10-07	1
\.


--
-- Data for Name: clientel; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.clientel (id, prenom, mail, adresse, genres) FROM stdin;
\.


--
-- Data for Name: cnaps; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cnaps (id, id_emp, date, etat) FROM stdin;
CNP0008	EMP0000002	2023-10-27	8
CNP000007	EMP0000001	2023-10-27	8
CNP0000010	EMP0000003	2023-10-27	8
\.


--
-- Data for Name: compte; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.compte (id, nom, etat) FROM stdin;
101	Capital	8
512	BOA	8
521	Caisse 1	8
522	Caisse 2	8
212	Voiture	8
213	Ordinateur	8
211	Batiment	8
\.


--
-- Data for Name: confirmation_date; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.confirmation_date (id, idconge, depart, retour, commentaires) FROM stdin;
1	7	2023-12-11 08:00:00	2023-12-15 17:00:00	Pas de commentaires
\.


--
-- Data for Name: conge; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.conge (id, id_employer, id_type_conge, raison, debut, fin, statut, justificatif) FROM stdin;
7	EMP0000003	8	Vacances en familles	2023-12-11 08:00:00	2023-12-15 17:00:00	21	-2-1699275811-Exercice2.pdf
8	EMP0000003	8	No raison	2023-12-07 06:00:00	2023-12-14 18:00:00	41	-2-1699280937-Exercice2.pdf
\.


--
-- Data for Name: contrat_essaie; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.contrat_essaie (id, id_emp, lieu_travail, date_debut, date_fin, obligation, superieur) FROM stdin;
7	EMP0000001	1	2023-10-01	2023-10-18	Manao ny asa rehetra ao	
8	EMP0000002	2	2023-10-01	2023-10-17	Mikarakara	EMP0000001
9	EMP0000003	1	2022-10-01	2023-10-25	Maka cafe	EMP0000001
\.


--
-- Data for Name: cv; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cv (id, idclient, idbesoin, iddiplome, experiences, idmatrimoniale, idville) FROM stdin;
17	1	1	3	0	1	4
18	2	1	4	3	2	4
19	4	1	3	2	1	4
\.


--
-- Data for Name: demande; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.demande (id, date, nom, iddemande, idfournisseur, etat, type) FROM stdin;
7	2023-11-18	Demande	DMD0000002	1	1	100
8	2023-11-18	Demande	DMD0000002	3	1	100
9	2023-11-18	Demande	DMD0000002	5	1	100
10	2023-12-01	Proforma pour du gel	DMD0000011	2	1	100
11	2023-12-01	Proforma pour du gel	DMD0000011	5	1	100
12	2023-12-25	les outils necessaires	DMD0000012	1	1	100
13	2023-12-25	les outils necessaires	DMD0000012	2	1	100
14	2023-12-25	les outils necessaires	DMD0000012	5	1	100
1	2023-11-10	Besoin des departements	DMD0000001	2	5	100
2	2023-11-10	Besoin des departements	DMD0000001	5	5	100
3	2023-11-10	Besoin des departements	DMD0000001	3	5	100
15	2023-12-13	Gel Main	DMD0000014	1	1	100
16	2023-12-13	Gel Main	DMD0000014	2	1	100
17	2023-12-13	Gel Main	DMD0000014	5	1	100
18	2024-01-12	Achat Gel Main	DMD0000015	1	1	100
19	2024-01-12	Achat Gel Main	DMD0000015	2	1	100
20	2024-01-12	Achat Gel Main	DMD0000015	5	1	100
21	2024-01-20	Papier pour faire des inpressions	DMD0000016	3	1	100
22	2024-01-20	Papier pour faire des inpressions	DMD0000016	2	1	100
23	2024-01-20	Papier pour faire des inpressions	DMD0000016	5	1	100
27	2024-01-23	Gel Main	DMD0000019	1	1	100
28	2024-01-23	Gel Main	DMD0000019	3	1	100
29	2024-01-23	Gel Main	DMD0000019	2	1	100
24	2024-01-20	Ordinateur	DMD0000018	3	1	110
25	2024-01-20	Ordinateur	DMD0000018	2	1	110
26	2024-01-20	Ordinateur	DMD0000018	1	1	110
30	2024-01-23	Voiture pour les transport personnel	DMD0000020	1	1	110
31	2024-01-23	Voiture pour les transport personnel	DMD0000020	3	1	110
32	2024-01-23	Voiture pour les transport personnel	DMD0000020	5	1	110
33	2024-01-23	Savon	DMD0000021	1	1	100
\.


--
-- Data for Name: description; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.description (id, description, idcategorie) FROM stdin;
9	Date entretient	IMP
10	Performance	IMP
11	RAM	OD
12	Stockage	OD
13	Performance	OD
\.


--
-- Data for Name: details_besoin_age; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_besoin_age (id, idbesoin, min, max, note) FROM stdin;
1	1	23	25	4
2	1	25	30	5
\.


--
-- Data for Name: details_besoin_diplome; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_besoin_diplome (id, idbesoin, iddiplome, note) FROM stdin;
1	1	3	2
2	1	4	4
3	1	5	5
\.


--
-- Data for Name: details_besoin_experience; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_besoin_experience (id, idbesoin, annee_experience, note) FROM stdin;
1	1	3	1
2	1	4	2
3	1	5	3
4	1	10	5
\.


--
-- Data for Name: details_besoin_genre; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_besoin_genre (id, idbesoin, idgenre, note) FROM stdin;
1	1	1	3
2	1	2	4
\.


--
-- Data for Name: details_besoin_matrimoniale; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_besoin_matrimoniale (id, idbesoin, idmatrimoniale, note) FROM stdin;
1	1	1	2
2	1	3	4
3	1	2	3
\.


--
-- Data for Name: details_besoin_nationalite; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_besoin_nationalite (id, idbesoin, idnationalite, note) FROM stdin;
1	1	14	5
2	1	9	3
3	1	1	4
\.


--
-- Data for Name: details_besoin_region; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_besoin_region (id, idbesoin, idregion, note) FROM stdin;
1	1	2	2
\.


--
-- Data for Name: details_besoin_salaire; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_besoin_salaire (id, idbesoin, min, max, note) FROM stdin;
1	1	1000000	1500000	4
2	1	1500000	1700000	3
3	1	1700000	2000000	2
4	1	2000000	2200000	1
\.


--
-- Data for Name: details_besoin_ville; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_besoin_ville (id, idbesoin, idville, note) FROM stdin;
1	1	4	2
2	1	6	1
\.


--
-- Data for Name: details_bon_commande; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_bon_commande (id, idboncommande, idproformat, etat) FROM stdin;
4	BC00000004	7	8
5	BC00000004	4	8
6	BC00000004	8	8
1	BOC0000001	3	8
2	BOC0000001	4	8
3	BOC0000001	5	8
9	BC00000007	10	8
11	BC00000009	13	8
12	BC00000010	15	8
13	BC00000011	20	8
14	BC00000012	24	8
16	BC00000015	30	8
\.


--
-- Data for Name: details_bon_reception; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_bon_reception (id_bon_reception, id_article, id_fournisseur, date, etat) FROM stdin;
BR00000006	E0001	5	2023-12-01	32
BR00000006	P0001	3	2023-12-01	32
BR00000006	G0001	2	2023-12-01	32
BR00000007	G0001	5	2023-12-18	32
BR00000008	G0001	2	2023-12-20	32
\.


--
-- Data for Name: details_cv_diplome; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_cv_diplome (id, idcv, nom_pdf) FROM stdin;
4	17	1-1697035339-ejb.pdf
5	18	1-1697035725-ejb.pdf
6	19	1-1-1697737521-Exercice2.pdf
\.


--
-- Data for Name: details_cv_salaire; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_cv_salaire (id, idcv, min, max) FROM stdin;
17	17	1000000	1300000
18	18	1500000	1800000
19	19	1000000	1300000
\.


--
-- Data for Name: details_cv_travail_anterieur; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_cv_travail_anterieur (id, idcv, nom_pdf) FROM stdin;
4	17	1-1697035339-EVALUATION-STAGE-Saison-4-P14-DS1-J1-Aout-2023.pdf
5	18	1-1697035725-eval.pdf
6	19	1-2-1697737521-Architecture REST - V3.pdf
\.


--
-- Data for Name: details_pv_reception; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_pv_reception (id_pv_reception, id_description, information) FROM stdin;
PR00000009	13	Test 1
PR00000009	11	Test 2
PR00000009	12	Test 3
PR00000010	13	Test2
PR00000010	11	Test 2
PR00000010	12	Test2
\.


--
-- Data for Name: details_sortie; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_sortie (id, sortie, types_sortie) FROM stdin;
\.


--
-- Data for Name: details_utilisation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_utilisation (iddu, pv_utilisation, immobilisation, description, etat_immobilisation, etat) FROM stdin;
DU00007	PU00000005	I_R0002	Ordinateur neuf	1	45
DU00008	PU00000005	I_R0003	Ordinateur neuf	1	45
\.


--
-- Data for Name: diplome; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.diplome (id, type) FROM stdin;
1	BEPC
2	BACC
3	LICENCE
4	MASTER
5	DOCTORAT
\.


--
-- Data for Name: employer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.employer (id_emp, idclient, cin, telephone, adresse, etat) FROM stdin;
EMP0000002	2	123456789002	0347095080	H-203 M IMERIMAMJAKA	20
EMP0000001	1	123456789001	0347095080	H-203 M IMERIMAMJAKA	20
EMP0000003	4	123456789003	0342696338	H-203 M IMERIMAMJAKA	20
\.


--
-- Data for Name: employer_module; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.employer_module (id, idmodule, idemploye) FROM stdin;
1	6	EMP0000001
2	6	EMP0000002
3	6	EMP0000003
\.


--
-- Data for Name: entre; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.entre (id, dates, reception, article, quantite, prix_unitaire, montant, module) FROM stdin;
E0030	2024-01-10	BR00000006	P0001	50	100	5000	2
E0031	2024-01-11	BR00000006	P0001	40	100	5000	6
E0032	2024-01-12	BR00000006	P0001	425	100	50000	8
\.


--
-- Data for Name: entretient; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.entretient (id_e, aa, dates, heures, lieu) FROM stdin;
1	1	2023-09-25	14	Mahabo
2	2	2023-09-25	15	Mahabo
3	3	2022-09-25	8	Mahabo
\.


--
-- Data for Name: etat_immobilisation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.etat_immobilisation (id, nom) FROM stdin;
1	Neuf
2	Occasion
3	Inutilisable
4	Utilisable
\.


--
-- Data for Name: etats; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.etats (id_et, nom_etats) FROM stdin;
1	Pere
2	Mere
3	Conjoint
4	Enfant
12	Entretient Fini
15	Contrat essaie
20	Embauch‚
10	Debauch‚
7	Annuler
8	Valider
25	Refuse
28	Non Valide
32	Valide
35	Valide RH
37	Valide Finance
40	En Attende
45	Termine
50	Recu et Confirme
100	Besoin achat
110	Besoin immobilier
\.


--
-- Data for Name: explication; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.explication (id, dates, motif, reception, module, article, quantite) FROM stdin;
\.


--
-- Data for Name: finance; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.finance (id, idcompte, entre, sortie, explication, date) FROM stdin;
1	101	1000000	0	Emprint a la banque BOA le 23/12/2024	2024-01-01
2	521	120	0	Payement du vente numero V002	2024-01-11
3	521	3000	0	Payement du vente numero V003	2024-01-12
4	101	0	30000	Payement du bon de commande numero BC00000011	2024-01-11
5	101	0	118800	Payement du bon de commande numero BC00000012	2024-01-20
\.


--
-- Data for Name: fournisseur; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.fournisseur (id, nom, email, adresse, telephone, responsable) FROM stdin;
2	TEKO	layahanjaratiana03@gmail.com	AN 698 Anosy Avaratra	336987451	Mme FELAMANITRA Olive
5	TIKO	anjaratianasandratrinionylayah@gmail.com	IPJ 14 A Itaosy	0348761061	RAZAFY Malala Tiana
1	Boum	razafimanantsoarotavolamarosoa@gmail.com	TH 203 Alasora	343945881	Mr RANDRIAMIANTA Tiavina
3	Poufy	sanjaratiana@yahoo.com	H 963 Analakely	326548917	Mr RAKOTOMALALA Niriko
\.


--
-- Data for Name: historique; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.historique (id, dates, entre, article, quantite) FROM stdin;
H0012	2024-01-11	E0031	P0001	50
H0013	2024-01-11	E0032	P0001	500
H0014	2024-01-11	E0032	P0001	450
\.


--
-- Data for Name: historique_bon_commande; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.historique_bon_commande (id, idboncommande, etat, date) FROM stdin;
1	BC00000010	32	2024-01-12
3	BC00000010	35	2024-01-11
4	BC00000011	32	2024-01-11
5	BC00000011	35	2024-01-11
6	BC00000010	37	2024-01-11
7	BC00000012	32	2024-01-20
8	BC00000012	35	2024-01-20
9	BC00000012	37	2024-01-20
10	BC00000012	45	2024-01-20
\.


--
-- Data for Name: historique_embauche; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.historique_embauche (id, id_emp, date, etat) FROM stdin;
15	EMP0000001	2023-10-25	20
23	EMP0000002	2023-10-27	20
25	EMP0000003	2023-10-27	20
14	EMP0000001	2023-10-01	15
16	EMP0000002	2023-10-01	15
39	EMP0000001	2023-09-25	12
40	EMP0000002	2023-09-25	12
41	EMP0000003	2022-09-25	12
24	EMP0000003	2022-10-01	15
43	EMP0000003	2023-11-10	10
\.


--
-- Data for Name: immobilisation_reception; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.immobilisation_reception (id_immobilisation, id_pv_reception, id_etat_immobilisation) FROM stdin;
I_R0001	PR00000009	4
I_R0002	PR00000010	1
I_R0003	PR00000010	1
I_R0004	PR00000010	1
I_R0005	PR00000010	1
\.


--
-- Data for Name: impot; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.impot (id, plafond_minimum, plafond_maximum, pourcentage) FROM stdin;
1	0	1000000	0
2	1000000	3000000	2
3	3000000	10000000	5
4	10000000	15000000	6
5	15000000	20000000	8
\.


--
-- Data for Name: inventaire; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.inventaire (id, date, immobilisation, etat_immobilisation, taux, ammortissement, type_inventaire, libeller, description) FROM stdin;
IV00006	2024-01-24	I_R0001	4	20	10	venant pv de reception PR00000009	Premiere invenaire lors de la reception	Ordinateur Utilisable second main
IV00007	2024-01-24	I_R0002	1	20	10	venant pv de reception PR00000010	Premiere invenaire lors de la reception	Ordinateur Neuf Sur commande
IV00008	2024-01-24	I_R0002	1	20	10	venant pv de reception PR00000010	Premiere invenaire lors de la reception	Ordinateur Neuf Sur commande
IV00009	2024-01-24	I_R0002	1	20	10	venant pv de reception PR00000010	Premiere invenaire lors de la reception	Ordinateur Neuf Sur commande
IV00010	2024-01-24	I_R0002	1	20	10	venant pv de reception PR00000010	Premiere invenaire lors de la reception	Ordinateur Neuf Sur commande
IV00011	2024-01-01	I_R0003	1	20	10	Faire inventaire de verification	Voir etat du materiel	Ordinateur avec un etat 9 car il a commence a etre utiliser
IV00012	2024-01-01	I_R0002	1	20	10	Pv utilisation premiere utilisation	Demande utilisation	Ordinateur neuf
IV00013	2024-01-01	I_R0004	1	20	10	Pv utilisation premiere utilisation	Demande utilisation	Ordinateur neuf
\.


--
-- Data for Name: lieu; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lieu (id, nom, id_etat) FROM stdin;
ANT	ANTANANARIVO	32
ANS	ANTSIRABE	32
MRN	MORONDAVA	32
\.


--
-- Data for Name: liste_adresse_entreprise; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.liste_adresse_entreprise (id, adresse, date) FROM stdin;
1	M 203 Mahabo Andoharanofotsy	\N
2	Lot F-102 Fiadanamanga	\N
\.


--
-- Data for Name: livreur; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.livreur (id, nom, contact, id_fournisseur) FROM stdin;
1	RAKOTO	Henri	3
\.


--
-- Data for Name: magasin; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.magasin (id, nom, lieu, date) FROM stdin;
MG00000002	Magasin 1	Andoharanofotsy	2020-01-23
MG00000003	Magasin 2	Analakely	2022-05-22
\.


--
-- Data for Name: majoration_nuit; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.majoration_nuit (id, debut, fin, majoration, date) FROM stdin;
2	8	15	60	2023-09-01
3	15	20	70	2023-09-01
4	20	1000	100	2023-09-01
1	1	8	50	2023-09-01
\.


--
-- Data for Name: method; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.method (types, id) FROM stdin;
FIFO	1
LIFO	2
PUMP	3
\.


--
-- Data for Name: module; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.module (id, type) FROM stdin;
1	Ressource Humaine
2	Secretariat
5	Securite
6	Informatique
7	Finance
8	Achat
9	Magasinier
10	Immobilier
\.


--
-- Data for Name: mouvement; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mouvement (idmouvements, type, dates, produits, quantite, prix, idreception) FROM stdin;
\.


--
-- Data for Name: nationalite; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.nationalite (id, type) FROM stdin;
1	Americain
2	Bresilien
3	Chilien
4	Chinois
5	Coreen
6	Cubain
7	Danois
8	Espagnol
9	Francais
10	Grecque
11	Hongrois
12	Indien
13	Italien
14	Malagasy
15	Mexicain
16	Norvegien
17	Portugais
18	Quebecois
19	Roumain
20	Russe
21	Suedois
\.


--
-- Data for Name: note_cv; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.note_cv (id, idcv, note) FROM stdin;
2	17	20
3	18	29
4	19	21
\.


--
-- Data for Name: ok_vita; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ok_vita (id_o, id_e, id_et) FROM stdin;
1	1	12
2	1	12
3	1	12
4	1	12
5	1	12
6	1	12
7	1	12
8	2	12
\.


--
-- Data for Name: pointage; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pointage (id, id_employer, date, etat, jour_nuit, securite) FROM stdin;
1	EMP0000001	2023-10-01 08:06:00	50	25	10
3	EMP0000002	2023-10-01 08:00:00	50	25	10
5	EMP0000003	2023-10-01 08:30:00	50	25	10
7	EMP0000001	2023-10-01 14:40:00	100	25	10
8	EMP0000002	2023-10-01 17:30:00	100	25	10
9	EMP0000003	2023-10-01 16:45:00	100	25	10
11	EMP0000001	2023-10-02 08:05:00	50	25	10
12	EMP0000002	2023-10-02 07:50:00	50	25	10
13	EMP0000003	2023-10-02 10:02:00	50	25	10
14	EMP0000001	2023-10-02 17:03:00	100	25	10
15	EMP0000002	2023-10-02 17:30:00	100	25	10
16	EMP0000003	2023-10-02 18:03:00	100	25	10
17	EMP0000002	2023-10-03 07:30:00	50	25	10
19	EMP0000002	2023-10-03 17:40:00	100	25	10
20	EMP0000002	2023-10-03 16:45:00	100	25	10
21	EMP0000001	2023-10-04 09:00:00	50	25	10
22	EMP0000002	2023-10-04 08:01:00	50	25	10
23	EMP0000003	2023-10-04 08:00:00	50	25	10
24	EMP0000001	2023-10-05 08:00:00	50	25	10
25	EMP0000002	2023-10-05 08:00:00	50	25	10
26	EMP0000001	2023-10-04 17:00:00	100	25	10
27	EMP0000002	2023-10-04 17:00:00	100	25	10
28	EMP0000003	2023-10-04 16:30:00	100	25	10
29	EMP0000001	2023-10-05 16:59:00	100	25	10
30	EMP0000002	2023-10-05 17:00:00	100	25	10
31	EMP0000001	2023-10-06 08:00:00	50	25	10
32	EMP0000001	2023-10-06 17:00:00	100	25	10
33	EMP0000003	2023-10-06 08:15:00	50	25	10
35	EMP0000001	2023-10-09 08:00:00	50	25	10
36	EMP0000001	2023-10-09 17:00:00	100	25	10
37	EMP0000002	2023-10-09 08:00:00	50	25	10
38	EMP0000002	2023-10-09 17:00:00	100	25	10
39	EMP0000003	2023-10-09 08:00:00	50	25	10
41	EMP0000003	2023-10-09 17:00:00	100	25	10
42	EMP0000001	2023-10-10 08:05:00	50	25	10
44	EMP0000003	2023-10-10 08:30:00	50	25	10
45	EMP0000001	2023-10-10 16:30:00	100	25	10
46	EMP0000002	2023-10-10 13:00:00	100	25	10
47	EMP0000003	2023-10-10 17:00:00	100	25	10
48	EMP0000001	2023-10-11 08:00:00	50	25	10
49	EMP0000002	2023-10-11 08:00:00	50	25	10
50	EMP0000003	2023-10-11 08:00:00	50	25	10
51	EMP0000001	2023-10-11 17:00:00	100	25	10
52	EMP0000002	2023-10-11 17:00:00	100	25	10
53	EMP0000003	2023-10-11 17:00:00	100	25	10
54	EMP0000001	2023-10-12 08:00:00	50	25	10
55	EMP0000002	2023-10-12 08:00:00	50	25	10
56	EMP0000003	2023-10-12 08:00:00	50	25	10
57	EMP0000001	2023-10-12 17:00:00	100	25	10
58	EMP0000002	2023-10-12 17:00:00	100	25	10
59	EMP0000003	2023-10-12 17:00:00	100	25	10
60	EMP0000001	2023-10-13 08:00:00	50	25	10
61	EMP0000002	2023-10-13 08:00:00	50	25	10
62	EMP0000003	2023-10-13 08:00:00	50	25	10
63	EMP0000001	2023-10-13 17:00:00	100	25	10
64	EMP0000002	2023-10-13 17:00:00	100	25	10
65	EMP0000003	2023-10-13 17:00:00	100	25	10
66	EMP0000001	2023-10-16 08:00:00	50	25	10
67	EMP0000002	2023-10-16 08:05:00	50	25	10
68	EMP0000003	2023-10-16 08:00:00	50	25	10
69	EMP0000001	2023-10-16 17:00:00	100	25	10
70	EMP0000002	2023-10-16 17:00:00	100	25	10
71	EMP0000003	2023-10-16 17:00:00	100	25	10
72	EMP0000001	2023-10-17 08:00:00	50	25	10
73	EMP0000002	2023-10-17 08:00:00	50	25	10
74	EMP0000003	2023-10-17 08:00:00	50	25	10
75	EMP0000001	2023-10-17 17:00:00	100	25	10
76	EMP0000002	2023-10-17 17:00:00	100	25	10
77	EMP0000003	2023-10-17 17:00:00	100	25	10
78	EMP0000001	2023-10-18 08:00:00	50	25	10
79	EMP0000001	2023-10-18 17:00:00	100	25	10
80	EMP0000002	2023-10-18 08:00:00	50	25	10
81	EMP0000002	2023-10-18 17:00:00	100	25	10
82	EMP0000003	2023-10-18 08:00:00	50	25	10
83	EMP0000003	2023-10-18 16:30:00	100	25	10
84	EMP0000001	2023-10-19 08:07:00	50	25	10
85	EMP0000001	2023-10-19 17:00:00	100	25	10
86	EMP0000002	2023-10-19 08:00:00	50	25	10
87	EMP0000002	2023-10-19 17:00:00	100	25	10
88	EMP0000003	2023-10-19 08:00:00	50	25	10
89	EMP0000003	2023-10-19 17:00:00	100	25	10
90	EMP0000001	2023-10-20 07:20:00	50	25	10
91	EMP0000001	2023-10-20 16:30:00	100	25	10
92	EMP0000002	2023-10-20 12:00:00	50	25	10
93	EMP0000002	2023-10-20 20:15:00	100	25	10
94	EMP0000003	2023-10-21 09:00:00	50	25	10
95	EMP0000003	2023-10-21 12:17:00	100	25	10
96	EMP0000001	2023-10-23 08:02:00	50	25	10
97	EMP0000002	2023-10-23 08:14:00	50	25	10
98	EMP0000003	2023-10-23 08:23:00	50	25	10
99	EMP0000001	2023-10-23 17:02:00	100	25	10
100	EMP0000002	2023-10-23 17:03:00	100	25	10
101	EMP0000003	2023-10-23 17:30:00	100	25	10
102	EMP0000002	2023-10-23 18:00:00	50	55	10
105	EMP0000001	2023-10-24 07:58:00	50	25	10
106	EMP0000002	2023-10-24 09:20:00	50	25	10
107	EMP0000003	2023-10-24 08:16:00	50	25	10
110	EMP0000003	2023-10-24 17:22:00	100	25	10
109	EMP0000002	2023-10-24 17:05:00	100	25	10
108	EMP0000001	2023-10-24 16:39:00	100	25	10
111	EMP0000001	2023-10-25 09:00:00	50	25	10
112	EMP0000002	2023-10-25 08:09:00	50	25	10
113	EMP0000003	2023-10-25 08:00:00	50	25	10
115	EMP0000002	2023-10-25 17:05:00	100	25	10
114	EMP0000001	2023-10-25 17:27:00	100	25	10
116	EMP0000003	2023-10-25 17:03:00	100	25	10
117	EMP0000001	2023-10-26 08:02:00	50	25	10
118	EMP0000002	2023-10-26 08:01:00	50	25	10
120	EMP0000003	2023-10-26 08:12:00	50	25	10
121	EMP0000001	2023-10-26 17:00:00	100	25	10
122	EMP0000002	2023-10-26 12:05:00	100	25	10
123	EMP0000003	2023-10-26 15:35:00	100	25	10
124	EMP0000002	2023-10-27 08:33:00	50	25	10
125	EMP0000002	2023-10-27 15:33:00	100	25	10
126	EMP0000001	2023-10-30 08:15:00	50	25	10
34	EMP0000003	2023-10-06 17:00:00	100	25	10
129	EMP0000003	2023-10-30 09:08:00	50	25	10
128	EMP0000002	2023-10-30 08:12:00	50	25	10
130	EMP0000001	2023-10-30 16:45:00	100	25	10
131	EMP0000002	2023-10-30 15:30:00	100	25	10
132	EMP0000003	2023-10-30 17:37:00	100	25	10
133	EMP0000001	2023-10-31 08:03:00	50	25	10
134	EMP0000002	2023-10-31 08:38:00	50	25	10
135	EMP0000001	2023-10-31 17:02:00	100	25	10
136	EMP0000002	2023-10-31 17:05:00	100	25	10
104	EMP0000002	2023-10-23 23:59:00	100	55	10
137	EMP0000001	2023-11-01 08:07:00	50	25	10
138	EMP0000001	2023-11-01 17:00:00	100	25	10
140	EMP0000001	2023-11-01 18:30:00	50	55	10
141	EMP0000002	2023-10-29 18:00:00	50	55	10
142	EMP0000002	2023-10-29 22:00:00	100	55	10
143	EMP0000001	2023-10-29 18:00:00	50	55	10
144	EMP0000001	2023-10-29 22:00:00	100	55	10
\.


--
-- Data for Name: poste; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.poste (id, type) FROM stdin;
9	Chef de Projet
\.


--
-- Data for Name: prime; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.prime (id, id_employe, type, montant, date) FROM stdin;
1	EMP0000001	1	300000	2023-10-31
2	EMP0000002	1	150000	2023-10-31
\.


--
-- Data for Name: proche; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.proche (id, id_emp, nom, prenom, datedenaissance, idgenre, etat) FROM stdin;
11	EMP0000001	TANIAH	Fiderana	1975-02-06	2	2
12	EMP0000002	ANDRIA	Fy	2020-01-07	2	4
13	EMP0000003	NY AVO	Tendry	1971-06-20	1	1
14	EMP0000003	MIALITIANA	Fanatenana	1975-08-06	2	2
\.


--
-- Data for Name: proformat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.proformat (id, iddemande, idfournisseur, idarticle, prixunitaire, tva, date) FROM stdin;
3	DMD0000001	2	E0001	12000	20	2023-11-17
4	DMD0000001	2	G0001	5000	20	2023-11-17
5	DMD0000001	2	P0001	150	20	2023-11-18
7	DMD0000001	5	E0001	10000	20	2023-11-18
8	DMD0000001	3	P0001	100	20	2023-11-18
10	DMD0000011	5	G0001	4500	20	2023-12-15
11	DMD0000011	2	G0001	5000	20	2023-12-06
12	DMD0000014	1	G0001	3500	20	2023-12-14
13	DMD0000014	2	G0001	2000	20	2023-12-13
14	DMD0000014	5	G0001	2500	20	2023-12-14
15	DMD0000015	1	G0001	2000	20	2024-01-12
16	DMD0000015	2	G0001	2500	20	2024-01-12
17	DMD0000015	5	G0001	2500	20	2024-01-12
18	DMD0000012	2	S0001	1200	20	2024-01-11
19	DMD0000012	1	S0001	1500	20	2024-01-11
20	DMD0000012	5	S0001	1000	20	2024-01-11
22	DMD0000018	3	213	100000	20	2024-01-20
23	DMD0000018	2	213	150000	20	2024-01-20
24	DMD0000018	1	213	99000	20	2024-01-20
25	DMD0000019	3	G0001	4000	20	2024-01-23
26	DMD0000019	1	G0001	4500	20	2024-01-23
27	DMD0000019	2	G0001	5000	20	2024-01-23
28	DMD0000020	1	212	500000	20	2024-01-23
29	DMD0000020	3	212	607000	20	2024-01-23
30	DMD0000020	5	212	499000	20	2024-01-23
\.


--
-- Data for Name: pv_reception; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pv_reception (id, date, code, id_etat_immobilisation, id_type_ammortissement, taux, id_receptionneur, id_livreur, id_bon_commande, id_article, id_categorie, quantite, duree_an) FROM stdin;
PR00000009	2024-01-24	ANTJAN2024213011	4	10	20	15	1	BC00000012	213	OD	1	\N
PR00000010	2024-01-24	ANTJAN2024213012	1	10	20	15	1	BC00000012	213	OD	3	\N
\.


--
-- Data for Name: pv_utilisation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pv_utilisation (id, reception, module, date) FROM stdin;
PU00000005	PR00000010	6	2024-01-01
\.


--
-- Data for Name: qcm_admis; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.qcm_admis (id_qcm, titre, description, durer, note_total, id_annonce) FROM stdin;
3	Qcm1	Description anle Qcm	2	10	1
\.


--
-- Data for Name: qcm_result; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.qcm_result (id_r, qcm, notes_r) FROM stdin;
31	3	0
32	3	0
33	3	0
34	3	10
35	3	10
36	3	10
\.


--
-- Data for Name: question_posee; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.question_posee (id_q, questions, id_qcm, note) FROM stdin;
1	Pourquoi utiliser informatique	3	5
2	Quel est son role ?	3	5
3	Pourquoi essayer de le maitriser	3	5
\.


--
-- Data for Name: region; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.region (id, type) FROM stdin;
1	Itasy
2	Analamanga
3	Vakinankaratra
4	Bongolava
5	Diana
6	Sava
7	Amoron i Mania
8	Haute Matsiatra
9	Vatovavy-Fitovinany
10	Atsimo-Atsinanana
11	Ihorombe
12	Sofia
13	Boeny
14	Bestiboka
15	Melaky
16	Alaotra-Mangoro
17	Atsinanana
18	Analanjirofo
19	Menabe
20	Atsimo-Andrefana
21	Androy
22	Anosy
\.


--
-- Data for Name: reponse_faux; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.reponse_faux (id_f, id_q, reponse_f, note) FROM stdin;
1	1	Pour le plaisir	0
2	3	Zay no tiako	0
3	2	Créer des jeux	0
\.


--
-- Data for Name: reponse_q; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.reponse_q (id_r, id_question, reponse, note) FROM stdin;
1	1	Faciliter le travail	0
2	3	Aquerir du savoir	0
3	2	Traitement de données	0
\.


--
-- Data for Name: retenu_cnaps; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.retenu_cnaps (id, plafond, date) FROM stdin;
1	20000	2023-01-01
\.


--
-- Data for Name: salaire; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.salaire (id, id_emp, brut, net, date) FROM stdin;
5	EMP0000002	2500000	1400000	2023-09-25
6	EMP0000001	3000000	2400000	2023-09-25
4	EMP0000003	2700000	1600000	2023-09-25
\.


--
-- Data for Name: service; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.service (id, type) FROM stdin;
1	Informatique
\.


--
-- Data for Name: situation_matrimoniale; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.situation_matrimoniale (id, type) FROM stdin;
1	Celibataire
2	Fiance(e)
3	Marie(e)
4	Divorce(e)
5	Veuf(ve)
\.


--
-- Data for Name: solde_conge; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.solde_conge (id, idconge, conge_consomme, solde_actuel) FROM stdin;
\.


--
-- Data for Name: sortie; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sortie (id, dates, entre, article, quantite, types_sortie) FROM stdin;
S0013	2024-01-11	E0031	P0001	10	1
S0014	2024-01-11	E0032	P0001	50	2
S0015	2024-01-12	E0032	P0001	25	2
\.


--
-- Data for Name: sortie_departement; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sortie_departement (id, sortie_details, module) FROM stdin;
9	S0013	6
\.


--
-- Data for Name: sortie_vente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sortie_vente (id, lieu_vente, prix_unitaire, tva_origine, prix_ttc, montanttotal, date, article, quantite, numero_caisse) FROM stdin;
V002	MG00000002	100	20	120	6000	2024-01-11	P0001	50	CS00000001
V003	MG00000002	100	20	120	3000	2024-01-12	P0001	25	CS00000001
\.


--
-- Data for Name: sous_categorie_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sous_categorie_type (id, type, idcategorie, etat) FROM stdin;
1	213	IMP	8
2	213	OD	8
3	212	VT	8
\.


--
-- Data for Name: tafiditra_mpiasa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tafiditra_mpiasa (id_taf, id_ok, dates) FROM stdin;
1	1	2023-11-07
2	1	2023-11-07
3	8	2023-11-15
\.


--
-- Data for Name: tranche_irsa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tranche_irsa (id, debut, fin, majoration, date) FROM stdin;
6	1	350000	0	2023-01-01
7	350001	400000	5	2023-01-01
8	400001	500000	10	2023-01-01
9	500001	600000	15	2023-01-01
10	600001	10000000000	20	2023-01-01
\.


--
-- Data for Name: type_ammortissement; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.type_ammortissement (id, nom) FROM stdin;
1	Ammortissement Lineaire
10	Ammortissement Degressif
\.


--
-- Data for Name: type_avantage_nature; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.type_avantage_nature (id, type) FROM stdin;
1	Telephone
2	Voiture
3	Maison
4	Secretaire
\.


--
-- Data for Name: type_conge; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.type_conge (id, nom, politique, commentaires, day_default) FROM stdin;
1	Conge Maternite	conge accordee aux femmes	Pas de politique	30
2	Cong‚ de paternit‚ et accueil de l enfant	Pour les peres	Pas de commentaire	3
3	Cong‚ en cas d hospitalisation imm‚diate de l enfant aprŠs sa naissance	Pour tous	Pas de commentaire	0
4	Cong‚ d adoption	Pour ceux qui veulent adopter un enfant	Pas de commentaire	0
5	Mariage ou Pacs	Pour son propre mariage	Besoin de preuve	0
6	Mariage de son enfant	Son propre enfant ou celui que vous prenez pour enfant	Pas de commentaire	0
7	D‚cŠs d un membre de sa famille	En cas de d‚cŠs	Pas de commentaire	0
8	Autres	Autres type de conge0	Pas de commentaire	0
\.


--
-- Data for Name: type_contrat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.type_contrat (id, nom, acronyme) FROM stdin;
1	CDI	Blba bla
2	Le contrat de travail … dur‚e ind‚termin‚e 	CDI
3	Le contrat de chantier ou d op‚ration 	CCO
4	Le contrat … dur‚e d‚termin‚e  	CDD
5	Le CDD … objet d‚fini 	CDDO
6	Le CDD senior 	CDDS
7	Le contrat de travail temporaire 	CTT
8	Le contrat de travail … temps partiel 	CTTP
9	Le travail intermittent  	TI
10	Le contrat saisonnier  	CS
11	Le contrat vendanges  	CV
12	Le titre emploi-service entreprise	TESE
\.


--
-- Data for Name: type_prime; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.type_prime (id, prime) FROM stdin;
1	Prime de Rendement
2	Prime anciennete
3	Prime divers
\.


--
-- Data for Name: type_sortie; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.type_sortie (id, types) FROM stdin;
1	Departement
2	Vente
\.


--
-- Data for Name: ville; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ville (id, idregion, type) FROM stdin;
1	1	Ampefy
2	1	Miarinarivo
3	1	Arivonimamo
4	2	Tananarivo
5	2	Anjozorobe
6	2	Talatamaty
7	2	Ambohidratrimo
8	2	Alasora
9	3	Betafo
10	3	Faratsiho
11	3	Mandoto
12	3	Ampitatafika
13	4	Tsiroanomandidy
14	4	Fenoarivo
15	4	Ambatolampy
16	4	Alaotra-Mangoro
17	5	Atsiranana
18	5	Ambilobe
19	5	Antsalaka
20	6	Sambava
21	6	Marovato
22	7	Ambositra
23	7	Sandradahy
\.


--
-- Name: administrateur_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.administrateur_id_seq', 15, true);


--
-- Name: afaka_qcm_id_as_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.afaka_qcm_id_as_seq', 1, false);


--
-- Name: avance_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.avance_id_seq', 1, true);


--
-- Name: avantage_nature_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.avantage_nature_id_seq', 7, true);


--
-- Name: besoin_achat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.besoin_achat_id_seq', 16, true);


--
-- Name: besoin_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.besoin_id_seq', 1, true);


--
-- Name: besoin_immobilisation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.besoin_immobilisation_id_seq', 3, true);


--
-- Name: caisse_magasin_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.caisse_magasin_id_seq', 2, true);


--
-- Name: client_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.client_id_seq', 4, true);


--
-- Name: confirmation_date_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.confirmation_date_id_seq', 1, true);


--
-- Name: conge_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.conge_id_seq', 8, true);


--
-- Name: contrat_essaie_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.contrat_essaie_id_seq', 9, true);


--
-- Name: cv_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cv_id_seq', 19, true);


--
-- Name: demande_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.demande_id_seq', 33, true);


--
-- Name: description_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.description_id_seq', 13, true);


--
-- Name: details_besoin_age_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.details_besoin_age_id_seq', 2, true);


--
-- Name: details_besoin_diplome_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.details_besoin_diplome_id_seq', 3, true);


--
-- Name: details_besoin_experience_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.details_besoin_experience_id_seq', 4, true);


--
-- Name: details_besoin_genre_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.details_besoin_genre_id_seq', 2, true);


--
-- Name: details_besoin_matrimoniale_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.details_besoin_matrimoniale_id_seq', 3, true);


--
-- Name: details_besoin_nationalite_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.details_besoin_nationalite_id_seq', 3, true);


--
-- Name: details_besoin_region_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.details_besoin_region_id_seq', 1, true);


--
-- Name: details_besoin_salaire_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.details_besoin_salaire_id_seq', 4, true);


--
-- Name: details_besoin_ville_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.details_besoin_ville_id_seq', 2, true);


--
-- Name: details_bon_commande_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.details_bon_commande_id_seq', 16, true);


--
-- Name: details_cv_diplome_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.details_cv_diplome_id_seq', 6, true);


--
-- Name: details_cv_salaire_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.details_cv_salaire_id_seq', 19, true);


--
-- Name: details_cv_travail_anterieur_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.details_cv_travail_anterieur_id_seq', 6, true);


--
-- Name: details_sortie_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.details_sortie_id_seq', 1, false);


--
-- Name: diplome_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.diplome_id_seq', 5, true);


--
-- Name: employer_module_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.employer_module_id_seq', 3, true);


--
-- Name: entretient_id_e_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.entretient_id_e_seq', 1, false);


--
-- Name: etat_immobilisation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.etat_immobilisation_id_seq', 4, true);


--
-- Name: etats_id_et_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.etats_id_et_seq', 1, false);


--
-- Name: explication_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.explication_id_seq', 1, false);


--
-- Name: finance_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.finance_id_seq', 5, true);


--
-- Name: fournisseur_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fournisseur_id_seq', 5, true);


--
-- Name: historique_bon_commande_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.historique_bon_commande_id_seq', 10, true);


--
-- Name: historique_embauche_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.historique_embauche_id_seq', 43, true);


--
-- Name: impot_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.impot_id_seq', 5, true);


--
-- Name: liste_adresse_entreprise_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.liste_adresse_entreprise_id_seq', 2, true);


--
-- Name: livreur_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.livreur_id_seq', 1, true);


--
-- Name: majoration_nuit_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.majoration_nuit_id_seq', 4, true);


--
-- Name: method_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.method_id_seq', 3, true);


--
-- Name: module_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.module_id_seq', 10, true);


--
-- Name: mouvement_idmouvements_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.mouvement_idmouvements_seq', 1, false);


--
-- Name: nationalite_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.nationalite_id_seq', 21, true);


--
-- Name: note_cv_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.note_cv_id_seq', 4, true);


--
-- Name: ok_vita_id_o_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ok_vita_id_o_seq', 8, true);


--
-- Name: pointage_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pointage_id_seq', 144, true);


--
-- Name: poste_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.poste_id_seq', 9, true);


--
-- Name: prime_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.prime_id_seq', 2, true);


--
-- Name: proche_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.proche_id_seq', 14, true);


--
-- Name: proformat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.proformat_id_seq', 30, true);


--
-- Name: qcm_admis_id_qcm_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.qcm_admis_id_qcm_seq', 3, true);


--
-- Name: qcm_result_id_r_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.qcm_result_id_r_seq', 36, true);


--
-- Name: question_pos‚e_id_q_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."question_pos‚e_id_q_seq"', 3, true);


--
-- Name: region_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.region_id_seq', 22, true);


--
-- Name: reponse_faux_id_f_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.reponse_faux_id_f_seq', 3, true);


--
-- Name: reponse_q_id_r_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.reponse_q_id_r_seq', 3, true);


--
-- Name: retenu_cnaps_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.retenu_cnaps_id_seq', 1, true);


--
-- Name: salaire_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.salaire_id_seq', 16, true);


--
-- Name: seq_details_utilisation; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seq_details_utilisation', 8, true);


--
-- Name: seq_inventaire; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seq_inventaire', 15, true);


--
-- Name: seq_pv_utilisation; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seq_pv_utilisation', 5, true);


--
-- Name: seqboncommande; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqboncommande', 15, true);


--
-- Name: seqbonlivraison; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqbonlivraison', 1, false);


--
-- Name: seqbonreception; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqbonreception', 8, true);


--
-- Name: seqcaisse; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqcaisse', 2, true);


--
-- Name: seqcnaps; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqcnaps', 10, true);


--
-- Name: seqcompte; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqcompte', 1, false);


--
-- Name: seqconso; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqconso', 2, true);


--
-- Name: seqdemande; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqdemande', 21, true);


--
-- Name: seqemploye; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqemploye', 18, true);


--
-- Name: seqentre; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqentre', 32, true);


--
-- Name: seqhistorique; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqhistorique', 14, true);


--
-- Name: seqmagasin; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqmagasin', 3, true);


--
-- Name: seqnumero; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqnumero', 12, true);


--
-- Name: seqpvreception; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqpvreception', 10, true);


--
-- Name: seqsortie; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqsortie', 15, true);


--
-- Name: seqvente; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqvente', 3, true);


--
-- Name: service_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.service_id_seq', 1, true);


--
-- Name: situation_matrimoniale_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.situation_matrimoniale_id_seq', 5, true);


--
-- Name: solde_conge_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.solde_conge_id_seq', 1, false);


--
-- Name: sortie_departement_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sortie_departement_id_seq', 9, true);


--
-- Name: sous_categorie_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sous_categorie_type_id_seq', 3, true);


--
-- Name: tafiditra_mpiasa_id_taf_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tafiditra_mpiasa_id_taf_seq', 3, true);


--
-- Name: tranche_irsa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tranche_irsa_id_seq', 10, true);


--
-- Name: type_avantage_nature_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.type_avantage_nature_id_seq', 8, true);


--
-- Name: type_conge_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.type_conge_id_seq', 8, true);


--
-- Name: type_contrat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.type_contrat_id_seq', 12, true);


--
-- Name: type_prime_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.type_prime_id_seq', 3, true);


--
-- Name: type_sortie_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.type_sortie_id_seq', 2, true);


--
-- Name: ville_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ville_id_seq', 23, true);


--
-- Name: administrateur administrateur_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.administrateur
    ADD CONSTRAINT administrateur_pkey PRIMARY KEY (id);


--
-- Name: afaka_qcm afaka_qcm_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.afaka_qcm
    ADD CONSTRAINT afaka_qcm_pkey PRIMARY KEY (id_as);


--
-- Name: article article_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article
    ADD CONSTRAINT article_pkey PRIMARY KEY (id);


--
-- Name: avance avance_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.avance
    ADD CONSTRAINT avance_pkey PRIMARY KEY (id);


--
-- Name: besoin_achat besoin_achat_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin_achat
    ADD CONSTRAINT besoin_achat_pkey PRIMARY KEY (id);


--
-- Name: besoin_immobilisation besoin_immobilisation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin_immobilisation
    ADD CONSTRAINT besoin_immobilisation_pkey PRIMARY KEY (id);


--
-- Name: besoin besoin_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin
    ADD CONSTRAINT besoin_pkey PRIMARY KEY (id);


--
-- Name: bon_commande bon_commande_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bon_commande
    ADD CONSTRAINT bon_commande_pkey PRIMARY KEY (id);


--
-- Name: bon_reception bon_reception_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bon_reception
    ADD CONSTRAINT bon_reception_pkey PRIMARY KEY (id);


--
-- Name: caisse caisse_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.caisse
    ADD CONSTRAINT caisse_pkey PRIMARY KEY (id);


--
-- Name: categorie categorie_categorie_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categorie
    ADD CONSTRAINT categorie_categorie_key UNIQUE (categorie);


--
-- Name: categorie categorie_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categorie
    ADD CONSTRAINT categorie_pkey PRIMARY KEY (id);


--
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id);


--
-- Name: clientel clientel_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clientel
    ADD CONSTRAINT clientel_pkey PRIMARY KEY (id);


--
-- Name: cnaps cnaps_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cnaps
    ADD CONSTRAINT cnaps_pkey PRIMARY KEY (id);


--
-- Name: compte compte_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.compte
    ADD CONSTRAINT compte_pkey PRIMARY KEY (id);


--
-- Name: confirmation_date confirmation_date_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.confirmation_date
    ADD CONSTRAINT confirmation_date_pkey PRIMARY KEY (id);


--
-- Name: conge conge_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conge
    ADD CONSTRAINT conge_pkey PRIMARY KEY (id);


--
-- Name: contrat_essaie contrat_essaie_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrat_essaie
    ADD CONSTRAINT contrat_essaie_pkey PRIMARY KEY (id);


--
-- Name: cv cv_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cv
    ADD CONSTRAINT cv_pkey PRIMARY KEY (id);


--
-- Name: demande demande_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.demande
    ADD CONSTRAINT demande_pkey PRIMARY KEY (id);


--
-- Name: details_besoin_age details_besoin_age_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_age
    ADD CONSTRAINT details_besoin_age_pkey PRIMARY KEY (id);


--
-- Name: details_besoin_diplome details_besoin_diplome_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_diplome
    ADD CONSTRAINT details_besoin_diplome_pkey PRIMARY KEY (id);


--
-- Name: details_besoin_experience details_besoin_experience_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_experience
    ADD CONSTRAINT details_besoin_experience_pkey PRIMARY KEY (id);


--
-- Name: details_besoin_genre details_besoin_genre_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_genre
    ADD CONSTRAINT details_besoin_genre_pkey PRIMARY KEY (id);


--
-- Name: details_besoin_matrimoniale details_besoin_matrimoniale_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_matrimoniale
    ADD CONSTRAINT details_besoin_matrimoniale_pkey PRIMARY KEY (id);


--
-- Name: details_besoin_nationalite details_besoin_nationalite_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_nationalite
    ADD CONSTRAINT details_besoin_nationalite_pkey PRIMARY KEY (id);


--
-- Name: details_besoin_region details_besoin_region_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_region
    ADD CONSTRAINT details_besoin_region_pkey PRIMARY KEY (id);


--
-- Name: details_besoin_salaire details_besoin_salaire_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_salaire
    ADD CONSTRAINT details_besoin_salaire_pkey PRIMARY KEY (id);


--
-- Name: details_besoin_ville details_besoin_ville_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_ville
    ADD CONSTRAINT details_besoin_ville_pkey PRIMARY KEY (id);


--
-- Name: details_cv_diplome details_cv_diplome_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_cv_diplome
    ADD CONSTRAINT details_cv_diplome_pkey PRIMARY KEY (id);


--
-- Name: details_cv_salaire details_cv_salaire_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_cv_salaire
    ADD CONSTRAINT details_cv_salaire_pkey PRIMARY KEY (id);


--
-- Name: details_cv_travail_anterieur details_cv_travail_anterieur_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_cv_travail_anterieur
    ADD CONSTRAINT details_cv_travail_anterieur_pkey PRIMARY KEY (id);


--
-- Name: details_sortie details_sortie_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_sortie
    ADD CONSTRAINT details_sortie_pkey PRIMARY KEY (id);


--
-- Name: details_utilisation details_utilisation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_utilisation
    ADD CONSTRAINT details_utilisation_pkey PRIMARY KEY (iddu);


--
-- Name: diplome diplome_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diplome
    ADD CONSTRAINT diplome_pkey PRIMARY KEY (id);


--
-- Name: employer_module employer_module_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employer_module
    ADD CONSTRAINT employer_module_pkey PRIMARY KEY (id);


--
-- Name: employer employer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employer
    ADD CONSTRAINT employer_pkey PRIMARY KEY (id_emp);


--
-- Name: entre entre_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entre
    ADD CONSTRAINT entre_pkey PRIMARY KEY (id);


--
-- Name: entretient entretient_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entretient
    ADD CONSTRAINT entretient_pkey PRIMARY KEY (id_e);


--
-- Name: etat_immobilisation etat_immobilisation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etat_immobilisation
    ADD CONSTRAINT etat_immobilisation_pkey PRIMARY KEY (id);


--
-- Name: etats etats_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etats
    ADD CONSTRAINT etats_pkey PRIMARY KEY (id_et);


--
-- Name: explication explication_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.explication
    ADD CONSTRAINT explication_pkey PRIMARY KEY (id);


--
-- Name: fournisseur fournisseur_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fournisseur
    ADD CONSTRAINT fournisseur_pkey PRIMARY KEY (id);


--
-- Name: historique historique_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historique
    ADD CONSTRAINT historique_pkey PRIMARY KEY (id);


--
-- Name: immobilisation_reception immobilisation_reception_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.immobilisation_reception
    ADD CONSTRAINT immobilisation_reception_pkey PRIMARY KEY (id_immobilisation);


--
-- Name: impot impot_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.impot
    ADD CONSTRAINT impot_pkey PRIMARY KEY (id);


--
-- Name: inventaire inventaire_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inventaire
    ADD CONSTRAINT inventaire_pkey PRIMARY KEY (id);


--
-- Name: lieu lieu_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lieu
    ADD CONSTRAINT lieu_pkey PRIMARY KEY (id);


--
-- Name: liste_adresse_entreprise liste_adresse_entreprise_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liste_adresse_entreprise
    ADD CONSTRAINT liste_adresse_entreprise_pkey PRIMARY KEY (id);


--
-- Name: livreur livreur_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.livreur
    ADD CONSTRAINT livreur_pkey PRIMARY KEY (id);


--
-- Name: magasin magasin_nom_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.magasin
    ADD CONSTRAINT magasin_nom_key UNIQUE (nom);


--
-- Name: magasin magasin_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.magasin
    ADD CONSTRAINT magasin_pkey PRIMARY KEY (id);


--
-- Name: method method_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.method
    ADD CONSTRAINT method_pkey PRIMARY KEY (id);


--
-- Name: module module_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.module
    ADD CONSTRAINT module_pkey PRIMARY KEY (id);


--
-- Name: mouvement mouvement_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mouvement
    ADD CONSTRAINT mouvement_pkey PRIMARY KEY (idmouvements);


--
-- Name: nationalite nationalite_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nationalite
    ADD CONSTRAINT nationalite_pkey PRIMARY KEY (id);


--
-- Name: note_cv note_cv_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.note_cv
    ADD CONSTRAINT note_cv_pkey PRIMARY KEY (id);


--
-- Name: ok_vita ok_vita_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ok_vita
    ADD CONSTRAINT ok_vita_pkey PRIMARY KEY (id_o);


--
-- Name: pointage pointage_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pointage
    ADD CONSTRAINT pointage_pkey PRIMARY KEY (id);


--
-- Name: poste poste_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.poste
    ADD CONSTRAINT poste_pkey PRIMARY KEY (id);


--
-- Name: proche proche_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proche
    ADD CONSTRAINT proche_pkey PRIMARY KEY (id);


--
-- Name: proformat proformat_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proformat
    ADD CONSTRAINT proformat_pkey PRIMARY KEY (id);


--
-- Name: pv_reception pv_reception_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pv_reception
    ADD CONSTRAINT pv_reception_pkey PRIMARY KEY (id);


--
-- Name: pv_utilisation pv_utilisation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pv_utilisation
    ADD CONSTRAINT pv_utilisation_pkey PRIMARY KEY (id);


--
-- Name: qcm_admis qcm_admis_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.qcm_admis
    ADD CONSTRAINT qcm_admis_pkey PRIMARY KEY (id_qcm);


--
-- Name: qcm_result qcm_result_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.qcm_result
    ADD CONSTRAINT qcm_result_pkey PRIMARY KEY (id_r);


--
-- Name: question_posee question_pos‚e_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.question_posee
    ADD CONSTRAINT "question_pos‚e_pkey" PRIMARY KEY (id_q);


--
-- Name: region region_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.region
    ADD CONSTRAINT region_pkey PRIMARY KEY (id);


--
-- Name: reponse_faux reponse_faux_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reponse_faux
    ADD CONSTRAINT reponse_faux_pkey PRIMARY KEY (id_f);


--
-- Name: reponse_q reponse_q_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reponse_q
    ADD CONSTRAINT reponse_q_pkey PRIMARY KEY (id_r);


--
-- Name: salaire salaire_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.salaire
    ADD CONSTRAINT salaire_pkey PRIMARY KEY (id);


--
-- Name: service service_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service
    ADD CONSTRAINT service_pkey PRIMARY KEY (id);


--
-- Name: situation_matrimoniale situation_matrimoniale_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.situation_matrimoniale
    ADD CONSTRAINT situation_matrimoniale_pkey PRIMARY KEY (id);


--
-- Name: solde_conge solde_conge_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solde_conge
    ADD CONSTRAINT solde_conge_pkey PRIMARY KEY (id);


--
-- Name: sortie_departement sortie_departement_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sortie_departement
    ADD CONSTRAINT sortie_departement_pkey PRIMARY KEY (id);


--
-- Name: sortie sortie_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sortie
    ADD CONSTRAINT sortie_pkey PRIMARY KEY (id);


--
-- Name: sortie_vente sortie_vente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sortie_vente
    ADD CONSTRAINT sortie_vente_pkey PRIMARY KEY (id);


--
-- Name: tafiditra_mpiasa tafiditra_mpiasa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tafiditra_mpiasa
    ADD CONSTRAINT tafiditra_mpiasa_pkey PRIMARY KEY (id_taf);


--
-- Name: type_ammortissement type_ammortissement_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type_ammortissement
    ADD CONSTRAINT type_ammortissement_pkey PRIMARY KEY (id);


--
-- Name: type_avantage_nature type_avantage_nature_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type_avantage_nature
    ADD CONSTRAINT type_avantage_nature_pkey PRIMARY KEY (id);


--
-- Name: type_conge type_conge_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type_conge
    ADD CONSTRAINT type_conge_pkey PRIMARY KEY (id);


--
-- Name: type_contrat type_contrat_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type_contrat
    ADD CONSTRAINT type_contrat_pkey PRIMARY KEY (id);


--
-- Name: type_prime type_prime_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type_prime
    ADD CONSTRAINT type_prime_pkey PRIMARY KEY (id);


--
-- Name: type_sortie type_sortie_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type_sortie
    ADD CONSTRAINT type_sortie_pkey PRIMARY KEY (id);


--
-- Name: ville ville_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ville
    ADD CONSTRAINT ville_pkey PRIMARY KEY (id);


--
-- Name: administrateur administrateur_idmodule_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.administrateur
    ADD CONSTRAINT administrateur_idmodule_fkey FOREIGN KEY (idmodule) REFERENCES public.module(id);


--
-- Name: afaka_qcm afaka_qcm_id_users_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.afaka_qcm
    ADD CONSTRAINT afaka_qcm_id_users_fkey FOREIGN KEY (id_users) REFERENCES public.client(id);


--
-- Name: afaka_qcm afaka_qcm_qcm_r_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.afaka_qcm
    ADD CONSTRAINT afaka_qcm_qcm_r_fkey FOREIGN KEY (qcm_r) REFERENCES public.qcm_result(id_r);


--
-- Name: besoin_achat article; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin_achat
    ADD CONSTRAINT article FOREIGN KEY (idarticle) REFERENCES public.article(id);


--
-- Name: article article_method_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article
    ADD CONSTRAINT article_method_fkey FOREIGN KEY (method) REFERENCES public.method(id);


--
-- Name: avance avance_id_employe_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.avance
    ADD CONSTRAINT avance_id_employe_fkey FOREIGN KEY (id_employe) REFERENCES public.employer(id_emp);


--
-- Name: avantage_nature avantage_nature_etat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.avantage_nature
    ADD CONSTRAINT avantage_nature_etat_fkey FOREIGN KEY (etat) REFERENCES public.etats(id_et);


--
-- Name: avantage_nature avantage_nature_id_emp_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.avantage_nature
    ADD CONSTRAINT avantage_nature_id_emp_fkey FOREIGN KEY (id_emp) REFERENCES public.employer(id_emp);


--
-- Name: avantage_nature avantage_nature_idavantage_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.avantage_nature
    ADD CONSTRAINT avantage_nature_idavantage_fkey FOREIGN KEY (idavantage) REFERENCES public.type_avantage_nature(id);


--
-- Name: besoin_achat besoin_achat_etat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin_achat
    ADD CONSTRAINT besoin_achat_etat_fkey FOREIGN KEY (etat) REFERENCES public.etats(id_et);


--
-- Name: besoin_achat besoin_achat_idmodule_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin_achat
    ADD CONSTRAINT besoin_achat_idmodule_fkey FOREIGN KEY (idmodule) REFERENCES public.module(id);


--
-- Name: besoin besoin_idposte_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin
    ADD CONSTRAINT besoin_idposte_fkey FOREIGN KEY (idposte) REFERENCES public.poste(id);


--
-- Name: besoin besoin_idservice_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin
    ADD CONSTRAINT besoin_idservice_fkey FOREIGN KEY (idservice) REFERENCES public.service(id);


--
-- Name: besoin_immobilisation besoin_immobilisation_etat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin_immobilisation
    ADD CONSTRAINT besoin_immobilisation_etat_fkey FOREIGN KEY (etat) REFERENCES public.etats(id_et);


--
-- Name: besoin_immobilisation besoin_immobilisation_idcategorie_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin_immobilisation
    ADD CONSTRAINT besoin_immobilisation_idcategorie_fkey FOREIGN KEY (idcategorie) REFERENCES public.categorie(id);


--
-- Name: besoin_immobilisation besoin_immobilisation_idimmobilisation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin_immobilisation
    ADD CONSTRAINT besoin_immobilisation_idimmobilisation_fkey FOREIGN KEY (idimmobilisation) REFERENCES public.compte(id);


--
-- Name: besoin_immobilisation besoin_immobilisation_idmodule_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin_immobilisation
    ADD CONSTRAINT besoin_immobilisation_idmodule_fkey FOREIGN KEY (idmodule) REFERENCES public.module(id);


--
-- Name: bon_commande bon_commande_etat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bon_commande
    ADD CONSTRAINT bon_commande_etat_fkey FOREIGN KEY (etat) REFERENCES public.etats(id_et);


--
-- Name: bon_commande bon_commande_type_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bon_commande
    ADD CONSTRAINT bon_commande_type_fkey FOREIGN KEY (type) REFERENCES public.etats(id_et);


--
-- Name: bon_reception bon_reception_etat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bon_reception
    ADD CONSTRAINT bon_reception_etat_fkey FOREIGN KEY (etat) REFERENCES public.etats(id_et);


--
-- Name: bon_reception bon_reception_id_bon_commande_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bon_reception
    ADD CONSTRAINT bon_reception_id_bon_commande_fkey FOREIGN KEY (id_bon_commande) REFERENCES public.bon_commande(id);


--
-- Name: caisse caisse_idcompte_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.caisse
    ADD CONSTRAINT caisse_idcompte_fkey FOREIGN KEY (idcompte) REFERENCES public.compte(id);


--
-- Name: caisse_magasin caisse_magasin_idcaisse_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.caisse_magasin
    ADD CONSTRAINT caisse_magasin_idcaisse_fkey FOREIGN KEY (idcaisse) REFERENCES public.caisse(id);


--
-- Name: caisse_magasin caisse_magasin_idmagasin_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.caisse_magasin
    ADD CONSTRAINT caisse_magasin_idmagasin_fkey FOREIGN KEY (idmagasin) REFERENCES public.magasin(id);


--
-- Name: cnaps cnaps_etat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cnaps
    ADD CONSTRAINT cnaps_etat_fkey FOREIGN KEY (etat) REFERENCES public.etats(id_et);


--
-- Name: cnaps cnaps_id_emp_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cnaps
    ADD CONSTRAINT cnaps_id_emp_fkey FOREIGN KEY (id_emp) REFERENCES public.employer(id_emp);


--
-- Name: compte compte_etat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.compte
    ADD CONSTRAINT compte_etat_fkey FOREIGN KEY (etat) REFERENCES public.etats(id_et);


--
-- Name: confirmation_date confirmation_date_idconge_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.confirmation_date
    ADD CONSTRAINT confirmation_date_idconge_fkey FOREIGN KEY (idconge) REFERENCES public.conge(id);


--
-- Name: conge conge_id_employer_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conge
    ADD CONSTRAINT conge_id_employer_fkey FOREIGN KEY (id_employer) REFERENCES public.employer(id_emp);


--
-- Name: conge conge_id_type_conge_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conge
    ADD CONSTRAINT conge_id_type_conge_fkey FOREIGN KEY (id_type_conge) REFERENCES public.type_conge(id);


--
-- Name: contrat_essaie contrat_essaie_id_emp_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrat_essaie
    ADD CONSTRAINT contrat_essaie_id_emp_fkey FOREIGN KEY (id_emp) REFERENCES public.employer(id_emp);


--
-- Name: contrat_essaie contrat_essaie_id_emp_fkey1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrat_essaie
    ADD CONSTRAINT contrat_essaie_id_emp_fkey1 FOREIGN KEY (id_emp) REFERENCES public.employer(id_emp);


--
-- Name: contrat_essaie contrat_essaie_lieu_travail_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrat_essaie
    ADD CONSTRAINT contrat_essaie_lieu_travail_fkey FOREIGN KEY (lieu_travail) REFERENCES public.liste_adresse_entreprise(id);


--
-- Name: cv cv_idbesoin_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cv
    ADD CONSTRAINT cv_idbesoin_fkey FOREIGN KEY (idbesoin) REFERENCES public.besoin(id);


--
-- Name: cv cv_idclient_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cv
    ADD CONSTRAINT cv_idclient_fkey FOREIGN KEY (idclient) REFERENCES public.client(id);


--
-- Name: cv cv_iddiplome_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cv
    ADD CONSTRAINT cv_iddiplome_fkey FOREIGN KEY (iddiplome) REFERENCES public.diplome(id);


--
-- Name: cv cv_idmatrimoniale_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cv
    ADD CONSTRAINT cv_idmatrimoniale_fkey FOREIGN KEY (idmatrimoniale) REFERENCES public.situation_matrimoniale(id);


--
-- Name: cv cv_idville_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cv
    ADD CONSTRAINT cv_idville_fkey FOREIGN KEY (idville) REFERENCES public.ville(id);


--
-- Name: demande demande_idfournisseur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.demande
    ADD CONSTRAINT demande_idfournisseur_fkey FOREIGN KEY (idfournisseur) REFERENCES public.fournisseur(id);


--
-- Name: demande demande_type_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.demande
    ADD CONSTRAINT demande_type_fkey FOREIGN KEY (type) REFERENCES public.etats(id_et);


--
-- Name: description description_idcategorie_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.description
    ADD CONSTRAINT description_idcategorie_fkey FOREIGN KEY (idcategorie) REFERENCES public.categorie(id);


--
-- Name: details_besoin_age details_besoin_age_idbesoin_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_age
    ADD CONSTRAINT details_besoin_age_idbesoin_fkey FOREIGN KEY (idbesoin) REFERENCES public.besoin(id);


--
-- Name: details_besoin_diplome details_besoin_diplome_idbesoin_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_diplome
    ADD CONSTRAINT details_besoin_diplome_idbesoin_fkey FOREIGN KEY (idbesoin) REFERENCES public.besoin(id);


--
-- Name: details_besoin_diplome details_besoin_diplome_iddiplome_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_diplome
    ADD CONSTRAINT details_besoin_diplome_iddiplome_fkey FOREIGN KEY (iddiplome) REFERENCES public.diplome(id);


--
-- Name: details_besoin_experience details_besoin_experience_idbesoin_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_experience
    ADD CONSTRAINT details_besoin_experience_idbesoin_fkey FOREIGN KEY (idbesoin) REFERENCES public.besoin(id);


--
-- Name: details_besoin_genre details_besoin_genre_idbesoin_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_genre
    ADD CONSTRAINT details_besoin_genre_idbesoin_fkey FOREIGN KEY (idbesoin) REFERENCES public.besoin(id);


--
-- Name: details_besoin_matrimoniale details_besoin_matrimoniale_idbesoin_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_matrimoniale
    ADD CONSTRAINT details_besoin_matrimoniale_idbesoin_fkey FOREIGN KEY (idbesoin) REFERENCES public.besoin(id);


--
-- Name: details_besoin_matrimoniale details_besoin_matrimoniale_idmatrimoniale_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_matrimoniale
    ADD CONSTRAINT details_besoin_matrimoniale_idmatrimoniale_fkey FOREIGN KEY (idmatrimoniale) REFERENCES public.situation_matrimoniale(id);


--
-- Name: details_besoin_nationalite details_besoin_nationalite_idbesoin_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_nationalite
    ADD CONSTRAINT details_besoin_nationalite_idbesoin_fkey FOREIGN KEY (idbesoin) REFERENCES public.besoin(id);


--
-- Name: details_besoin_nationalite details_besoin_nationalite_idnationalite_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_nationalite
    ADD CONSTRAINT details_besoin_nationalite_idnationalite_fkey FOREIGN KEY (idnationalite) REFERENCES public.nationalite(id);


--
-- Name: details_besoin_region details_besoin_region_idbesoin_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_region
    ADD CONSTRAINT details_besoin_region_idbesoin_fkey FOREIGN KEY (idbesoin) REFERENCES public.besoin(id);


--
-- Name: details_besoin_region details_besoin_region_idregion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_region
    ADD CONSTRAINT details_besoin_region_idregion_fkey FOREIGN KEY (idregion) REFERENCES public.region(id);


--
-- Name: details_besoin_salaire details_besoin_salaire_idbesoin_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_salaire
    ADD CONSTRAINT details_besoin_salaire_idbesoin_fkey FOREIGN KEY (idbesoin) REFERENCES public.besoin(id);


--
-- Name: details_besoin_ville details_besoin_ville_idbesoin_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_ville
    ADD CONSTRAINT details_besoin_ville_idbesoin_fkey FOREIGN KEY (idbesoin) REFERENCES public.besoin(id);


--
-- Name: details_besoin_ville details_besoin_ville_idville_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_besoin_ville
    ADD CONSTRAINT details_besoin_ville_idville_fkey FOREIGN KEY (idville) REFERENCES public.ville(id);


--
-- Name: details_bon_commande details_bon_commande_etat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_bon_commande
    ADD CONSTRAINT details_bon_commande_etat_fkey FOREIGN KEY (etat) REFERENCES public.etats(id_et);


--
-- Name: details_bon_commande details_bon_commande_idboncommande_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_bon_commande
    ADD CONSTRAINT details_bon_commande_idboncommande_fkey FOREIGN KEY (idboncommande) REFERENCES public.bon_commande(id);


--
-- Name: details_bon_commande details_bon_commande_idproformat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_bon_commande
    ADD CONSTRAINT details_bon_commande_idproformat_fkey FOREIGN KEY (idproformat) REFERENCES public.proformat(id);


--
-- Name: details_bon_reception details_bon_reception_etat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_bon_reception
    ADD CONSTRAINT details_bon_reception_etat_fkey FOREIGN KEY (etat) REFERENCES public.etats(id_et);


--
-- Name: details_bon_reception details_bon_reception_id_article_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_bon_reception
    ADD CONSTRAINT details_bon_reception_id_article_fkey FOREIGN KEY (id_article) REFERENCES public.article(id);


--
-- Name: details_bon_reception details_bon_reception_id_bon_reception_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_bon_reception
    ADD CONSTRAINT details_bon_reception_id_bon_reception_fkey FOREIGN KEY (id_bon_reception) REFERENCES public.bon_reception(id);


--
-- Name: details_bon_reception details_bon_reception_id_fournisseur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_bon_reception
    ADD CONSTRAINT details_bon_reception_id_fournisseur_fkey FOREIGN KEY (id_fournisseur) REFERENCES public.fournisseur(id);


--
-- Name: details_cv_diplome details_cv_diplome_idcv_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_cv_diplome
    ADD CONSTRAINT details_cv_diplome_idcv_fkey FOREIGN KEY (idcv) REFERENCES public.cv(id);


--
-- Name: details_cv_salaire details_cv_salaire_idcv_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_cv_salaire
    ADD CONSTRAINT details_cv_salaire_idcv_fkey FOREIGN KEY (idcv) REFERENCES public.cv(id);


--
-- Name: details_cv_travail_anterieur details_cv_travail_anterieur_idcv_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_cv_travail_anterieur
    ADD CONSTRAINT details_cv_travail_anterieur_idcv_fkey FOREIGN KEY (idcv) REFERENCES public.cv(id);


--
-- Name: details_pv_reception details_pv_reception_id_pv_reception_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_pv_reception
    ADD CONSTRAINT details_pv_reception_id_pv_reception_fkey FOREIGN KEY (id_pv_reception) REFERENCES public.pv_reception(id);


--
-- Name: details_sortie details_sortie_types_sortie_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_sortie
    ADD CONSTRAINT details_sortie_types_sortie_fkey FOREIGN KEY (types_sortie) REFERENCES public.type_sortie(id);


--
-- Name: details_utilisation details_utilisation_etat_immobilisation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_utilisation
    ADD CONSTRAINT details_utilisation_etat_immobilisation_fkey FOREIGN KEY (etat_immobilisation) REFERENCES public.etat_immobilisation(id);


--
-- Name: details_utilisation details_utilisation_immobilisation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_utilisation
    ADD CONSTRAINT details_utilisation_immobilisation_fkey FOREIGN KEY (immobilisation) REFERENCES public.immobilisation_reception(id_immobilisation);


--
-- Name: details_utilisation details_utilisation_pv_utilisation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_utilisation
    ADD CONSTRAINT details_utilisation_pv_utilisation_fkey FOREIGN KEY (pv_utilisation) REFERENCES public.pv_utilisation(id);


--
-- Name: employer employer_etat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employer
    ADD CONSTRAINT employer_etat_fkey FOREIGN KEY (etat) REFERENCES public.etats(id_et);


--
-- Name: employer employer_idclient_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employer
    ADD CONSTRAINT employer_idclient_fkey FOREIGN KEY (idclient) REFERENCES public.client(id);


--
-- Name: employer_module employer_module_idemploye_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employer_module
    ADD CONSTRAINT employer_module_idemploye_fkey FOREIGN KEY (idemploye) REFERENCES public.employer(id_emp);


--
-- Name: employer_module employer_module_idmodule_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employer_module
    ADD CONSTRAINT employer_module_idmodule_fkey FOREIGN KEY (idmodule) REFERENCES public.module(id);


--
-- Name: entre entre_article_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entre
    ADD CONSTRAINT entre_article_fkey FOREIGN KEY (article) REFERENCES public.article(id);


--
-- Name: entre entre_module_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entre
    ADD CONSTRAINT entre_module_fkey FOREIGN KEY (module) REFERENCES public.module(id);


--
-- Name: entre entre_reception_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entre
    ADD CONSTRAINT entre_reception_fkey FOREIGN KEY (reception) REFERENCES public.bon_reception(id);


--
-- Name: entretient entretient_aa_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entretient
    ADD CONSTRAINT entretient_aa_fkey FOREIGN KEY (aa) REFERENCES public.afaka_qcm(id_as);


--
-- Name: explication explication_article_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.explication
    ADD CONSTRAINT explication_article_fkey FOREIGN KEY (article) REFERENCES public.article(id);


--
-- Name: explication explication_module_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.explication
    ADD CONSTRAINT explication_module_fkey FOREIGN KEY (module) REFERENCES public.module(id);


--
-- Name: explication explication_reception_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.explication
    ADD CONSTRAINT explication_reception_fkey FOREIGN KEY (reception) REFERENCES public.bon_reception(id);


--
-- Name: finance finance_idcompte_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.finance
    ADD CONSTRAINT finance_idcompte_fkey FOREIGN KEY (idcompte) REFERENCES public.compte(id);


--
-- Name: besoin fk_type_contrat; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin
    ADD CONSTRAINT fk_type_contrat FOREIGN KEY (id_type_contrat) REFERENCES public.type_contrat(id);


--
-- Name: historique historique_article_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historique
    ADD CONSTRAINT historique_article_fkey FOREIGN KEY (article) REFERENCES public.article(id);


--
-- Name: historique_bon_commande historique_bon_commande_etat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historique_bon_commande
    ADD CONSTRAINT historique_bon_commande_etat_fkey FOREIGN KEY (etat) REFERENCES public.etats(id_et);


--
-- Name: historique_bon_commande historique_bon_commande_idboncommande_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historique_bon_commande
    ADD CONSTRAINT historique_bon_commande_idboncommande_fkey FOREIGN KEY (idboncommande) REFERENCES public.bon_commande(id);


--
-- Name: historique_embauche historique_embauche_etat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historique_embauche
    ADD CONSTRAINT historique_embauche_etat_fkey FOREIGN KEY (etat) REFERENCES public.etats(id_et);


--
-- Name: historique_embauche historique_embauche_id_emp_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historique_embauche
    ADD CONSTRAINT historique_embauche_id_emp_fkey FOREIGN KEY (id_emp) REFERENCES public.employer(id_emp);


--
-- Name: historique historique_entre_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historique
    ADD CONSTRAINT historique_entre_fkey FOREIGN KEY (entre) REFERENCES public.entre(id);


--
-- Name: immobilisation_reception immobilisation_reception_id_etat_immobilisation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.immobilisation_reception
    ADD CONSTRAINT immobilisation_reception_id_etat_immobilisation_fkey FOREIGN KEY (id_etat_immobilisation) REFERENCES public.etat_immobilisation(id);


--
-- Name: immobilisation_reception immobilisation_reception_id_pv_reception_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.immobilisation_reception
    ADD CONSTRAINT immobilisation_reception_id_pv_reception_fkey FOREIGN KEY (id_pv_reception) REFERENCES public.pv_reception(id);


--
-- Name: inventaire inventaire_ammortissement_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inventaire
    ADD CONSTRAINT inventaire_ammortissement_fkey FOREIGN KEY (ammortissement) REFERENCES public.type_ammortissement(id);


--
-- Name: inventaire inventaire_etat_immobilisation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inventaire
    ADD CONSTRAINT inventaire_etat_immobilisation_fkey FOREIGN KEY (etat_immobilisation) REFERENCES public.etat_immobilisation(id);


--
-- Name: inventaire inventaire_immobilisation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inventaire
    ADD CONSTRAINT inventaire_immobilisation_fkey FOREIGN KEY (immobilisation) REFERENCES public.immobilisation_reception(id_immobilisation);


--
-- Name: lieu lieu_id_etat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lieu
    ADD CONSTRAINT lieu_id_etat_fkey FOREIGN KEY (id_etat) REFERENCES public.etats(id_et);


--
-- Name: livreur livreur_id_fournisseur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.livreur
    ADD CONSTRAINT livreur_id_fournisseur_fkey FOREIGN KEY (id_fournisseur) REFERENCES public.fournisseur(id);


--
-- Name: mouvement mouvement_idreception_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mouvement
    ADD CONSTRAINT mouvement_idreception_fkey FOREIGN KEY (idreception) REFERENCES public.bon_reception(id);


--
-- Name: mouvement mouvement_produits_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mouvement
    ADD CONSTRAINT mouvement_produits_fkey FOREIGN KEY (produits) REFERENCES public.article(id);


--
-- Name: note_cv note_cv_idcv_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.note_cv
    ADD CONSTRAINT note_cv_idcv_fkey FOREIGN KEY (idcv) REFERENCES public.cv(id);


--
-- Name: ok_vita ok_vita_id_e_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ok_vita
    ADD CONSTRAINT ok_vita_id_e_fkey FOREIGN KEY (id_e) REFERENCES public.entretient(id_e);


--
-- Name: ok_vita ok_vita_id_et_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ok_vita
    ADD CONSTRAINT ok_vita_id_et_fkey FOREIGN KEY (id_et) REFERENCES public.etats(id_et);


--
-- Name: pointage pointage_id_employer_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pointage
    ADD CONSTRAINT pointage_id_employer_fkey FOREIGN KEY (id_employer) REFERENCES public.employer(id_emp);


--
-- Name: pointage pointage_securite_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pointage
    ADD CONSTRAINT pointage_securite_fkey FOREIGN KEY (securite) REFERENCES public.administrateur(id);


--
-- Name: prime prime_id_employe_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prime
    ADD CONSTRAINT prime_id_employe_fkey FOREIGN KEY (id_employe) REFERENCES public.employer(id_emp);


--
-- Name: prime prime_type_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prime
    ADD CONSTRAINT prime_type_fkey FOREIGN KEY (type) REFERENCES public.type_prime(id);


--
-- Name: proche proche_etat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proche
    ADD CONSTRAINT proche_etat_fkey FOREIGN KEY (etat) REFERENCES public.etats(id_et);


--
-- Name: proche proche_id_emp_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proche
    ADD CONSTRAINT proche_id_emp_fkey FOREIGN KEY (id_emp) REFERENCES public.employer(id_emp);


--
-- Name: proformat proformat_idfournisseur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proformat
    ADD CONSTRAINT proformat_idfournisseur_fkey FOREIGN KEY (idfournisseur) REFERENCES public.fournisseur(id);


--
-- Name: pv_reception pv_reception_id_article_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pv_reception
    ADD CONSTRAINT pv_reception_id_article_fkey FOREIGN KEY (id_article) REFERENCES public.compte(id);


--
-- Name: pv_reception pv_reception_id_bon_commande_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pv_reception
    ADD CONSTRAINT pv_reception_id_bon_commande_fkey FOREIGN KEY (id_bon_commande) REFERENCES public.bon_commande(id);


--
-- Name: pv_reception pv_reception_id_categorie_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pv_reception
    ADD CONSTRAINT pv_reception_id_categorie_fkey FOREIGN KEY (id_categorie) REFERENCES public.categorie(id);


--
-- Name: pv_reception pv_reception_id_type_ammortissement_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pv_reception
    ADD CONSTRAINT pv_reception_id_type_ammortissement_fkey FOREIGN KEY (id_type_ammortissement) REFERENCES public.type_ammortissement(id);


--
-- Name: pv_utilisation pv_utilisation_module_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pv_utilisation
    ADD CONSTRAINT pv_utilisation_module_fkey FOREIGN KEY (module) REFERENCES public.module(id);


--
-- Name: pv_utilisation pv_utilisation_reception_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pv_utilisation
    ADD CONSTRAINT pv_utilisation_reception_fkey FOREIGN KEY (reception) REFERENCES public.pv_reception(id);


--
-- Name: qcm_admis qcm_admis_id_annonce_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.qcm_admis
    ADD CONSTRAINT qcm_admis_id_annonce_fkey FOREIGN KEY (id_annonce) REFERENCES public.besoin(id);


--
-- Name: qcm_result qcm_result_qcm_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.qcm_result
    ADD CONSTRAINT qcm_result_qcm_fkey FOREIGN KEY (qcm) REFERENCES public.qcm_admis(id_qcm);


--
-- Name: question_posee question_pos‚e_id_qcm_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.question_posee
    ADD CONSTRAINT "question_pos‚e_id_qcm_fkey" FOREIGN KEY (id_qcm) REFERENCES public.qcm_admis(id_qcm);


--
-- Name: reponse_faux reponse_faux_id_q_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reponse_faux
    ADD CONSTRAINT reponse_faux_id_q_fkey FOREIGN KEY (id_q) REFERENCES public.question_posee(id_q);


--
-- Name: reponse_q reponse_q_id_question_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reponse_q
    ADD CONSTRAINT reponse_q_id_question_fkey FOREIGN KEY (id_question) REFERENCES public.question_posee(id_q);


--
-- Name: salaire salaire_id_emp_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.salaire
    ADD CONSTRAINT salaire_id_emp_fkey FOREIGN KEY (id_emp) REFERENCES public.employer(id_emp);


--
-- Name: solde_conge solde_conge_idconge_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solde_conge
    ADD CONSTRAINT solde_conge_idconge_fkey FOREIGN KEY (idconge) REFERENCES public.conge(id);


--
-- Name: sortie sortie_article_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sortie
    ADD CONSTRAINT sortie_article_fkey FOREIGN KEY (article) REFERENCES public.article(id);


--
-- Name: sortie_departement sortie_departement_module_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sortie_departement
    ADD CONSTRAINT sortie_departement_module_fkey FOREIGN KEY (module) REFERENCES public.module(id);


--
-- Name: sortie_departement sortie_departement_sortie_details_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sortie_departement
    ADD CONSTRAINT sortie_departement_sortie_details_fkey FOREIGN KEY (sortie_details) REFERENCES public.sortie(id);


--
-- Name: sortie sortie_entre_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sortie
    ADD CONSTRAINT sortie_entre_fkey FOREIGN KEY (entre) REFERENCES public.entre(id);


--
-- Name: sortie sortie_types_sortie_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sortie
    ADD CONSTRAINT sortie_types_sortie_fkey FOREIGN KEY (types_sortie) REFERENCES public.type_sortie(id);


--
-- Name: sortie_vente sortie_vente_article_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sortie_vente
    ADD CONSTRAINT sortie_vente_article_fkey FOREIGN KEY (article) REFERENCES public.article(id);


--
-- Name: sortie_vente sortie_vente_lieu_vente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sortie_vente
    ADD CONSTRAINT sortie_vente_lieu_vente_fkey FOREIGN KEY (lieu_vente) REFERENCES public.magasin(id);


--
-- Name: sortie_vente sortie_vente_numero_caisse_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sortie_vente
    ADD CONSTRAINT sortie_vente_numero_caisse_fkey FOREIGN KEY (numero_caisse) REFERENCES public.caisse(id);


--
-- Name: sous_categorie_type sous_categorie_type_etat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sous_categorie_type
    ADD CONSTRAINT sous_categorie_type_etat_fkey FOREIGN KEY (etat) REFERENCES public.etats(id_et);


--
-- Name: sous_categorie_type sous_categorie_type_idcategorie_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sous_categorie_type
    ADD CONSTRAINT sous_categorie_type_idcategorie_fkey FOREIGN KEY (idcategorie) REFERENCES public.categorie(id);


--
-- Name: sous_categorie_type sous_categorie_type_type_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sous_categorie_type
    ADD CONSTRAINT sous_categorie_type_type_fkey FOREIGN KEY (type) REFERENCES public.compte(id);


--
-- Name: tafiditra_mpiasa tafiditra_mpiasa_id_ok_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tafiditra_mpiasa
    ADD CONSTRAINT tafiditra_mpiasa_id_ok_fkey FOREIGN KEY (id_ok) REFERENCES public.ok_vita(id_o);


--
-- Name: ville ville_idregion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ville
    ADD CONSTRAINT ville_idregion_fkey FOREIGN KEY (idregion) REFERENCES public.region(id);


--
-- PostgreSQL database dump complete
--

