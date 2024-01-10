<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class Compte extends Model
{
    public $id;
    public $nom;
    public $etat;

    public function __construct($id = "", $nom = "", $etat = "") {
        $this->id = $id;
        $this->nom = $nom;
        $this->etat = $etat;
    }

    public function insert() {
        try {
            $requete = "insert into compte values ('".$this->id."','".$this->nom."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Le numero de compte $this->id existe deja!");
        }    
    }

    public function getListeCompte() {
        $requette = "select * from compte order by id";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $compte = new Compte($resultat->id, $resultat->nom, $resultat->etat);
                $liste[] = $compte;
            }
        }
        return $liste;
    }

    public function numeroCompteExisteDeja() {
        $requette = "select * from compte where id = '$this->id'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            return true;
        }
        return false;
    }

}
