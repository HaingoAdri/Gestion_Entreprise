<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Ville extends Model
{
    public $id;
    public $region;
    public $type;

    public function getListevilles() {
        $requette = "select * from ville";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $ville = new Ville();
                $ville->id = $resultat->id;
                $region = new Region();
                $ville->region = $region->getUneRegion($resultat->idregion);
                $ville->type = $resultat->type;
                $liste[] = $ville;
            }
        }
        return $liste;
    }
}
