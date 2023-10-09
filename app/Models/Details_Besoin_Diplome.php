<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Details_Besoin_Diplome extends Model
{
    public $id;
    public $idBesoin;
    public $idDiplome;
    public $note;

    public function insertDetailsBesoinDiplome($idBesoin, $idDiplome, $note) {
        try {
            $requete = "insert into Details_Besoin_Diplome(idBesoin, idDiplome, note) values (".$idBesoin.",".$idDiplome.",".$note.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Besoin Diplome: ".$e->getMessage());
        }    
    }

    public function getListeBesoinsDiplome() {
        $requette = "select * from details_Besoin_Diplome";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $details_Besoin_Diplome = new Details_Besoin_Diplome();
                $details_Besoin_Diplome->id = $resultat->id;
                $details_Besoin_Diplome->idBesoin = $resultat->idBesoin;
                $details_Besoin_Diplome->idDiplome = $resultat->idDiplome;
                $details_Besoin_Diplome->note = $resultat->note;
                $liste[] = $details_Besoin_Diplome;
            }
        }
        return $liste;
    }

    public function getUneBesoinDiplome($id) {
        $requette = "select * from details_Besoin_Diplome where id = " . $id;
        $reponse = DB::select($requette);
        $details_Besoin_Diplome = null;
        if(count($reponse) > 0) {
            $details_Besoin_Diplome = new Details_Besoin_Diplome();
            $details_Besoin_Diplome->id = $resultat->id;
            $details_Besoin_Diplome->idBesoin = $resultat->idBesoin;
            $details_Besoin_Diplome->idDiplome = $resultat->idDiplome;
            $details_Besoin_Diplome->note = $resultat->note;
        }
        return $details_Besoin_Diplome;
    }
}
