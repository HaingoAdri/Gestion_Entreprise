<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Tafiditra_Mpiasa extends Model {
    public $id_taf;
    public $id_ok;
   

    public function __construct($id_taf, $id_ok) {
        $this->id_taf = $id_taf;
        $this->id_ok = $id_ok;
        
    }

    public function insert() {
        try {
            $requete = "insert into tafiditra_mpiasa (id_taf, id_ok) values (".$this->id_taf.",".$this->id_ok.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Tafiditra_Mpiasa: ".$e->getMessage());
        }    
    }

    public function getTafiditra_MpiasaAa($aa) {
        $requette = "select * from tafiditra_mpiasa ";
        $reponse = DB::select($requette);
        $Tafiditra_Mpiasa = null;
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Tafiditra_Mpiasa = new Tafiditra_Mpiasa();
                $Tafiditra_Mpiasa->id_taf  = $resultat->id_taf;
                $Tafiditra_Mpiasa->id_ok  = $resultat->id_ok;
            }
        }
        return $Tafiditra_Mpiasa;
    }
}
