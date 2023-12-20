<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Mouvement extends Model {
    
    public $idMouvements;
    public $type;
    public $dates;
    public $produits;
    public $quantite;
    public $prix;
    public $idReception;

    public function _construct($id = "", $type = "", $dates = "", $produits = "", $quantite="", $prix="", $reception = ""){
        $this->idMouvements = $id;
        $this->type = $type;
        $this->dates = $dates;
        $this->produits = $produits;
        $this->quantite = $quantite;
        $this->prix = $prix;
        $this->idReception = $reception;
    }


    public function getAllEntre(){
        $sql = "select * from entre";
        $reponse = DB::select($sql);
        return $reponse;
    }

    public function getType_Sortie(){
        $sql = "select * from type_sortie";
        $reponse = DB::select($sql);
        $requette = array();
        foreach($reponse as $result){
            $requette[] = $result->id;
        }
        return $requette;
    }
}
