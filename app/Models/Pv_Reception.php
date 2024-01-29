<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB

use Carbon\Carbon;


class Pv_Reception extends Model {
    public $id;
    public $date;
    public $code;
    public $id_etat_immobilisation;
    public $id_type_ammortissement;
    public $taux;
    public $id_receptionneur;
    public $id_livreur;
    public $id_bon_commande;
    
    //compte
    public $id_article;
    public $id_categorie;
    public $quantite;

    public $nom_ammortissement;
    public $nom_immobilisation;
    public $livreur;

    public function __construct($id = "", $date = "", $code = "", $id_etat_immobilisation = 0, $id_type_ammortissement = 0, $taux = 0, $id_receptionneur = "", $id_livreur = "", $id_bon_commande = "", $id_article = "", $id_categorie = "", $quantite = 0) {
        $this->id = $id;
        $this->date = $date;
        $this->code = $code;
        $this->id_etat_immobilisation = $id_etat_immobilisation;
        $this->id_type_ammortissement = $id_type_ammortissement;
        $this->taux = $taux;
        $this->id_receptionneur = $id_receptionneur;
        $this->id_livreur = $id_livreur;
        $this->id_bon_commande = $id_bon_commande;
        $this->id_article = $id_article;
        $this->id_categorie = $id_categorie;
        $this->quantite = $quantite;
    }

    public function insert() {
        try {
            $requete = "insert into pv_reception(id, date, code, id_etat_immobilisation, id_type_ammortissement, taux, id_receptionneur, id_livreur, id_bon_commande, id_article, id_categorie, quantite) values ('". $this->id."', '". $this->date ."', '". $this->code."', ". $this->id_etat_immobilisation .", ".$this->id_type_ammortissement.", ".$this->taux.", '". $this->id_receptionneur. "', ". $this->id_livreur .",'".$this->id_bon_commande."', '$this->id_article', '$this->id_categorie', $this->quantite)";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer un pv de reception: ".$e->getMessage());
        }    
    }

    public function getNextIDPvReception() {
        $requette = "select nextID('seqPvReception', 'PR', 10);";
        $reponse = DB::select($requette);
        $id = "";
        if(count($reponse) > 0){
            $id = $reponse[0]->nextid;
        }
        return $id;
    }

    public function toUpperCase($mot){
        return strtoupper($mot);
    }

    public function getFirstLetter($mot){
        $upper = $this->toUpperCase($mot);
        return substr($upper, 0, 3);
    }

