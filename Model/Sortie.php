<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB

use App\Models\Entre;


class Sortie extends Model {
    
    public $id;
    public $dates;
    public $produits;
    public $entre;
    public $quantite;
    public $etas;
    

    public function __construct( $dates = "", $produits = "", $entre = "", $quantite="", $etats=""){
        //$this->id = $id;
        $this->dates = $dates;
        $this->produits = $produits;
        $this->entre = $entre;
        $this->quantite = $quantite;
        $this->etas = $etats;
    }

    public function insert(){
        try {
            $sql = "insert into sortie (dates, produits, etats, entre, quantite) values ('".$this->dates."', '".$this->produits."', '".$this->etas."','".$this->entre."',".$this->quantite." ) ";
            DB::insert($sql);
            echo $sql;
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer un nouveau demande proformat: ".$e->getMessage());
        }
    }

    public function getSortie(){
        $sql = "select * from sortie";
        $reponse = DB::select($sql);
        return $reponse;
    }


}
