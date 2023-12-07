<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class BonReception extends Model
{
    public $id;
    public $lieu;
    public $date;
    public $id_bon_commande;
    public $id_recepteur;
    public $etat;

    public $nom;

    public function __construct($id = "", $lieu = "", $date = "", $id_bon_commande = "",  $id_recepteur = "", $etat = "") {
        $this->id = $id;
        $this->lieu = $lieu;
        $this->date = $date;
        $this->id_bon_commande = $id_bon_commande;
        $this->id_recepteur = $id_recepteur;
        $this->etat = $etat;
    }

    public function insertBonReception() {
        try {
            $requete = "insert into bon_reception (id, lieu, date, id_bon_commande, id_recepteur, etat) values ('$this->id', '$this->lieu', $this->date, '$this->id_bon_commande','$this->id_recepteur', '$this->etat')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer un nouveau bon de reception: ".$e->getMessage());
        }    
    }

    public function updateEtat() {
        try {
            $requete = "update bon_reception set etat = $this->etat where id = '$this->id'";
            DB::update($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible de changer l'etat du bon de reception: ".$e->getMessage());
        }    
    }

    public function getNextIDReception() {
        $requette = "select nextID('seqBonReception', 'BR', 10);";
        $reponse = DB::select($requette);
        $id = "";
        if(count($reponse) > 0){
            $id = $reponse[0]->nextid;
        }
        return $id;
    }

    public function getDonneesUnReception() {
        $requette = "select * from bon_reception where id = '$this->id'";
        $reponse = DB::select($requette);
        $bonReception = null;
        if(count($reponse) > 0){
            $bonReception = new BonReception(id: $reponse[0]->id, lieu: $reponse[0]->lieu, date: $reponse[0]->date, id_bon_commande: $reponse[0]->id_bon_commande, id_recepteur: $reponse[0]->id_recepteur);
        }
        return $bonReception;
    }

    public function ifExist() {
        $requette = "select * from bon_reception where id_bon_commande = '$this->id_bon_commande'";
        $reponse = DB::select($requette);
        $bonReception = null;
        if(count($reponse) > 0){
            $bonReception = new BonReception(id: $reponse[0]->id, lieu: $reponse[0]->lieu, date: $reponse[0]->date, id_bon_commande: $reponse[0]->id_bon_commande, id_recepteur: $reponse[0]->id_recepteur);
        }
        return $bonReception;
    }

    public function getEtat() {
        $etats = (new Etats(id_e: $this->etat))->getDonnes_Un_Etat();
        return $etats->nom_etats;
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
