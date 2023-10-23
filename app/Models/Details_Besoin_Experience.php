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
                $details_Besoin_Experience->idBesoin = $resultat->idbesoin;
                $details_Besoin_Experience->annee_experience = $resultat->annee_experience;
                $details_Besoin_Experience->note = $resultat->note;
                $liste[] = $details_Besoin_Experience;
            }
        }
        return $liste;
    }

    public function getListeBesoinsExperienceParIdBesoin($idBesoin) {
        $requette = "select * from details_Besoin_Experience where idBesoin = ".$idBesoin . " order by annee_experience desc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $details_Besoin_Experience = new Details_Besoin_Experience();
                $details_Besoin_Experience->id = $resultat->id;
                $details_Besoin_Experience->idBesoin = $resultat->idbesoin;
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
            $details_Besoin_Experience->id = $reponse[0]->id;
            $details_Besoin_Experience->idBesoin = $reponse[0]->idBesoin;
            $details_Besoin_Experience->annee_experience = $reponse[0]->annee_experience;
            $details_Besoin_Experience->note = $reponse[0]->note;
        }
        return $details_Besoin_Experience;
    }

    public function note_cv_experience($idBesoin, $annee_experience) {
        $note = 0;
        $listeDetailsExperience = $this->getListeBesoinsExperienceParIdBesoin($idBesoin);
        $taille = count($listeDetailsExperience);
        for($i = 0; $i < $taille-1; $i++) { 
            if($annee_experience <= $listeDetailsExperience[$i]->annee_experience && $annee_experience > $listeDetailsExperience[$i+1]->annee_experience) {
                $note = $listeDetailsExperience[$i]->note;
            }
        }
        if($annee_experience <= $listeDetailsExperience[$taille-1]->annee_experience && $annee_experience != 0) {
            $note = $listeDetailsExperience[$taille-1]->note;
        }
        return $note;
    }
}
