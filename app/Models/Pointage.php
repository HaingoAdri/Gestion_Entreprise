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
    public $nb_jour_ou_nuit;

    public function __construct($id_employer = "", $date = "", $etat = "", $jour_nuit = "", $securite = "") {
        $this->id_employer = $id_employer;
        $this->date = $date;
        $this->etat = $etat;
        $this->jour_nuit = $jour_nuit;
        $this->securite = $securite;
    }

    public function insert() {
        try {
            $isoDatetime = $this->date;
            $formattedDatetime = str_replace("T", " ", $isoDatetime);

            $requete = "insert into pointage (id_employer, date, etat,jour_nuit,securite) values ('".$this->id_employer."','".$formattedDatetime."',".$this->etat.",".$this->jour_nuit.",".$this->securite.")";
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
        $requette = "select * from pointage order by date desc";
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

    public function getListe_Pointages_Un_Employe($date_debut, $date_fin) {
        $requette = "select * from pointage where id_employer = '". $this->id_employer ."' and date >= '". $date_debut ."' and date <= '". $date_fin ."' and jour_nuit = '". $this->jour_nuit ."' order by date desc";
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

    public function check_if_already_exist($idEmploye, $date, $etat, $jour_nuit) {
        $requette = "select * from pointage where CAST(date AS VARCHAR) like '$date%' and id_employer = '$idEmploye' and etat = $etat and jour_nuit = $jour_nuit";
        echo $requette;
        $reponse = DB::select($requette);
        $pointage = null;
        if(count($reponse) > 0){
            $pointage = new Pointage();
            $pointage->id = $reponse[0]->id;
            $pointage->employer = (new Employer(id_emp: $reponse[0]->id_employer))->getDonneesEmployer();
            $pointage->date = $reponse[0]->date;
            $pointage->etat = $this->getEtat($reponse[0]->etat);
            $pointage->jour_nuit = $this->getEtat($reponse[0]->jour_nuit);
            $pointage->securite = $reponse[0]->securite;
        }
        return $pointage;
    }



}

