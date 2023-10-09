<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Details_Besoin_Salaire extends Model
{
    public $id;
    public $idBesoin;
    public $min;
    public $max;
    public $note;

    public function insertDetailsBesoinSalaire($idBesoin, $min,$max, $note) {
        try {
            $requete = "insert into Details_Besoin_Salaire(idBesoin, min, max, note) values (".$idBesoin.",".$min.",".$max.",".$note.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Besoin Salaire: ".$e->getMessage());
        }    
    }

    public function getListeBesoinsSalaire() {
        $requette = "select * from details_Besoin_Salaire";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $details_Besoin_Salaire = new Details_Besoin_Salaire();
                $details_Besoin_Salaire->id = $resultat->id;
                $details_Besoin_Salaire->idBesoin = $resultat->idBesoin;
                $details_Besoin_Salaire->min = $resultat->min;
                $details_Besoin_Salaire->max = $resultat->max;
                $details_Besoin_Salaire->note = $resultat->note;
                $liste[] = $details_Besoin_Salaire;
            }
        }
        return $liste;
    }

    public function getListeBesoinsSalaireParIdBesoin($idBesoin) {
        $requette = "select * from details_Besoin_Salaire where idBesoin = "+$idBesoin;
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $details_Besoin_Salaire = new Details_Besoin_Salaire();
                $details_Besoin_Salaire->id = $resultat->id;
                $details_Besoin_Salaire->idBesoin = $resultat->idBesoin;
                $details_Besoin_Salaire->min = $resultat->min;
                $details_Besoin_Salaire->max = $resultat->max;
                $details_Besoin_Salaire->note = $resultat->note;
                $liste[] = $details_Besoin_Salaire;
            }
        }
        return $liste;
    }

    public function getUneBesoinSalaire($id) {
        $requette = "select * from details_Besoin_Salaire where id = " . $id;
        $reponse = DB::select($requette);
        $details_Besoin_Salaire = null;
        if(count($reponse) > 0) {
            $details_Besoin_Salaire = new Details_Besoin_Salaire();
            $details_Besoin_Salaire->id = $resultat->id;
            $details_Besoin_Salaire->idBesoin = $resultat->idBesoin;
            $details_Besoin_Salaire->min = $resultat->min;
            $details_Besoin_Salaire->max = $resultat->max;
            $details_Besoin_Salaire->note = $resultat->note;
        }
        return $details_Besoin_Salaire;
    }
}
