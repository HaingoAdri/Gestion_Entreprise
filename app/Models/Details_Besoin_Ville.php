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
                $details_Besoin_Ville->idBesoin = $resultat->idBesoin;
                $details_Besoin_Ville->idVille = $resultat->idVille;
                $details_Besoin_Ville->note = $resultat->note;
                $liste[] = $details_Besoin_Ville;
            }
        }
        return $liste;
    }

    public function getUneBesoinVille($id) {
        $requette = "select * from details_Besoin_Ville where id = " . $id;
        $reponse = DB::select($requette);
        $details_Besoin_Ville = null;
        if(count($reponse) > 0) {
            $details_Besoin_Ville = new Details_Besoin_Ville();
            $details_Besoin_Ville->id = $reponse->id;
            $details_Besoin_Ville->idBesoin = $reponse->idBesoin;
            $details_Besoin_Ville->idVille = $reponse->idVille;
            $details_Besoin_Ville->note = $reponse->note;
        }
        return $details_Besoin_Ville;
    }
}




