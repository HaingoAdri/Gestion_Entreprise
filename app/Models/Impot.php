create table impot(
    id Serial PRIMARY KEY,
    plafond_minimum DOUBLE PRECISION,
    plafond_maximum DOUBLE PRECISION,
    pourcentage DOUBLE PRECISION
);

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Impot extends Model
{
    public $id;
    public $plafond_minimum;
    public $plafond_maximum;
    public $pourcentage;

    public function __construct($id = "", $plafond_minimum = "", $plafond_maximum = "", $pourcentage = "") {
        $this->id = $id;
        $this->plafond_minimum = $plafond_minimum;
        $this->plafond_maximum = $plafond_maximum;
        $this->pourcentage = $pourcentage;
    }

    public function insert() {
        try {
            $requete = "insert into impot values (default,".$this->plafond_minimum.", ".$this->plafond_maximum.", ".$this->pourcentage.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert impot: ".$e->getMessage());
        }    
    }

    public function getImpot_Pour_Salaire($salaire_brut) {
        $requette = "select * from impot where ".$salaire_brut." > plafond_minimum and ".$salaire_brut." <= plafond_maximum";
        $reponse = DB::select($requette);
        $retenu = 0;
        if(count($reponse) > 0){
            $retenu = $reponse[0]->pourcentage;
        }
        return $retenu;   
    }

    public function getImpot_Du($salaire_brut) {
        $pourcentage = $this->getImpot_Pour_Salaire();
        $impot = $salaire_brut * ($pourcentage/100);
        if($impot <= 0)
            $impot = 0;
        return $impot;
    }
}
