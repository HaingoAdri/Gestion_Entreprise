<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Tafiditra_Mpiasa extends Model {
    public $id_taf;
    public $id_ok;
    public $date;

    public function __construct($id_taf = "", $id_ok ="", $date="") {
        $this->id_taf = $id_taf;
        $this->id_ok = $id_ok;
        $this->date = $date;
    }

    
    public function insert() {
        try {
            $requete = "insert into tafiditra_mpiasa (id_ok, dates) values (".$this->id_ok.",'". $this->date ."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Tafiditra_Mpiasa: ".$e->getMessage());
        }    
    }

    public function getTafiditra_MpiasaAa($aa) {
        $requette = "select * from tafiditra_mpiasa ";
        $reponse = DB::select($requette);
        return $reponse;
    }
}
