<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Details_Besoin_Experience extends Model
{
    public $id;
    public $idBesoin;
    public $annee_experience;
    public $note;

    public function insertDetailsBesoinExperience($idBesoin, $annee_experience, $note) {
        try {
            $requete = "insert into Details_Besoin_Experience(idBesoin, annee_experience, note) values (".$idBesoin.",".$annee_experience.",".$note.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Besoin Experience: ".$e->getMessage());
        }    
    }

    public function getListeBesoinsExperience() {
        $requette = "select * from details_Besoin_Experience";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $details_Besoin_Experience = new Details_Besoin_Experience();
                $details_Besoin_Experience->id = $resultat->id;
                $details_Besoin_Experience->idBesoin = $resultat->idBesoin;
                $details_Besoin_Experience->annee_experience = $resultat->annee_experience;
                $details_Besoin_Experience->note = $resultat->note;
                $liste[] = $details_Besoin_Experience;
            }
        }
        return $liste;
    }

    public function getUneBesoinExperience($id) {
        $requette = "select * from details_Besoin_Experience where id = " . $id;
        $reponse = DB::select($requette);
        $details_Besoin_Experience = null;
        if(count($reponse) > 0) {
            $details_Besoin_Experience = new Details_Besoin_Experience();
            $details_Besoin_Experience->id = $resultat->id;
            $details_Besoin_Experience->idBesoin = $resultat->idBesoin;
            $details_Besoin_Experience->annee_experience = $resultat->annee_experience;
            $details_Besoin_Experience->note = $resultat->note;
        }
        return $details_Besoin_Experience;
    }
}
