<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;
use App\Models\Besoin;
use App\Models\Details_Besoin_Age;
use App\Models\Details_Besoin_Diplome;
use App\Models\Details_Besoin_Experience;
use App\Models\Genre;

class Annonce extends Model
{
    public function calcul_personne_besoin(){
        $besoin = new Besoin();
        $bHoraire = $besoin->besoin_horaire;
        $tjh = $besoin->heure_jour_homme;
        $nbPersonne = ($bHoraire/$tjh);
        return $nbPersonne;
    }

    public function getGenre($nombre){
        if($nombre == 1){
            return "Femme";
        }else if($nombre == 10){
            return "Homme";
        }
        return "";
    }

    public function getAge($idBesoin){
        $dataAge = (new Details_Besoin_Age())->getListeBesoinsAgeParIdBesoin($idBesoin);
        $minimumAge = $dataAge[0]->min;
        $maximumAge = $dataAge[count($dataAge)-1]->max;
        return [$minimumAge, $maximumAge];
    }

    public function getNationalite($idBesoin){
        $dataNationalite = (new Details_Besoin_Salaire())->getListeBesoinsNationaliteParIdBesoin($idBesoin);
        $nationalites = array();
        for($i=0; $i<count($dataNationalite); $i++){
            $nationalites[] = $dataNationalite[$i]->nationalite->type;
        }
        return $nationalites;
    }
}