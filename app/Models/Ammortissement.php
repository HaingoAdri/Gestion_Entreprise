<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Ammortissement extends Model
{
    public $id_immobilisation;
    public $taux;
    public $date;
    public $valeur_brute;
    public $amt_cumule_dp;
    public $dotation;
    public $amt_cumule_fp;
    public $valeur_net_c;

    public function getTableau($annee) {
        $requette = "select * from v_ammortissement order by date";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $ammortissement = new Ammortissement();
                $ammortissement->id_immobilisation = $resultat->id_immobilisation;
                $ammortissement->taux = $resultat->taux;
                $ammortissement->date = $resultat->date;
                $ammortissement->valeur_brute = $resultat->valeur_brute;
                $ammortissement->amt_cumule_dp = $resultat->amt_cumule_dp;
                $ammortissement->dotation = $resultat->dotation;
                $ammortissement->amt_cumule_fp = $resultat->amt_cumule_fp;
                $ammortissement->valeur_net_c = $resultat->valeur_net_c;
                $liste[] = $ammortissement;
            }
        }
        return $liste;
    }

    public function getTableauByImmobilisation($annee, $immobilisation) {
        $requette = "select * from v_ammortissement  where id_immobilisation = '$immobilisation' order by date";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $ammortissement = new Ammortissement();
                $ammortissement->id_immobilisation = $resultat->id_immobilisation;
                $ammortissement->taux = $resultat->taux;
                $ammortissement->date = $resultat->date;
                $ammortissement->valeur_brute = $resultat->valeur_brute;
                $ammortissement->amt_cumule_dp = $resultat->amt_cumule_dp;
                $ammortissement->dotation = $resultat->dotation;
                $ammortissement->amt_cumule_fp = $resultat->amt_cumule_fp;
                $ammortissement->valeur_net_c = $resultat->valeur_net_c;
                $liste[] = $ammortissement;
            }
        }
        return $liste;
    }

}
