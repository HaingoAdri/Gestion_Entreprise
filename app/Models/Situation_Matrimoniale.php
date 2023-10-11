<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Situation_Matrimoniale extends Model
{
    public $id;
    public $type;

    public function getListeSituation_Matrimoniales() {
        $requette = "select * from situation_Matrimoniale";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $situation_Matrimoniale = new Situation_Matrimoniale();
                $situation_Matrimoniale->id = $resultat->id;
                $situation_Matrimoniale->type = $resultat->type;
                $liste[] = $situation_Matrimoniale;
            }
        }
        return $liste;
    }

    public function getUneMatrimoniale($id) {
        $requette = "select * from Situation_Matrimoniale where id = " . $id;
        $reponse = DB::select($requette);
        $matrimoniale = null;
        if(count($reponse) > 0) {
            $matrimoniale = new Situation_Matrimoniale();
            $matrimoniale->id = $reponse[0]->id;
            $matrimoniale->type = $reponse[0]->type;
        }
        return $matrimoniale;
    }
}
