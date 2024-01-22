<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class Lieu extends Model
{
    public $id;
    public $nom;
    public $id_etat;

    public function __construct($id = "", $nom = "", $id_etat = 0) {
        $this->id = $id;
        $this->nom = $nom;
        $this->id_etat = $id_etat;
    }

    public function insert() {
        try {
            $requete = "insert into lieu(id, nom, id_etat) values ('$this->id', '$this->nom', $this->id_etat)";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert lieu: ".$e->getMessage());
        }    
    }

    public function getUnLieu() {
        $requette =  "select * from lieu where id = '$this->id'";
        $reponse = DB::select($requette);
        $lieu = null;
        if(count($reponse) > 0){
            $lieu = new Lieu(id: $reponse[0]->id, nom: $reponse[0]->nom, id_etat: $reponse[0]->id_etat);
        }
        return $lieu;
    }

    public function getListeLieu() {
        $requette =  "select * from lieu where id_etat = 32";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $lieu = new Lieu(id: $resultat->id, nom: $resultat->nom, id_etat: $resultat->id_etat);
                $liste[] = $lieu;
            }
        }
        return $liste;
    }
}