    public function getListeTypeAmmortissement() {
        $requette = "select * from type_ammortissement order by id";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $ammortissement = new Pv_Reception(id_type_ammortissement: $resultat->id);
                $ammortissement->id_article = $resultat->id_article;
                $ammortissement->id_categorie = $resultat->id_categorie;
                $ammortissement->quantite = $resultat->quantite;
                $ammortissement->nom_ammortissement = $resultat->nom;
                $liste[] = $ammortissement;
            }
        }
        return $liste;
    }

    public function getAmmortissement($id_ammortissement) {
        $requette = "select * from type_ammortissement where id = ".$id_ammortissement;
        $reponse = DB::select($requette);
        $liste = null;
        if(count($reponse) > 0){
            $liste = $reponse[0]->nom;
        }
        return $liste;
    }



    public function getNextSequence() {
        $requette = "select nextSeqNumero()";
        $reponse = DB::select($requette);
        $id = "";
        if(count($reponse) > 0){
            $index = "" . $reponse[0]->nextseqnumero;
            for($i = 0; $i<(3-(strlen($index))); $i++)  {
                $id = $id . "0";
            }
            $id = $id . $index;
        }
        return $id;
    }

    public function codification($lieu, $id_immobilisation){
        $date = Carbon::parse($this->date);
        $month = $date->format('F');
        $year = $date->format('Y');

        $numero = $this->getNextSequence();

        $resultat = $lieu.$this->getFirstLetter($month).$year.$id_immobilisation.$numero;

        $this->code = $resultat;
        $this->id = $this->getNextIDPvReception();
        $this->insert();

        return $this->id;
    }

    public function getListePvReceptionBonCommande() {
        $requette = "select * from pv_reception where id_bon_commande = '". $this->id_bon_commande ."'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $pv = new Pv_Reception();
                $pv->id = $resultat->id;
                $pv->date = $resultat->date;
                $pv->code = $resultat->code;
                $pv->id_etat_immobilisation = $resultat->id_etat_immobilisation;
                $pv->id_type_ammortissement = $resultat->id_type_ammortissement;
                $pv->taux = $resultat->taux;
                $pv->id_receptionneur = $resultat->id_receptionneur;
                $pv->id_livreur = $resultat->id_livreur;
                $pv->id_bon_commande = $resultat->id_bon_commande;
                $pv->id_article = $resultat->id_article;
                $pv->id_categorie = $resultat->id_categorie;
                $pv->quantite = $resultat->quantite;

                $etat = (new Etat_immobilisation(id: $pv->id_etat_immobilisation))->getDonnes_Un_Etat();
                $pv->nom_immobilisation = $etat->nom;
                $pv->nom_ammortissement = $this->getAmmortissement($resultat->id_type_ammortissement);
                
                $pv->livreur = (new Livreur(id: $pv->id_livreur))->getUnLivreur();
                $liste[] = $pv;
            }
        }
        return $liste;
    }

    public function getListeReception(){
        $requette = "select * from detail_pv_rec";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $pv = new Pv_Reception();
                $pv->id = $resultat->id;
                $pv->date = $resultat->date;
                $pv->code = $resultat->code;
                $pv->id_etat_immobilisation = $resultat->id_etat_immobilisation;
                $pv->id_type_ammortissement = $resultat->article;
                $pv->taux = $resultat->taux;
                $pv->id_receptionneur = $resultat->id_receptionneur;
                $pv->id_livreur = $resultat->id_livreur;
                $pv->id_bon_commande = $resultat->id_bon_commande;
                $pv->id_article = $resultat->id_article;
                $pv->id_categorie = $resultat->id_categorie;
                $pv->quantite = $resultat->quantite;

                $etat = (new Etat_immobilisation(id: $pv->id_etat_immobilisation))->getDonnes_Un_Etat();
                $pv->nom_immobilisation = $etat->nom;
                $pv->nom_ammortissement = $this->getAmmortissement($resultat->id_type_ammortissement);
                
                $pv->livreur = (new Livreur(id: $pv->id_livreur))->getUnLivreur();
                $liste[] = $pv;
            }
        }
        return $liste;
    }

    public function getReception(){
        $requette = "select * from pv_reception where id = '". $this->id ."'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $pv = new Pv_Reception();
                $pv->id = $resultat->id;
                $pv->date = $resultat->date;
                $pv->code = $resultat->code;
                $pv->id_etat_immobilisation = $resultat->id_etat_immobilisation;
                $pv->id_type_ammortissement = $resultat->id_type_ammortissement;
                $pv->taux = $resultat->taux;
                $pv->id_receptionneur = $resultat->id_receptionneur;
                $pv->id_livreur = $resultat->id_livreur;
                $pv->id_bon_commande = $resultat->id_bon_commande;
                $pv->id_article = $resultat->id_article;
                $pv->id_categorie = $resultat->id_categorie;
                $pv->quantite = $resultat->quantite;

                $etat = (new Etat_immobilisation(id: $pv->id_etat_immobilisation))->getDonnes_Un_Etat();
                $pv->nom_immobilisation = $etat->nom;
                $pv->nom_ammortissement = $this->getAmmortissement($resultat->id_type_ammortissement);
                
                $pv->livreur = (new Livreur(id: $pv->id_livreur))->getUnLivreur();
                $liste[] = $pv;
            }
        }
        return $liste;
    }
}
