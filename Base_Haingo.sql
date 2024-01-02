--
-- PostgreSQL database dump
--

-- Dumped from database version 15.4
-- Dumped by pg_dump version 15.4

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

SET default_tablespace = '';

SET default_table_access_method = heap;

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
    method integer
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
    iddemande character varying(10) DEFAULT NULL::character varying
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
-- Name: bon_commande; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bon_commande (
    id character varying(10) NOT NULL,
    date date,
    etat integer,
    idpayement integer,
    delailivarison double precision DEFAULT 0
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
    etat integer
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
  GROUP BY besoin_achat.iddemande;


ALTER TABLE public.demande_proformat OWNER TO postgres;

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
    montant double precision GENERATED ALWAYS AS (((quantite)::double precision * prix_unitaire)) STORED,
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
  GROUP BY besoin_achat.iddemande, besoin_achat.idarticle;


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
  GROUP BY besoin_achat.iddemande, besoin_achat.idarticle, besoin_achat.idmodule;


ALTER TABLE public.liste_besoin_achat_avec_quantite OWNER TO postgres;

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
    bon_commande.delailivarison
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
    bon_commande.delailivarison
   FROM public.bon_commande
  WHERE (bon_commande.etat = 45);


ALTER TABLE public.liste_bon_commande_terminer OWNER TO postgres;

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
    (((b.nombre)::double precision * l.prixunitaire) * l.tva) AS prixat
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
-- Name: module; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.module (
    id integer NOT NULL,
    type character varying(50)
);


ALTER TABLE public.module OWNER TO postgres;

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
-- Name: produits; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.produits AS
 SELECT a.id,
    a.article,
    t.types
   FROM (public.article a
     JOIN public.method t ON ((a.method = t.id)));


ALTER TABLE public.produits OWNER TO postgres;

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
    details_sortie character varying(256),
    prix_unitaire double precision,
    tva_origine integer,
    numero_caisse character varying(10)
);


ALTER TABLE public.sortie_vente OWNER TO postgres;

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
    liste_besoin_achat_avec_quantite.nombre AS quantite_article,
    module.id AS id_module,
    module.type AS module
   FROM ((((((public.bon_reception
     JOIN public.bon_commande ON (((bon_reception.id_bon_commande)::text = (bon_commande.id)::text)))
     JOIN public.details_bon_commande ON (((bon_reception.id_bon_commande)::text = (details_bon_commande.idboncommande)::text)))
     JOIN public.proformat ON ((details_bon_commande.idproformat = proformat.id)))
     JOIN public.article ON (((proformat.idarticle)::text = (article.id)::text)))
     JOIN public.liste_besoin_achat_avec_quantite ON (((proformat.iddemande)::text = (liste_besoin_achat_avec_quantite.iddemande)::text)))
     JOIN public.module ON ((liste_besoin_achat_avec_quantite.idmodule = module.id)))
  WHERE ((proformat.idarticle)::text = (liste_besoin_achat_avec_quantite.idarticle)::text);


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
-- Name: v_vente; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_vente AS
 SELECT v.lieu_vente,
    s.dates,
    s.article,
    article.article AS nom_article,
    s.quantite,
    v.prix_unitaire,
    v.numero_caisse
   FROM ((public.sortie_vente v
     JOIN public.sortie s ON (((v.details_sortie)::text = (s.id)::text)))
     JOIN public.article ON (((s.article)::text = (article.id)::text)));


ALTER TABLE public.v_vente OWNER TO postgres;

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
-- Name: etats id_et; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etats ALTER COLUMN id_et SET DEFAULT nextval('public.etats_id_et_seq'::regclass);


--
-- Name: explication id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.explication ALTER COLUMN id SET DEFAULT nextval('public.explication_id_seq'::regclass);


--
-- Name: fournisseur id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fournisseur ALTER COLUMN id SET DEFAULT nextval('public.fournisseur_id_seq'::regclass);


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

