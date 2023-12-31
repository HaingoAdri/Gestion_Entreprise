<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Historique_embauche extends Model {
    public $id;
    public $id_emp;
    public $date;
    public $etat;

    public function __construct($id = "", $id_emp = "", $date = "", $etat = "") {
        $this->id = $id;
        $this->id_emp = $id_emp;
        $this->date = $date;
        $this->etat = $etat;
    }

    public function insert() {
        try {
            $requete = "insert into Historique_embauche(id_emp, date, etat) values ('". $this->id_emp ."', '". $this->date ."', ". $this->etat .")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer un proche: ".$e->getMessage());
        }    
    }

    public function getHistorique_Etat_Un_Employer() {
        $requette = "select * from Historique_embauche where id_emp = '".$this->id_emp ."' and date <= '".$this->date."' order by date desc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $historique = new Historique_embauche($resultat->id, $resultat->id_emp, $resultat->date, $resultat->etat);
                $liste[] = $historique;
            }
        }
        return $liste;    
    }

    public function getDate_Embauche_Employer() {
        $requette = "select * from Historique_embauche where id_emp = '".$this->id_emp ."' and etat = 15 order by date desc";;
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $historique = new Historique_embauche($resultat->id, $resultat->id_emp, $resultat->date, $resultat->etat);
                $liste[] = $historique;
            }
        }
        return $liste;    
    }

    public function getDernier_Entretient_Un_Employer() {
        $requette = "select * from Historique_embauche where id_emp = '".$this->id_emp ."' and date <= '".$this->date."' and etat = 12 order by date desc";
        $reponse = DB::select($requette);
        $historique = null;
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $historique = new Historique_embauche($resultat->id, $resultat->id_emp, $resultat->date, $resultat->etat);
                break;
            }
        }
        return $historique;   
    }

    public function getDernier_Contrat_Essaie($signe) {
        $requette = "select * from Historique_embauche where id_emp = '".$this->id_emp ."' and date ". $signe ."= '".$this->date."' and etat = 15 order by date desc";
        $reponse = DB::select($requette);
        $historique = null;
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $historique = new Historique_embauche($resultat->id, $resultat->id_emp, $resultat->date, $resultat->etat);
                break;
            }
        }
        return $historique;  
    }

    public function getPremier_Entretient_Un_Employer() {
        $requette = "select * from Historique_embauche where id_emp = '".$this->id_emp ."' and date <= '".$this->date."' and etat = 12 order by date asc";
        $reponse = DB::select($requette);
        $historique = null;
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $historique = new Historique_embauche($resultat->id, $resultat->id_emp, $resultat->date, $resultat->etat);
                break;
            }
        }
        return $historique;   
    }
}
