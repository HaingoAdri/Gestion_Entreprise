<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Type_avantage_nature extends Model {
    public $id;
    public $type;
   

    public function __construct($id = "", $type = "") {
        $this->id = $id;
        $this->type = $type;
        
    }

    public function insert() {
        try {
            $requete = "insert into Type_avantage_nature (type) values ('".$this->type."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Ce Type d'avantge en nature : ".$e->getMessage());
        }    
    }

    public function getListeAvantage() {
        $requette = "select * from Type_avantage_nature ";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $avanatge = new Type_avantage_nature($resultat->id, $resultat->type);
                $liste[] = $avanatge;
            }
        }
        return $liste;
    }

    public function getDonneesTypeAvantage() {
        $requette = "select * from Type_avantage_nature where id = " . $this->id;
        $reponse = DB::select($requette);
        $avanatge = null;
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $avanatge = new Type_avantage_nature($resultat->id, $resultat->type);
                break;
            }
        }
        return $avanatge;
    }
}
