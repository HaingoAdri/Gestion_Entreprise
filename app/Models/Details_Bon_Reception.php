<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Details_Bon_Reception extends Model
{
    public $id_bon_reception;
    public $id_article;
    public $id_fournisseur;
    public $date;
    public $etat;

    public function __construct($id_bon_reception = "", $id_article = "", $id_fournisseur = "", $date = "",  $etat = "") {
        $this->id_bon_reception = $id_bon_reception;
        $this->id_article = $id_article;
        $this->id_fournisseur = $id_fournisseur;
        $this->date = $date;
        $this->etat = $etat;
    }

    public function insertDetailsBonReception() {
        try {
            $requete = "insert into Details_Bon_Reception (id_bon_reception , id_article , id_fournisseur , date ,  etat ) values ('$this->id_bon_reception', '$this->id_article', $this->id_fournisseur, '$this->date', '$this->etat')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer un nouveau details bon de reception: ".$e->getMessage());
        }    
    }

    // public function getListeEnCours() {
    //     $requette = "select * from liste_bon_commande_en_cours order by date desc";
    //     $reponse = DB::select($requette);
    //     $liste = array();
    //     if(count($reponse) > 0){
    //         foreach($reponse as $resultat) {
    //             $bonCommande = new BonCommande(id: $resultat->id, date: $resultat->date, idPayement: $resultat->idpayement, delaiLivarison: $resultat->delailivarison, etat: $resultat->etat);
    //             $idDemande = $bonCommande->getIdDemande();
    //             $demande = (new Demande(idDemande: $idDemande))->getDonneesUnDemande();
    //             $bonCommande->nom = $demande->nom;
    //             $liste[] = $bonCommande;
    //         }
    //     }
    //     return $liste;
    // }

}
