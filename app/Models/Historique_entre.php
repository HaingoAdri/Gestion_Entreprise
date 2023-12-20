<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB




class Historique_entre extends Model {
    
    // public $id;
    public $dates;
    public $identre;
    public $produits;
    public $quantite;
    public $prix;
    

    public function __construct($date="", $identre="", $produits="", $quantite="", $prix=""){
       
        $this->dates = $date;
        $this->identre = $identre;
        $this->produits = $produits;
        $this->quantite = $quantite;
        $this->prix = $prix;
        
    }


    public function maka_entre(){
        $sql = "select * from historique";
        $reponse = DB::select($sql);
        return $reponse;
    }

    public function insertBonReception() {
        try {
            $requete = "insert into historique (dates, identre,produits,quantite, prix) values ('".$this->dates."', '".$this->identre."', '".$this->produits."', ".$this->quantite.",".$this->prix." )";
            echo $requete;
            DB::insert($requete);
            
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer un nouveau bon de reception: ".$e->getMessage());
        }    
    }
}
