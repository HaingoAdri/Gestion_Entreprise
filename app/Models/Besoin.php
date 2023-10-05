<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Besoin extends Model
{
    public $id;
    public $idPoste;
    public $idService;
    public $besoin_horaire;
    public $heure_jour_homme;

    public function getListeBesoins() {
        $requette = "select * from besoin";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $besoin = new Besoin();
                $besoin->id = $resultat->id;
                $besoin->idPoste = $resultat->idPoste;
                $besoin->besoin_horaire = $resultat->besoin_horaire;
                $besoin->heure_jour_homme = $resultat->heure_jour_homme;
                $liste[] = $besoin;
            }
        }
        return $liste;
    }

    public function getUneBesoin($id) {
        $requette = "select * from besoin where id = " . $id;
        $reponse = DB::select($requette);
        $besoin = null;
        if(count($reponse) > 0) {
            $besoin = new Besoin();
            $besoin->id = $resultat->id;
            $besoin->idPoste = $resultat->idPoste;
            $besoin->besoin_horaire = $resultat->besoin_horaire;
            $besoin->heure_jour_homme = $resultat->heure_jour_homme;
        }
        return $besoin;
    }
}
