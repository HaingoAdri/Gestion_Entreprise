<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Etat_immobilisation extends Model {
    public $id;
    public $nom;
   

    public function __construct($id = "", $nom = " ") {
        $this->id = $id;
        $this->nom = $nom;
        
    }

    public function insert() {
        try {
            $requete = "insert into etat_immobilisation (id, nom) values (default,'".$this->nom."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Etat_immobilisation: ".$e->getMessage());
        }    
    }

    public function getDonnes_Un_Etat() {
        $requette = "select * from etat_immobilisation where id = " . $this->id;
        $reponse = DB::select($requette);
        $Etats = null;
        if(count($reponse) > 0){
            $Etat_immobilisation = new Etat_immobilisation( $reponse[0]->id, $reponse[0]->nom);
        }
        return $Etats;
    }

    public function getAllEtats() {
        $requette = "select * from etat_immobilisation ";
        $reponse = DB::select($requette);
        return $reponse;
    }
}
