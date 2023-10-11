<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Details_Cv_Fichier extends Model
{
    public $id;
    public $idCV;
    public $nom_pdf;

    public function __construct($idCV, $nom_pdf) {
        $this->idCV = $idCV;
        $this->nom_pdf = $nom_pdf;
    }

    public function insertDetails_Cv_Diplome() {
        try {
            $requete = "insert into Details_Cv_Diplome(idCV, nom_pdf) values (".$this->idCV.",'".$this->nom_pdf."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Details Cv Diplome: ".$e->getMessage());
        }    
    }

    public function insertDetails_Cv_Travail_Anterieur() {
        try {
            $requete = "insert into Details_Cv_Travail_Anterieur(idCV, nom_pdf) values (".$this->idCV.",'".$this->nom_pdf."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Details Cv Travail Anterieur: ".$e->getMessage());
        }    
    }

    public function getUneDetailFichier($fichier, $idCv) {
        $requette = "select * from ". $fichier." where idCv = " . $idCv;
        $reponse = DB::select($requette);
        $details_Cv_Fichier = null;
        if(count($reponse) > 0) {
            $details_Cv_Fichier = new Details_Cv_Fichier();
            $details_Cv_Fichier->id = $reponse[0]->id;
            $details_Cv_Fichier->idCV = $reponse[0]->idCV;
            $details_Cv_Fichier->nom_pdf = $reponse[0]->nom_pdf;
        }
        return $details_Cv_Fichier;
    }
}
