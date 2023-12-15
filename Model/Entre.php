<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB




class Entre extends Model {
    
    public $dates;
    public $idCommande;
    public $produits;
    public $quantite;
    public $prix;
    public $montant;

    public function __construct( $dates="", $idCommande="", $produits="", $quantite="", $prix="", $montant=""){
        $this->dates = $dates;
        $this->idCommande = $idCommande;
        $this->produits = $produits;
        $this->quantite = $quantite;
        $this->prix = $prix;
        $this->montant = $montant;
    }


    public function maka_entre(){
        $sql = "select * from entre_stock";
        $reponse = DB::select($sql);
        return $reponse;
    }

    public function maka_entre_id($id){
        $sql = "select * from entree where id = '".$id."'";
        $response = DB::select($sql);
        return $reponse;
    }

    public function update_Entre($quantite, $dates ,$id){
        try {
            $sql = "update entre_stock set quantite =".$quantite.", date = '".$dates."' where ide = '".$id."'";
            DB::update($sql);
            echo $sql;
        } catch (Exception $th) {
            throw new Exception("Impossible de changer l'entre: ".$e->getMessage());
        }
    }

    public function getEntreFifo($produits){
        $sql = "select * from entre_stock where article = '".$produits."' order by date asc";
        echo $sql;
        $response = DB::select($sql);
        return $response;
    }

    public function getEntreLifo($produits){
        $sql = "select * from entre_stock where article = '".$produits."' order by date desc";
        echo $sql;
        $response = DB::select($sql);
        return $response;
    }

    
}
