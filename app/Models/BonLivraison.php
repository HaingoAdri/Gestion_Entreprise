<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class BonLivraison extends Model
{
    public $id;
    public $lieu;
    public $date;
    public $id_bon_commande;
    public $id_recepteur;
    public $livreur;
    public $etat;

    public $id_article;
    public $id_fournisseur;

    public function __construct($id = "", $lieu = "", $date = "", $id_bon_commande = "",  $id_recepteur = "", $livreur = "", $etat = "", $id_article = "", $id_fournisseur = "") {
        $this->id = $id;
        $this->lieu = $lieu;
        $this->date = $date;
        $this->id_bon_commande = $id_bon_commande;
        $this->id_recepteur = $id_recepteur;
        $this->livreur = $livreur;
        $this->etat = $etat;
    }

    public function insertBonLivraison() {
        try {
            $requete = "insert into bon_livraison (id, lieu, date, id_bon_commande, id_recepteur, livreur, etat) values ('$this->id', '$this->lieu', '$this->date', '$this->id_bon_commande','$this->id_recepteur','$this->livreur', '$this->etat')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer un nouveau bon de livraison: ".$e->getMessage());
        }    
    }

    public function getNextIDLivraison() {
        $requette = "select nextID('seqBonLivraison', 'BL', 10);";
        $reponse = DB::select($requette);
        $id = "";
        if(count($reponse) > 0){
            $id = $reponse[0]->nextid;
        }
        return $id;
    }

    public function ifExistLivraison() {
        $requette = "select * from bon_livraison where id_bon_commande = '$this->id_bon_commande'";
        $reponse = DB::select($requette);
        $bonLivraison = null;
        if(count($reponse) > 0){
            $bonLivraison = new BonLivraison(id: $reponse[0]->id, lieu: $reponse[0]->lieu, date: $reponse[0]->date, id_bon_commande: $reponse[0]->id_bon_commande, id_recepteur: $reponse[0]->id_recepteur, livreur: $reponse[0]->livreur, etat: $reponse[0]->etat);
        }
        return $bonLivraison;
    }

    public function getDetailsBonLivraisonValiderPourUnBonCommande() {
        $requette = "select * from V_Details_Bon_Livraison where id_bon_commande = '$this->id_bon_commande'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $bonLivraison = new BonLivraison(id: $resultat->id, lieu: $resultat->lieu, date: $resultat->date, id_bon_commande: $resultat->id_bon_commande, id_recepteur: $resultat->id_recepteur, livreur: $resultat->livreur, etat: $resultat->etat, id_article: $resultat->id_article, id_fournisseur: $resultat->id_fournisseur);
                $liste[] = $bonLivraison;
            }
        }
        return $liste;
    }

}
