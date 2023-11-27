<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Tranche_IRSA extends Model
{
    public $id;
    public $debut;
    public $fin;
    public $majoration;
    public $date;

    public function __construct($id = "", $debut = "", $fin = "", $majoration = "", $date = "") {
        $this->id = $id;
        $this->debut = $debut;
        $this->fin = $fin;
        $this->majoration = $majoration;
        $this->date = $date;
    }

    public function getListeTranche_IRSA() {
        $requette = " select * from Tranche_IRSA where date <= '". $this->date ."' order by date, debut asc limit 5";
        $reponse = DB::select($requette);
        $liste_Tranche_IRSA = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Tranche_IRSA = new Tranche_IRSA($resultat->id, $resultat->debut, $resultat->fin, $resultat->majoration, $resultat->date);
                $liste_Tranche_IRSA[] = $Tranche_IRSA;
            }
        }
        return $liste_Tranche_IRSA;
    }

    public function getTranche_IRSA_Un_Employe($salaire_brut, $salaire) {
        $liste_Tranche_IRSA = $this->getListeTranche_IRSA();
        $tranche = array();
        $somme = 0;
        $i = 0;
        for($i; $i < count($liste_Tranche_IRSA); $i++) {
            if($i == 0) {
                $tranche[$i] = 0;
            } else {
                if($salaire_brut > $liste_Tranche_IRSA[$i]->fin) {
                    $tranche[$i] = ($liste_Tranche_IRSA[$i]->fin - $liste_Tranche_IRSA[$i]->debut) * ($liste_Tranche_IRSA[$i]->majoration/100);
                }
                else if($salaire_brut <= $liste_Tranche_IRSA[$i]->fin) {
                    $tranche[$i] = ($salaire - $liste_Tranche_IRSA[$i]->debut) * ($liste_Tranche_IRSA[$i]->majoration/100);
                }
                $somme += $tranche[$i];
            }
        }
        $tranche[$i]["somme"] = $somme;
        return $tranche;
    }

   
}
