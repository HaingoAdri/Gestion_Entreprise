<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Details_Besoin_Ville extends Model
{
    public $id;
    public $idBesoin;
    public $idVille;
    public $note;

    public function insertDetailsBesoinVille($idBesoin, $idVille, $note) {
        try {
            $requete = "insert into Details_Besoin_Ville(idBesoin, idVille, note) values (".$idBesoin.",".$idVille.",".$note.")";
            echo $requete;
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Besoin Ville: ".$e->getMessage());
        }    
    }

    public function getListeBesoinsVille() {
        $requette = "select * from details_Besoin_Ville";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $details_Besoin_Ville = new Details_Besoin_Ville();
                $details_Besoin_Ville->id = $resultat->id;
                $details_Besoin_Ville->idBesoin = $resultat->idbesoin;
                $details_Besoin_Ville->idVille = $resultat->idville;
                $details_Besoin_Ville->note = $resultat->note;
                $liste[] = $details_Besoin_Ville;
            }
        }
        return $liste;
    }

    public function getUneBesoinVille($idBesoin, $idVille) {
        $requette = "select * from details_Besoin_Ville where idBesoin = " . $idBesoin . " and idVille = " . $idVille;
        $reponse = DB::select($requette);
        $details_Besoin_Ville = null;
        if(count($reponse) > 0) {
            $details_Besoin_Ville = new Details_Besoin_Ville();
            $details_Besoin_Ville->id = $reponse[0]->id;
            $details_Besoin_Ville->idBesoin = $reponse[0]->idbesoin;
            $details_Besoin_Ville->idVille = $reponse[0]->idville;
            $details_Besoin_Ville->note = $reponse[0]->note;
        }
        return $details_Besoin_Ville;
    }

    public function note_ville_cv($idBesoin, $idVille) {
        $details_Besoin_Ville = $this->getUneBesoinVille($idBesoin, $idVille);
        if($details_Besoin_Ville == null)
            return 0;
        return $details_Besoin_Ville->note;
    }
}




