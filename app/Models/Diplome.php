<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Diplome extends Model
{
    public $id;
    public $type;

    public function getListeDiplomes() {
        $requette = "select * from diplome";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $diplome = new Diplome();
                $diplome->id = $resultat->id;
                $diplome->type = $resultat->type;
                $liste[] = $diplome;
            }
        }
        return $liste;
    }
}
