<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use App\Models\Nationalite;


class Details_Besoin_Nationalite extends Model
{
    public $id;
    public $idBesoin;
    public $idNationalite;
    public $nationalite;
    public $note;

    public function insertDetailsBesoinNationalite($idBesoin, $idNationalite, $note) {
        try {
            $requete = "insert into Details_Besoin_Nationalite(idBesoin, idNationalite, note) values (".$idBesoin.",".$idNationalite.",".$note.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Besoin Nationalite: ".$e->getMessage());
        }    
    }

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

    public function getListeBesoinsNationaliteParIdBesoin($idBesoin) {
        $requette = "select * from details_Besoin_Nationalite where idBesoin = ".$idBesoin;
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $details_Besoin_Nationalite = new Details_Besoin_Nationalite();
                $details_Besoin_Nationalite->id = $resultat->id;
                $details_Besoin_Nationalite->idBesoin = $resultat->idbesoin;
                $details_Besoin_Nationalite->nationalite = (new Nationalite())->getNationalite($resultat->idnationalite);
                $details_Besoin_Nationalite->note = $resultat->note;
                $liste[] = $details_Besoin_Nationalite;
            }
        }
        return $liste;
    }

    public function getUneBesoinNationalite($idBesoin, $idNationalite) {
        $requette = "select * from details_Besoin_Nationalite where idBesoin = " . $idBesoin . " and idNationalite = " . $idNationalite;
        $reponse = DB::select($requette);
        $details_Besoin_Nationalite = null;
        if(count($reponse) > 0) {
            $details_Besoin_Nationalite = new Details_Besoin_Nationalite();
            $details_Besoin_Nationalite->id = $reponse[0]->id;
            $details_Besoin_Nationalite->idBesoin = $reponse[0]->idbesoin;
            $details_Besoin_Nationalite->idNationalite = $reponse[0]->idnationalite;
            $details_Besoin_Nationalite->note = $reponse[0]->note;
        }
        return $details_Besoin_Nationalite;
    }

    public function note_nationalite_cv($idBesoin, $idNationalite) {
        $details_Besoin_Nationalite = $this->getUneBesoinNationalite($idBesoin, $idNationalite);
        if($details_Besoin_Nationalite == null) 
            return 0;
        return $details_Besoin_Nationalite->note;
    }
}




