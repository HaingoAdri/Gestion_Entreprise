<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Nationalite extends Model
{
    public $id;
    public $type;

    public function getListeNationalites() {
        $requette = "select * from nationalite";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $nationalite = new Nationalite();
                $nationalite->id = $resultat->id;
                $nationalite->type = $resultat->type;
                $liste[] = $nationalite;
            }
        }
        return $liste;
    }

    public function getNationalite($id){
        $nationalite = DB::table('nationalite') -> where('id', $id)->get();
    
        return $nationalite;
    }
}
