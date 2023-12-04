<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

class Proforma_Test extends Model
{
    public $id;
    public $idboncommande;
    public $idproformat;
    public $etat;
    public $date_bon_commande;
    public $iddemande;
    public $idfournisseur;
    public $idarticle;
    public $prixunitaire;
    public $tva;
    public $date_proformat;
    public $fournisseur;

    public function __construct( $id = "", $idboncommande = "", $idproformat = "", $etat = "", $date_bon_commande = "", $iddemande = "", $idfournisseur = "", $idarticle = "", $prixunitaire = "", $tva = "", $date_proformat = "") {
        $this->id = $id;
        $this->idboncommande = $idboncommande;
        $this->idproformat = $idproformat;
        $this->etat = $etat;
        $this->date_bon_commande = $date_bon_commande;
        $this->iddemande = $iddemande;
        $this->idfournisseur = $idfournisseur;
        $this->idarticle = $idarticle;
        $this->prixunitaire = $prixunitaire;
        $this->tva = $tva;
        $this->date_proformat = $date_proformat;
    }

    public function getListeDetails() {
        $requette = "select * from V_details_bon_commande_avec_proforma";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $proformat = new Proforma_Test($resultat->id, $resultat->idboncommande, $resultat->idproformat, $resultat->etat, $resultat->date_bon_commande, $resultat->iddemande, $resultat->idfournisseur, $resultat->idarticle, $resultat->prixunitaire, $resultat->tva, $resultat->date_proformat);
                $proformat->fournisseur = (new Fournisseur(id: $resultat->idfournisseur))->getDonneesUnFournisseur();
                $liste[] = $proformat;
            }
        }
        return $liste;
    }

}
