<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Details_Besoin_Matrimoniale extends Model
{
    public $id;
    public $idBesoin;
    public $idMatrimoniale;
    public $note;

    public function getListeBesoinsMatrimoniale() {
        $requette = "select * from details_Besoin_Matrimoniale";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $details_Besoin_Matrimoniale = new Details_Besoin_Matrimoniale();
                $details_Besoin_Matrimoniale->id = $resultat->id;
                $details_Besoin_Matrimoniale->idBesoin = $resultat->idBesoin;
                $details_Besoin_Matrimoniale->idMatrimoniale = $resultat->idMatrimoniale;
                $details_Besoin_Matrimoniale->note = $resultat->note;
                $liste[] = $details_Besoin_Matrimoniale;
            }
        }
        return $liste;
    }

    public function getUneBesoinMatrimoniale($id) {
        $requette = "select * from details_Besoin_Matrimoniale where id = " . $id;
        $reponse = DB::select($requette);
        $details_Besoin_Matrimoniale = null;
        if(count($reponse) > 0) {
            $details_Besoin_Matrimoniale = new Details_Besoin_Matrimoniale();
            $details_Besoin_Matrimoniale->id = $resultat->id;
            $details_Besoin_Matrimoniale->idBesoin = $resultat->idBesoin;
            $details_Besoin_Matrimoniale->idMatrimoniale = $resultat->idMatrimoniale;
            $details_Besoin_Matrimoniale->note = $resultat->note;
        }
        return $details_Besoin_Matrimoniale;
    }
}
