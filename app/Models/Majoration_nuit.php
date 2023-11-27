<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Majoration_nuit extends Model
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

    public function getListeMajoration() {
        $requette = " select * from majoration_nuit where date <= '". $this->date ."' order by date, debut asc limit 4;";
        $reponse = DB::select($requette);
        $liste_majoration = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $majoration = new Majoration_nuit($resultat->id, $resultat->debut, $resultat->fin, $resultat->majoration, $resultat->date);
                $liste_majoration[] = $majoration;
            }
        }
        return $liste_majoration;
    }

    public function getTauxMajoration($heures, $taux_horaire) {
        $liste_majoration = $this->getListeMajoration();
        $majoration = array();
        $somme = 0;
        $i = 0;
        for($i; $i < count($liste_majoration); $i++) {
            $majoration[$i]["majoration"] = $liste_majoration[$i]->majoration;
            $majoration[$i]["prix_majoration"] = $taux_horaire * (($liste_majoration[$i]->majoration+100)/100);
            $majoration[$i]["prix"] = 0;
            $h = 0;
            if($heures > $liste_majoration[$i]->fin) 
                $h = $liste_majoration[$i]->fin - $liste_majoration[$i]->debut;
            else if($heures < $liste_majoration[$i]->fin && $heures >= $liste_majoration[$i]->debut) 
                $h = $heures - $liste_majoration[$i]->debut + 1;
            $majoration[$i]["heures"] = $h;
            $majoration[$i]["prix"] = $h * $majoration[$i]["prix_majoration"];
            $somme += $majoration[$i]["prix"] ;
        }
        $majoration[$i]["somme"] = $somme;
        return $majoration;
    }
}
