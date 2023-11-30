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

    public function __construct($id = "", $idDemande = "", $idFournisseur = "", $idArticle = "", $prixUnitaire = "", $TVA = "", $date = "") {
        echo $idArticle;
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

}
