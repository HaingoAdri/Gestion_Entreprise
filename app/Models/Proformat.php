<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

class Proformat extends Model
{
    public $id;
    public $idDemande;
    public $idFournisseur;
    public $idArticle;
    public $prixUnitaire;
    public $TVA;
    public $date;

    public $quantite;
    public $prixHT;
    public $prixAT;

    public $sommePrixHT;
    public $sommePrixAT;
    public $sommeTVA;

    public function __construct($id = "", $idDemande = "", $idFournisseur = "", $idArticle = "", $prixUnitaire = "", $TVA = "", $date = "") {
        $this->id = $id;
        $this->idDemande = $idDemande;
        $this->idFournisseur = $idFournisseur;
        $this->idArticle = $idArticle;
        $this->prixUnitaire = $prixUnitaire;
        $this->TVA = $TVA;
        $this->date = $date;
    }

    public function insert() {
        try {
            $requete = "insert into proformat(idDemande, idFournisseur, idArticle, prixUnitaire, tva, date) values ('$this->idDemande','$this->idFournisseur', '$this->idArticle', '$this->prixUnitaire', '$this->TVA', '$this->date')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert proformat: ".$e->getMessage());
        }    
    }

    public function getListeProformat() {
        $requette = "select * from proformat where idDemande = '$this->idDemande' and idFournisseur = $this->idFournisseur order by date asc, idArticle asc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $proformat = new Proformat($resultat->id, $resultat->iddemande, $resultat->idfournisseur, $resultat->idarticle, $resultat->prixunitaire, $resultat->tva, $resultat->date);
                $liste[] = $proformat;
            }
        }
        return $liste;
    }

    public function getArticle() {
        $article = (new Article(id: $this->idArticle))->getDonneesUnArticle();
        return $article->article;
    }

    public function getListeMeulleurProformat() {
        $requette = "select * from prix_minimum_proformat where idDemande = '$this->idDemande' order by idDemande asc, idArticle asc, prixat asc";
        $reponse = DB::select($requette);
        $liste = array();
        $listeArticle = array();
        $prixHT = 0;
        $prixAT = 0;
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                if(!in_array($resultat->idarticle, $listeArticle)) {
                    $listeArticle[] = $resultat->idarticle;
                    $proformat = new Proformat($resultat->id, $resultat->iddemande, $resultat->idfournisseur, $resultat->idarticle, $resultat->prixunitaire, $resultat->tva, "");
                    $proformat->quantite = $resultat->quantite;
                    $proformat->prixHT = $resultat->prixht;
                    $proformat->prixAT = $resultat->prixat;

                    $prixHT += $proformat->prixHT;
                    $prixAT += $proformat->prixAT;

                    $liste[] = $proformat;
                }
            }
            $proformat = new ProFormat();
            $proformat->prixHT = $prixHT;
            $proformat->prixAT = $prixAT;
            $liste[] = $proformat;
        }
        return $liste;
    }

    public function getNomFournisseur() {
        $fournisseur = (new Fournisseur(id: $this->idFournisseur))->getDonneesUnFournisseur();
        return $fournisseur->nom;
    }

    public function getListeProformatParIdBonCommande($idBonCommande) {
        $requette = "select * from liste_details_bon_de_commande where idboncommande = '$idBonCommande' order by idArticle asc";
        $reponse = DB::select($requette);
        $liste = array();
        $listeArticle = array();
        $prixHT = 0;
        $prixAT = 0;
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                if(!in_array($resultat->idarticle, $listeArticle)) {
                    $listeArticle[] = $resultat->idarticle;
                    $proformat = new Proformat($resultat->id, $resultat->iddemande, $resultat->idfournisseur, $resultat->idarticle, $resultat->prixunitaire, $resultat->tva, "");
                    $proformat->quantite = $resultat->quantite;
                    $proformat->prixHT = $resultat->prixht;
                    $proformat->prixAT = $resultat->prixat;

                    $prixHT += $proformat->prixHT;
                    $prixAT += $proformat->prixAT;

                    $liste[] = $proformat;
                }
            }
            $proformat = new ProFormat();
            $proformat->prixHT = $prixHT;
            $proformat->prixAT = $prixAT;
            $liste[] = $proformat;
        }
        return $liste;
    }

    public function getUnProformat() {
        $requette = "select * from proformat where id = '$this->id'";
        $reponse = DB::select($requette);
        $proformat = null;
        if(count($reponse) > 0){
            $proformat = new Proformat($reponse[0]->id, $reponse[0]->iddemande, $reponse[0]->idfournisseur, $reponse[0]->idarticle, $reponse[0]->prixunitaire, $reponse[0]->tva, $reponse[0]->date);
        }
        return $proformat;
    }

}