COPY public.article (id, article, method) FROM stdin;
G0001	Gel main	1
S0001	Savon	1
P0001	Papier A4	1
E0001	Encre	1
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

COPY public.besoin_achat (id, idmodule, idarticle, nombre, date, etat, iddemande) FROM stdin;
6	1	S0001	10	2023-11-11	32	DMD0000002
7	2	P0001	150	2023-11-11	32	DMD0000002
8	7	P0001	200	2023-12-17	32	DMD0000002
10	8	S0001	25	2023-12-23	32	DMD0000012
9	8	G0001	2	2023-11-18	40	DMD0000011
1	6	P0001	50	2023-11-02	45	DMD0000001
2	2	P0001	50	2023-11-01	45	DMD0000001
3	2	E0001	12	2023-11-01	45	DMD0000001
4	5	G0001	15	2023-11-04	45	DMD0000001
5	8	P0001	500	2023-11-06	45	DMD0000001
\.


--
-- Data for Name: bon_commande; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bon_commande (id, date, etat, idpayement, delailivarison) FROM stdin;
BOC0000001	2023-12-04	32	\N	0
BC00000007	2023-12-07	40	5	5
BC00000004	2023-12-05	45	10	26
\.


--
-- Data for Name: bon_reception; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bon_reception (id, lieu, date, id_bon_commande, id_recepteur, etat) FROM stdin;
BR00000006	J	2023-12-01	BC00000004	12	32
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

COPY public.demande (id, date, nom, iddemande, idfournisseur, etat) FROM stdin;
7	2023-11-18	Demande	DMD0000002	1	1
8	2023-11-18	Demande	DMD0000002	3	1
9	2023-11-18	Demande	DMD0000002	5	1
10	2023-12-01	Proforma pour du gel	DMD0000011	2	1
11	2023-12-01	Proforma pour du gel	DMD0000011	5	1
12	2023-12-25	les outils necessaires	DMD0000012	1	1
13	2023-12-25	les outils necessaires	DMD0000012	2	1
14	2023-12-25	les outils necessaires	DMD0000012	5	1
1	2023-11-10	Besoin des departements	DMD0000001	2	5
2	2023-11-10	Besoin des departements	DMD0000001	5	5
3	2023-11-10	Besoin des departements	DMD0000001	3	5
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
\.


--
-- Data for Name: details_bon_reception; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_bon_reception (id_bon_reception, id_article, id_fournisseur, date, etat) FROM stdin;
BR00000006	E0001	5	2023-12-01	32
BR00000006	P0001	3	2023-12-01	32
BR00000006	G0001	2	2023-12-01	32
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
-- Data for Name: details_sortie; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_sortie (id, sortie, types_sortie) FROM stdin;
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

COPY public.entre (id, dates, reception, article, quantite, prix_unitaire, module) FROM stdin;
E0035	2023-12-01	BR00000006	G0001	15	5000	5
E0036	2023-12-01	BR00000006	P0001	50	100	6
E0037	2023-12-01	BR00000006	P0001	50	100	2
E0034	2024-01-10	BR00000006	E0001	7	10000	2
E0038	2024-01-09	BR00000006	P0001	495	100	8
E0039	2024-01-03	BR00000006	E0001	20	2400	8
E0040	2024-01-10	BR00000006	E0001	20	2000	8
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
\.


--
-- Data for Name: explication; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.explication (id, dates, motif, reception, module, article, quantite) FROM stdin;
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
H0014	2023-12-01	E0034	E0001	12
H0015	2023-12-01	E0038	P0001	500
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
-- Data for Name: liste_adresse_entreprise; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.liste_adresse_entreprise (id, adresse, date) FROM stdin;
1	M 203 Mahabo Andoharanofotsy	\N
2	Lot F-102 Fiadanamanga	\N
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
3	DMD0000001	2	E0001	12000	2	2023-11-17
4	DMD0000001	2	G0001	5000	5	2023-11-17
5	DMD0000001	2	P0001	150	1	2023-11-18
7	DMD0000001	5	E0001	10000	2	2023-11-18
8	DMD0000001	3	P0001	100	1	2023-11-18
10	DMD0000011	5	G0001	4500	1.2	2023-12-15
11	DMD0000011	2	G0001	5000	2	2023-12-06
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
S011	2024-01-10	E0034	E0001	5	1
S012	2024-01-09	E0038	P0001	5	2
\.


