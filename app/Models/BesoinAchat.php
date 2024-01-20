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
    public $description = "";

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
            $requete = "insert into besoin_achat(idmodule, idarticle, nombre, date, etat, description) values (".$this->idModule.",'".$this->idArticle."', '".$this->nombre."', '".$this->date."', '".$this->etat."', '".$this->description."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Besoin: ".$e->getMessage());
        }    
    }

    public function insertImmobilisation() {
        try {
            $requete = "insert into besoin_immobilisation(idmodule, idimmobilisation, nombre, date, etat, description) values (".$this->idModule.",'".$this->idArticle."', '".$this->nombre."', '".$this->date."', '".$this->etat."', '".$this->description."')";
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

    public function ajoutIdDemandeImmobilier($idDemande) {
        try {
            $requete = "update besoin_immobilisation set idDemande = '$idDemande', etat = 32 where etat = 28";
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
                $article = (new Article(id: $resultat->idarticle))->getDonneesUnArticle();
                $besoin->article = $article;
                $liste[] = $besoin;
            }
        }
        return $liste;
    }

    public function getDetailsBesoinNonValide() {
        $requette = "select * from besoin_achat where etat = 28 order by date asc, idArticle asc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $besoin = new BesoinAchat($resultat->id, $resultat->idmodule, $resultat->idarticle, $resultat->nombre, $resultat->date, $resultat->etat);
                $besoin->description = $resultat->description;
                $article = (new Article(id: $resultat->idarticle))->getDonneesUnArticle();
                $besoin->article = $article;
                $liste[] = $besoin;
            }
        }
        return $liste;
    }

    public function getDetailsBesoinImmobilierNonValide() {
        $requette = "select * from liste_besoin_immobilisation_non_valide order by date asc, idArticle asc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $besoin = new BesoinAchat($resultat->id, $resultat->idmodule, $resultat->idarticle, $resultat->nombre, $resultat->date, $resultat->etat);
                $besoin->description = $resultat->description;
                $compte = (new Compte(id: $resultat->idarticle))->getCompte();
                $article = new Article(id: $compte->id, article: $compte->nom);
                $besoin->article = $article;
                $liste[] = $besoin;
            }
        }
        return $liste;
    }

    public function getListeBesoinNonValideParModule() {
        $requette = "select * from liste_besoin_achat_par_module where etat != 45 AND idModule = ". $this->idModule ." order by date asc, idArticle asc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $besoin = new BesoinAchat($resultat->id, $resultat->idmodule, $resultat->idarticle, $resultat->nombre, $resultat->date, $resultat->etat);
                $besoin->description = $resultat->description;
                $article = (new Article(id: $resultat->idarticle))->getDonneesUnArticle();
                if($article == null) {
                    $compte = (new Compte(id: $resultat->idarticle))->getCompte();
                    $article = new Article(id: $compte->id, article: $compte->nom);
                }
                $besoin->article = $article;
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

    public function updateEtatImmobilier() {
        try {
            $requete = "update besoin_immobilisation set etat = $this->etat where id = $this->id";
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
                $article = (new Article(id: $resultat->idarticle))->getDonneesUnArticle();
                if($article == null) {
                    $compte = (new Compte(id: $resultat->idarticle))->getCompte();
                    $article = new Article(id: $compte->id, article: $compte->nom);
                }
                $besoin->article = $article;
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

    public function updateEtatParIdDemandeImmobilisation($idDemande) {
        try {
            $requete = "update besoin_immobilisation set etat = $this->etat where idDemande = '$idDemande'";
            DB::update($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Etats: ".$e->getMessage());
        }  
    }

    public function updateEtatBesoin_Achat($idModule,$idarticle, $iddemande){
        $requete = "update besoin_achat set etat= $this->etat where idmodule = '$idModule' and idarticle = '$idarticle' and iddemande = '$iddemande'";
        DB::update($requete);
        
    }

    public function getDescription($idDemande) {
        $requette = "select * from besoin_achat where idDemande = '$idDemande' and idArticle = '$this->idArticle'";
        $reponse = DB::select($requette);
        $description = "";
        if(count($reponse) > 0) {
            if(count($reponse) == 1){
                $description = $reponse[0]->description;
            }
            else if(count($reponse) > 1){
                $description = "Achat $this->idArticle";
            }
        } else {
            $requette = "select * from besoin_immobilisation where idDemande = '$idDemande' and idimmobilisation = '$this->idArticle'";
            $reponse = DB::select($requette);
            if(count($reponse) > 0) 
                $description = $reponse[0]->description;
        }

        return $description;
    }

}
