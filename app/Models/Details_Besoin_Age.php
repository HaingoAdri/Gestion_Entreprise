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