--
-- Data for Name: sortie_departement; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sortie_departement (id, sortie_details, module) FROM stdin;
2	S011	2
\.


--
-- Data for Name: sortie_vente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sortie_vente (id, lieu_vente, details_sortie, prix_unitaire, tva_origine, numero_caisse) FROM stdin;
V003	Mahabo	S012	100	2	C_10
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

SELECT pg_catalog.setval('public.administrateur_id_seq', 14, true);


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

SELECT pg_catalog.setval('public.besoin_achat_id_seq', 10, true);


--
-- Name: besoin_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.besoin_id_seq', 1, true);


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

SELECT pg_catalog.setval('public.demande_id_seq', 14, true);


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

SELECT pg_catalog.setval('public.details_bon_commande_id_seq', 9, true);


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
-- Name: etats_id_et_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.etats_id_et_seq', 1, false);


--
-- Name: explication_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.explication_id_seq', 1, false);


--
-- Name: fournisseur_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fournisseur_id_seq', 5, true);


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

SELECT pg_catalog.setval('public.module_id_seq', 9, true);


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

SELECT pg_catalog.setval('public.proformat_id_seq', 11, true);


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
-- Name: seqboncommande; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqboncommande', 7, true);


--
-- Name: seqbonlivraison; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqbonlivraison', 1, false);


--
-- Name: seqbonreception; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqbonreception', 6, true);


--
-- Name: seqcnaps; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqcnaps', 10, true);


--
-- Name: seqdemande; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqdemande', 12, true);


--
-- Name: seqemploye; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqemploye', 18, true);


--
-- Name: seqentre; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqentre', 40, true);


--
-- Name: seqhistorique; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqhistorique', 15, true);


--
-- Name: seqsortie; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seqsortie', 12, true);


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

SELECT pg_catalog.setval('public.sortie_departement_id_seq', 2, true);


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
-- Name: impot impot_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.impot
    ADD CONSTRAINT impot_pkey PRIMARY KEY (id);


--
-- Name: liste_adresse_entreprise liste_adresse_entreprise_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liste_adresse_entreprise
    ADD CONSTRAINT liste_adresse_entreprise_pkey PRIMARY KEY (id);


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
-- Name: besoin_achat besoin_achat_idarticle_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.besoin_achat
    ADD CONSTRAINT besoin_achat_idarticle_fkey FOREIGN KEY (idarticle) REFERENCES public.article(id);


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
-- Name: bon_commande bon_commande_etat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bon_commande
    ADD CONSTRAINT bon_commande_etat_fkey FOREIGN KEY (etat) REFERENCES public.etats(id_et);


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
-- Name: details_sortie details_sortie_types_sortie_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_sortie
    ADD CONSTRAINT details_sortie_types_sortie_fkey FOREIGN KEY (types_sortie) REFERENCES public.type_sortie(id);


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
-- Name: proformat proformat_idarticle_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proformat
    ADD CONSTRAINT proformat_idarticle_fkey FOREIGN KEY (idarticle) REFERENCES public.article(id);


--
-- Name: proformat proformat_idfournisseur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proformat
    ADD CONSTRAINT proformat_idfournisseur_fkey FOREIGN KEY (idfournisseur) REFERENCES public.fournisseur(id);


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
-- Name: sortie_vente sortie_vente_details_sortie_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sortie_vente
    ADD CONSTRAINT sortie_vente_details_sortie_fkey FOREIGN KEY (details_sortie) REFERENCES public.sortie(id);


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

