<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Region extends Model
{
    public $id;
    public $type;

    public function getListeRegions() {
        $requette = "select * from region";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $region = new Region();
                $region->id = $resultat->id;
                $region->type = $resultat->type;
                $liste[] = $region;
            }
        }
        return $liste;
    }

    public function getUneRegion($id) {
        $requette = "select * from Region where id = " . $id;
        $reponse = DB::select($requette);
        $Region = null;
        if(count($reponse) > 0) {
            $Region = new Region();
            $Region->id = $reponse[0]->id;
            $Region->type = $reponse[0]->type;
        }
        return $Region;
    }
}
