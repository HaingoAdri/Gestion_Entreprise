<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Prime extends Model
{
    public $id;
    public $prime;
    public $type;
    public $id_employe;
    public $montant;
    public $date;
    public $nombre = 0;

    public function __construct($id = "", $prime = "", $type = "", $id_employe = "", $montant = 0, $date = "") {
        $this->id = $id;
        $this->prime = $prime;
        $this->type = $type;
        $this->id_employe = $id_employe;
        $this->montant = $montant;
        $this->date = $date;
    }

    public function getListe_Type_Prime() {
        $requette = " select * from type_prime order by prime";
        $reponse = DB::select($requette);
        $liste_prime = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Prime = new Prime(id: $resultat->id, prime: $resultat->prime);
                $liste_prime[] = $Prime;
            }
        }
        return $liste_prime;
    }

    public function getDonnees_Un_Type_Prime() {
        $requette = " select * from type_prime where id = " . $this->id;
        $reponse = DB::select($requette);
        $prime = null;
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $prime = new Prime(id: $resultat->id, prime: $resultat->prime);
            }
        }
        return $prime;
    }

    public function getUn_Prime_Employe($date_debut, $date_fin) {
        $requette = " select * from prime where id_employe = '". $this->id_employe ."' and type = ". $this->id ." and date >= '".$date_debut."' and date <= '".$date_fin."'";
        // echo $requette;
        $reponse = DB::select($requette);
        $montant = 0;
        $prime = new Prime();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $type = (new Prime(id: $resultat->type))->getDonnees_Un_Type_Prime();
                $prime = new Prime($resultat->id, $type->prime, $type->id, $resultat->id_employe, $resultat->montant, $resultat->date);
                $montant += $prime->montant;
            }
            $prime->montant = $montant;
            $prime->nombre = count($reponse);
        }
        return $prime;
    }

}
