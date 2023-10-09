<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Details_Besoin_Age extends Model
{
    public $id;
    public $idBesoin;
    public $min;
    public $max;
    public $note;

    public function insertDetailsBesoin($idBesoin, $min, $max, $note) {
        try {
            $requete = "insert into Details_Besoin_Age(idBesoin, min, max, note) values (".$idBesoin.",".$min.",".$max.",".$note.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Besoin: ".$e->getMessage());
        }    
    }

    public function getListeBesoinsAge() {
        $requette = "select * from details_Besoin_Age";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $details_Besoin_Age = new Details_Besoin_Age();
                $details_Besoin_Age->id = $resultat->id;
                $details_Besoin_Age->idBesoin = $resultat->idBesoin;
                $details_Besoin_Age->min = $resultat->min;
                $details_Besoin_Age->max = $resultat->max;
                $details_Besoin_Age->note = $resultat->note;
                $liste[] = $details_Besoin_Age;
            }
        }
        return $liste;
    }

    public function getListeBesoinsAgeParIdBesoin($idBesoin) {
        $requette = "select * from details_Besoin_Age where idBesoin = ".$idBesoin;
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $details_Besoin_Age = new Details_Besoin_Age();
                $details_Besoin_Age->id = $resultat->id;
                $details_Besoin_Age->idBesoin = $resultat->idbesoin;
                $details_Besoin_Age->min = $resultat->min;
                $details_Besoin_Age->max = $resultat->max;
                $details_Besoin_Age->note = $resultat->note;
                $liste[] = $details_Besoin_Age;
            }
        }
        return $liste;
    }

    public function getUneBesoinAge($id) {
        $requette = "select * from details_Besoin_Age where id = " . $id;
        $reponse = DB::select($requette);
        $details_Besoin_Age = null;
        if(count($reponse) > 0) {
            $details_Besoin_Age = new Details_Besoin_Age();
            $details_Besoin_Age->id = $resultat->id;
            $details_Besoin_Age->idBesoin = $resultat->idBesoin;
            $details_Besoin_Age->min = $resultat->min;
            $details_Besoin_Age->max = $resultat->max;
            $details_Besoin_Age->note = $resultat->note;
        }
        return $details_Besoin_Age;
    }
}
