<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Details_Besoin_Nationalite extends Model
{
    public $id;
    public $idBesoin;
    public $idNationalite;
    public $note;

    public function getListeBesoinsNationalite() {
        $requette = "select * from details_Besoin_Nationalite";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $details_Besoin_Nationalite = new Details_Besoin_Nationalite();
                $details_Besoin_Nationalite->id = $resultat->id;
                $details_Besoin_Nationalite->idBesoin = $resultat->idBesoin;
                $details_Besoin_Nationalite->idNationalite = $resultat->idNationalite;
                $details_Besoin_Nationalite->note = $resultat->note;
                $liste[] = $details_Besoin_Nationalite;
            }
        }
        return $liste;
    }

    public function getUneBesoinNationalite($id) {
        $requette = "select * from details_Besoin_Nationalite where id = " . $id;
        $reponse = DB::select($requette);
        $details_Besoin_Nationalite = null;
        if(count($reponse) > 0) {
            $details_Besoin_Nationalite = new Details_Besoin_Nationalite();
            $details_Besoin_Nationalite->id = $resultat->id;
            $details_Besoin_Nationalite->idBesoin = $resultat->idBesoin;
            $details_Besoin_Nationalite->idNationalite = $resultat->idNationalite;
            $details_Besoin_Nationalite->note = $resultat->note;
        }
        return $details_Besoin_Nationalite;
    }
}




