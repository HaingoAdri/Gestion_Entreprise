<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Details_Besoin_Region extends Model
{
    public $id;
    public $idBesoin;
    public $idRegion;
    public $note;

    public $region;

    public function insertDetailsBesoinRegion($idBesoin, $idRegion, $note) {
        try {
            $requete = "insert into Details_Besoin_Region(idBesoin, idRegion, note) values (".$idBesoin.",".$idRegion.",".$note.")";
            echo $requete;
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Besoin Region: ".$e->getMessage());
        }    
    }

    public function getListeBesoinsRegion() {
        $requette = "select * from details_Besoin_Region";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $details_Besoin_Region = new Details_Besoin_Region();
                $details_Besoin_Region->id = $resultat->id;
                $details_Besoin_Region->idBesoin = $resultat->idbesoin;
                $details_Besoin_Region->idRegion = $resultat->idregion;
                $details_Besoin_Region->note = $resultat->note;
                $liste[] = $details_Besoin_Region;
            }
        }
        return $liste;
    }

    public function getListeBesoinsRegionParIdBesoin($IdBesoin) {
        $requette = "select * from details_Besoin_Region where idBesoin = ".$IdBesoin;
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $details_Besoin_Region = new Details_Besoin_Region();
                $details_Besoin_Region->id = $resultat->id;
                $details_Besoin_Region->idBesoin = $resultat->idbesoin;
                $details_Besoin_Region->idRegion = $resultat->idregion;
                $details_Besoin_Region->note = $resultat->note;
                $details_Besoin_Region->region = (new Region())->getUneRegion($details_Besoin_Region->idRegion);
                $liste[] = $details_Besoin_Region;
            }
        }
        return $liste;
    }

    public function getUneBesoinRegion($idBesoin, $idRegion) {
        $requette = "select * from details_Besoin_Region where idBesoin = " . $idBesoin . " and idRegion = " . $idRegion;
        $reponse = DB::select($requette);
        $details_Besoin_Region = null;
        if(count($reponse) > 0) {
            $details_Besoin_Region = new Details_Besoin_Region();
            $details_Besoin_Region->id = $reponse[0]->id;
            $details_Besoin_Region->idBesoin = $reponse[0]->idbesoin;
            $details_Besoin_Region->idRegion = $reponse[0]->idregion;
            $details_Besoin_Region->note = $reponse[0]->note;
        }
        return $details_Besoin_Region;
    }

    public function note_region_cv($idBesoin, $idRegion) {
        $details_Besoin_Region = $this->getUneBesoinRegion($idBesoin, $idRegion);
        if($details_Besoin_Region == null)
            return 0;
        return $details_Besoin_Region->note;
    }
}




