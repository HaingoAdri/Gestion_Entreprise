<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Etats extends Model {
    public $id_e;
    public $noms_etats;
   

    public function __construct($id_e = "", $noms_etats = " ") {
        $this->id_e = $id_e;
        $this->nom_etats = $noms_etats;
        
    }

    public function insert() {
        try {
            $requete = "insert into etats (id_et, nom_etats) values (".$this->id_e.",'".$this->noms_etats."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Etats: ".$e->getMessage());
        }    
    }

    public function getDonnes_Un_Etat() {
        $requette = "select * from etats where id_et = " . $this->id_e;
        $reponse = DB::select($requette);
        $Etats = null;
        if(count($reponse) > 0){
            $Etats = new Etats( $reponse[0]->id_et, $reponse[0]->nom_etats);
        }
        return $Etats;
    }

    public function getEtats() {
        $requette = "select * from etats ";
        $reponse = DB::select($requette);
        return $reponse;
    }
}
