<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class Categorie extends Model
{
    public $id;
    public $categorie;

    public $listeDescription = array();

    public function __construct($id = "", $categorie = "") {
        $this->id = $id;
        $this->categorie = $categorie;
    }

    public function insert() {
        try {
            $requete = "insert into categorie values ('".$this->id."','".$this->categorie."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert categorie: ".$e->getMessage());
        }    
    }

    public function getListeCategorie() {
        $requette = "select * from categorie order by categorie";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $categorie = new Categorie($resultat->id, $resultat->categorie);
                $liste[] = $categorie;
            }
        }
        return $liste;
    }

    public function getUnCategorie() {
        $requette = "select * from categorie where id = '$this->id'";
        $reponse = DB::select($requette);
        $categorie = null;
        if(count($reponse) > 0){
            $categorie = new Categorie($reponse[0]->id, $reponse[0]->categorie);
        }
        return $categorie;
    }

    public function getDonneesUncategorie() {
        $requette = "select * from categorie where id = '$this->id'";
        $reponse = DB::select($requette);
        $categorie = null;
        if(count($reponse) > 0){
            $categorie = new Categorie($reponse[0]->id, $reponse[0]->categorie);
            $categorie->listeDescription = (new Description())->getListeDescription($reponse[0]->id);
        }
        return $categorie;
    }

    public function isCategorieExisteDeja() {
        $requette = "select * from categorie where categorie = '$this->categorie'";
        $reponse = DB::select($requette);
        if(count($reponse) > 0){
            return true;
        }
        return false;
    }

    public function ajoutType($type) {
        try {
            $requete = "insert into sous_categorie_type(type, idCategorie) values ('".$type."','".$this->id."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert sous_categorie_type: ".$e->getMessage());
        }   
    }

    public function getListeCategorieParType($type) { 
        $requette = "select * from liste_sous_categorie_par_type where type = '$type' order by categorie";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $categorie = new Categorie($resultat->idcategorie, $resultat->categorie);
                $liste[] = $categorie;
            }
        }
        return $liste;
    }


}

