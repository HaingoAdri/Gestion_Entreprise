<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Liste_Adresse_entreprise extends Model {
    public $id;
    public $adresse;
    public $date;
   

    public function __construct($id = "", $adresse = "", $date = "") {
        $this->id = $id;
        $this->adresse = $adresse;
        $this->date = $date;
    }

    public function insert() {
        try {
            $requete = "insert into Liste_Adresse_entreprise (adresse, date) values ('".$this->adresse."', '".$this->date."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer un nouveau adresse: ".$e->getMessage());
        }    
    }

    public function getListeAdresse() {
        $requette = "select * from liste_Adresse_entreprise order by date desc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $adresse = new Liste_Adresse_entreprise($resultat->id, $resultat->adresse, $resultat->date);
                $liste[] = $adresse;                
            }
        }
        return $liste;
    }

    public function getDonneesAdresse() {
        $requette = "select * from liste_Adresse_entreprise where id = " . $this->id;
        $reponse = DB::select($requette);
        $adresse = null;
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $adresse = new Liste_Adresse_entreprise($resultat->id, $resultat->adresse, $resultat->date);
                break;
            }
        }
        return $adresse;
    }
}
