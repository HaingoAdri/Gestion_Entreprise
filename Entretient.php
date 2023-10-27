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
    

    public function __construct($id_e="", $aa="", $dates="", $heures="", $lieu="") {
        $this->id_e = $id_e;
        $this->aa = $aa;
        $this->dates = $dates;
        $this->heures = $heures;
        $this->lieu = $lieu;
    }

    public function insert() {
        try {
            $requete = "insert into entretient(aa, dates, heures, lieu) values (".$this->aa.",'".$this->dates."' ,'".$this->heures."','".$this->lieu."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer entretient: ".$e->getMessage());
        }    
    }

    public function getEntretientAa() {
        $requette = "select * from entretient ";
        $reponse = DB::select($requette);
        return $reponse;
    }
}
