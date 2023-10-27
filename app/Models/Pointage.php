<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Pointage extends Model
{
    public $id;
    public $id_employer;
    public $date;
    public $etat;
    public $jour_nuit;
    public $securite;

    public $employer;

    public function __construct($id_employer = "", $date = "", $etat = "", $jour_nuit = "", $securite = "") {
        $this->id_employer = $id_employer;
        $this->date = $date;
        $this->etat = $etat;
        $this->jour_nuit = $jour_nuit;
        $this->securite = $securite;
    }

    public function insert() {
        try {
            $requete = "insert into pointage (id_employer, date, etat,jour_nuit,securite) values ('".$this->id_employer."','".$this->date."',".$this->etat.",".$this->jour_nuit.",".$this->securite.")";
            echo $requete;
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Pointage: ".$e->getMessage());
        }    
    }

    public function getEtat($etat){
        if($etat == 50){
            return "Arrive";
        }else if($etat == 100){
            return "Sortie";
        }else if($etat == 25){
            return "Jour";
        }else if($etat == 55){
            return "nuit";
        }
        return "";
    }

    public function getListePointages() {
        $requette = "select * from pointage";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $pointage = new Pointage();
                $pointage->id = $resultat->id;
                $pointage->employer = (new Employer(id_emp: $resultat->id_employer))->getDonneesEmployer();
                $pointage->date = $resultat->date;
                $pointage->etat = $this->getEtat($resultat->etat);
                $pointage->jour_nuit = $this->getEtat($resultat->jour_nuit);
                $pointage->securite = $resultat->securite;
                $liste[] = $pointage;
            }
        }
        return $liste;
    }

}
