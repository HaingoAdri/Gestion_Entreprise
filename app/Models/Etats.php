<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Etats extends Model {
    public $id_e;
    public $noms_etats;
   

    public function __construct($id_e, $noms_etats) {
        $this->id_e = $id_e;
        $this->noms_etats = $noms_etats;
        
    }

    public function insert() {
        try {
            $requete = "insert into etats (id_et, nom_etats) values (".$this->id_e.",'".$this->noms_etats."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Etats: ".$e->getMessage());
        }    
    }

    public function getEtatsAa($aa) {
        $requette = "select * from etats ";
        $reponse = DB::select($requette);
        $Etats = null;
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Etats = new Etats();
                $Etats->id_e  = $resultat->id_e;
                $Etats->noms_etats  = $resultat->nom_etats;
                
            }
        }
        return $Etats;
    }
}
