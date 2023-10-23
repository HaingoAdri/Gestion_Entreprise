<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Entretient extends Model {
    public $id_e;
    public $aa;
    public $dates;
    public $heures;
    public $lieu;
    

    public function __construct($id_e, $aa, $dates, $heures, $lieu) {
        $this->id_e = $id_e;
        $this->aa = $aa;
        $this->dates = $dates;
        $this->heures = $heures;
        $this->lieu = $lieu;
    }

    public function insert() {
        try {
            $requete = "insert into entretient(id_e, aa, dates, heures, lieu) values (".$this->id_e.",".$this->aa.",'".$this->dates."' ,".$this->heures.",'".$this->lieu."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer entretient: ".$e->getMessage());
        }    
    }

    public function getEntretientAa($aa) {
        $requette = "select * from entretient ";
        $reponse = DB::select($requette);
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Entretient = new Entretient();
                $Entretient->id_e  = $resultat->id_e;
                $Entretient->aa  = $resultat->aa;
                $Entretient->dates  = $resultat->dates;
                $Entretient->heures  = $resultat->heures;
                $Entretient->lieu  = $resultat->lieu;
            }
        }
        return $Entretient;
    }
}
