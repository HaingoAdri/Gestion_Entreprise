<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Details_Besoin_Genre extends Model
{
    public $id;
    public $idBesoin;
    public $idGenre;
    public $note;

    public function getListeBesoinsGenre() {
        $requette = "select * from Details_Besoin_Genre";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Details_Besoin_Genre = new Details_Besoin_Genre();
                $Details_Besoin_Genre->id = $resultat->id;
                $Details_Besoin_Genre->idBesoin = $resultat->idBesoin;
                $Details_Besoin_Genre->idGenre = $resultat->idGenre;
                $Details_Besoin_Genre->note = $resultat->note;
                $liste[] = $Details_Besoin_Genre;
            }
        }
        return $liste;
    }

    public function getUneBesoinGenre($id) {
        $requette = "select * from besoin where id = " . $id;
        $reponse = DB::select($requette);
        $Details_Besoin_Genre = null;
        if(count($reponse) > 0) {
            $Details_Besoin_Genre = new Details_Besoin_Genre();
            $Details_Besoin_Genre->id = $resultat->id;
            $Details_Besoin_Genre->idBesoin = $resultat->idBesoin;
            $Details_Besoin_Genre->idGenre = $resultat->idGenre;
            $Details_Besoin_Genre->note = $resultat->note;
        }
        return $Details_Besoin_Genre;
    }
}
