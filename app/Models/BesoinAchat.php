<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

class BesoinAchat extends Model
{
    public $id;
    public $idModule;
    public $idArticle;
    public $nombre;
    public $date;
    public $etat;

    public $article;

    public function __construct($id = "", $idModule = "", $idArticle = "", $nombre = "", $date = "", $etat = "") {
        $this->id = $id;
        $this->idModule = $idModule;
        $this->idArticle = $idArticle;
        $this->nombre = $nombre;
        $this->date = $date;
        $this->etat = $etat;
    }

    public function insert() {
        try {
            $requete = "insert into besoin_achat(idmodule, idarticle, nombre, date, etat) values (".$this->idModule.",'".$this->idArticle."', '".$this->nombre."', '".$this->date."', '".$this->etat."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Besoin: ".$e->getMessage());
        }    
    }

    public function ajoutIdDemande($idDemande) {
        try {
            $requete = "update besoin_achat set idDemande = '$idDemande', etat = 32 where etat = 28";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Etats: ".$e->getMessage());
        }    
    }

    public function getListeBesoinNonValide() {
        $requette = "select * from liste_besoin_achat order by idArticle asc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $besoin = new BesoinAchat(idArticle: $resultat->idarticle, nombre: $resultat->nombre);
                $besoin->article = (new Article(id: $resultat->idarticle))->getDonneesUnArticle();
                $liste[] = $besoin;
            }
        }
        return $liste;
    }

    public function getDetailsBesoinNonValide() {
        $requette = "select * from besoin_achat where etat = 28 order by date asc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $besoin = new BesoinAchat($resultat->id, $resultat->idmodule, $resultat->idarticle, $resultat->nombre, $resultat->date, $resultat->etat);
                $besoin->article = (new Article(id: $resultat->idarticle))->getDonneesUnArticle();
                $liste[] = $besoin;
            }
        }
        return $liste;
    }

    public function getListeBesoinNonValideParModule() {
        $requette = "select * from besoin_achat where (etat != 45) and idModule = ". $this->idModule ." order by date desc, idArticle asc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $besoin = new BesoinAchat($resultat->id, $resultat->idmodule, $resultat->idarticle, $resultat->nombre, $resultat->date, $resultat->etat);
                $besoin->article = (new Article(id: $resultat->idarticle))->getDonneesUnArticle();
                $liste[] = $besoin;
            }
        }
        return $liste;
    }

    public function getEtat() {
        $etats = (new Etats(id_e: $this->etat))->getDonnes_Un_Etat();
        return $etats->nom_etats;
    }

    public function getModule() {
        $module = new Module();
        $module = $module->getUneModule($this->idModule);
        return $module->type;
    }

    public function updateEtat() {
        try {
            $requete = "update besoin_achat set etat = 25 where id = $this->id";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Besoin: ".$e->getMessage());
        }    
    }

    public function getNextDemande() {
        $requette = "select nextSeqEmploye()";
        $reponse = DB::select($requette);
        $id = "DMD";
        if(count($reponse) > 0){
            $index = "" . $reponse[0]->nextseqemploye;
            for($i = 0; $i<(10-(strlen($index)+3)); $i++)  {
                $id = $id . "0";
            }
            $id = $id . $index;
        }
        return $id;
    }

    public function getListeArticleParDemande($idDemande) {
        $requette = "select * from liste_article_par_demande where idDemande = '$idDemande' order by idArticle";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $besoin = new BesoinAchat(idArticle: $resultat->idarticle);
                $besoin->article = (new Article(id: $resultat->idarticle))->getDonneesUnArticle();
                $liste[] = $besoin;
            }
        }
        return $liste;
    }

    public function updateEtatParIdDemande($idDemande) {
        try {
            $requete = "update besoin_achat set etat = $this->etat where idDemande = '$idDemande'";
            DB::update($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Etats: ".$e->getMessage());
        }  
    }

}
