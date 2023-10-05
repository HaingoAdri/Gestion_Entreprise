<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Details_Besoin_Region extends Model
{
    public $id;
    public $idBesoin;
    public $idRegion;
    public $note;

    public function getListeBesoinsRegion() {
        $requette = "select * from details_Besoin_Region";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $details_Besoin_Region = new Details_Besoin_Region();
                $details_Besoin_Region->id = $resultat->id;
                $details_Besoin_Region->idBesoin = $resultat->idBesoin;
                $details_Besoin_Region->idRegion = $resultat->idRegion;
                $details_Besoin_Region->note = $resultat->note;
                $liste[] = $details_Besoin_Region;
            }
        }
        return $liste;
    }

    public function getUneBesoinRegion($id) {
        $requette = "select * from details_Besoin_Region where id = " . $id;
        $reponse = DB::select($requette);
        $details_Besoin_Region = null;
        if(count($reponse) > 0) {
            $details_Besoin_Region = new Details_Besoin_Region();
            $details_Besoin_Region->id = $resultat->id;
            $details_Besoin_Region->idBesoin = $resultat->idBesoin;
            $details_Besoin_Region->idRegion = $resultat->idRegion;
            $details_Besoin_Region->note = $resultat->note;
        }
        return $details_Besoin_Region;
    }
}




