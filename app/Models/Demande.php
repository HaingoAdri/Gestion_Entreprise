<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Demande extends Model {
    public $id;
    public $nom;
    public $date;
    public $idDemande;
    public $idFournisseur;
    public $etat;

    public $listeProformat;
   

    public function __construct($id = "", $nom = "", $date = "", $idDemande = "", $idFournisseur = "", $etat = "") {
        $this->id = $id;
        $this->nom = $nom;
        $this->date = $date;
        $this->idDemande = $idDemande;
        $this->idFournisseur = $idFournisseur;
        $this->etat = $etat;
    }

    public function insert() {
        try {
            $requete = "insert into demande (date, nom, iddemande, idfournisseur, etat) values ('$this->date','$this->nom', '$this->idDemande', $this->idFournisseur, $this->etat)";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer un nouveau demande proformat: ".$e->getMessage());
        }    
    }

    public function updateEtat() {
        try {
            $requete = "update demande set etat = 5 where idDemande = '$this->idDemande')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible de faire une update: ".$e->getMessage());
        }    
    }

    public function getListeFournisseur() {
        $requette = "select * from demande where idDemande = '$this->idDemande'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $demande = new Demande(id: $resultat->id, idFournisseur: $resultat->idfournisseur);
                $demande->listeProformat = (new Proformat(idDemande: $this->idDemande, idFournisseur: $demande->idFournisseur))->getListeProformat();
                $liste[] = $demande;
            }
        }
        return $liste;
    }

    public function getListeDemandeEnAttenteDeProformat() {
        $requette = "select * from liste_demande_en_attente_proformat order by date asc, idDemande asc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $demande = new Demande(date: $resultat->date, nom: $resultat->nom, idDemande: $resultat->iddemande);
                $liste[] = $demande;
            }
        }
        return $liste;
    }

    public function getNextDemande() {
        $requette = "select nextSeqDemande('DMD', 10);";
        $reponse = DB::select($requette);
        $id = "";
        if(count($reponse) > 0){
            $id = $reponse[0]->nextseqdemande;
        }
        return $id;
    }

    public function getNomFournisseur() {
        $fournisseur = (new Fournisseur(id: $this->idFournisseur))->getDonneesUnFournisseur();
        return $fournisseur->nom;
    }
}
