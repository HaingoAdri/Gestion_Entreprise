<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Details_Cv_Salaire extends Model
{
    public $id;
    public $idCV;
    public $min;
    public $max;

    public function __construct($idCV, $min, $max) {
        $this->idCV = $idCV;
        $this->min = $min;
        $this->max = $max;
    }

    public function insert() {
        try {
            $requete = "insert into Details_Cv_Salaire(idCV, min, max) values (".$this->idCV.",".$this->min.",".$this->max.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Detail Cv Salaire: ".$e->getMessage());
        }    
    }

    public function getListeCvSalaire() {
        $requette = "select * from details_Cv_Salaire";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $details_Cv_Salaire = new Details_Cv_Salaire();
                $details_Cv_Salaire->id = $resultat->id;
                $details_Cv_Salaire->idCV = $resultat->idCV;
                $details_Cv_Salaire->min = $resultat->min;
                $details_Cv_Salaire->max = $resultat->max;
                $liste[] = $details_Cv_Salaire;
            }
        }
        return $liste;
    }

    public function getListeCvSalaireParidCV($idCV) {
        $requette = "select * from details_Cv_Salaire where idCV = ". $idCV;
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $details_Cv_Salaire = new Details_Cv_Salaire();
                $details_Cv_Salaire->id = $resultat->id;
                $details_Cv_Salaire->idCV = $resultat->idCV;
                $details_Cv_Salaire->min = $resultat->min;
                $details_Cv_Salaire->max = $resultat->max;
                $liste[] = $details_Cv_Salaire;
            }
        }
        return $liste;
    }

    public function getUneCvSalaire($idCv) {
        $requette = "select * from details_Cv_Salaire where idCv = " . $idCv;
        $reponse = DB::select($requette);
        $details_Cv_Salaire = null;
        if(count($reponse) > 0) {
            $details_Cv_Salaire = new Details_Cv_Salaire();
            $details_Cv_Salaire->id = $reponse[0]->id;
            $details_Cv_Salaire->idCV = $reponse[0]->idCV;
            $details_Cv_Salaire->min = $reponse[0]->min;
            $details_Cv_Salaire->max = $reponse[0]->max;       
        }
        return $details_Cv_Salaire;
    }
}
