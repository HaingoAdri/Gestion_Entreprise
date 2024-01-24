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

    public $listeSousCategorie = array();

    public $idDescription;
    public $description;

    public function __construct($id = "", $nom = "", $etat = "", $idDescription = "", $description = "") {
        $this->id = $id;
        $this->nom = $nom;
        $this->etat = $etat;
        $this->idDescription = $idDescription;
        $this->description = $description;
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

    public function getResteEnCompte() {
        $requette = "select * from reste_argents_avec_nom_compte where idCompte = '$this->id'";
        $reponse = DB::select($requette);
        $reste = 0;
        if(count($reponse) > 0){
            $reste = $reponse[0]->reste;
        }
        return $reste;
    }

    public function getListeTypeImmobilisation() {
        $requette = "select * from type_immobilisation order by nom";
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

    public function getNextSeqTypeImmobilisation() {
        $requette = "select * from compte where id like '$this->id%'";
        $reponse = DB::select($requette);
        return count($reponse);
    }

    public function getCompte() {
        $requette = "select * from compte where id = '$this->id'";
        $reponse = DB::select($requette);
        $compte = null;
        if(count($reponse) > 0){
            $compte = new Compte($reponse[0]->id, $reponse[0]->nom, $reponse[0]->etat);
        }
        return $compte;
    }

    public function getListeDescription() {
        $requette = "select * from liste_description_type_immobilisation where type = '$this->id'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $compte = new Compte(id: $resultat->type, nom: $resultat->nom, idDescription: $resultat->id, description: $resultat->description);
                $liste[] = $compte;
            }
        }
        return $liste;    
    }

    public function getDonneesUnTypeImmobilisation() {
        $compte = $this->getCompte();
        if($compte != null){
            $compte->listeSousCategorie = (new Categorie())->getListeCategorieParType($compte->id);
        }
        return $compte;
    }

    public function isSousCategorieExisteDeja($idCategorie) { 
        $requette = "select * from liste_sous_categorie_par_type where type = '$this->id' and idCategorie = '$idCategorie' order by categorie";
        $reponse = DB::select($requette);
        if(count($reponse) > 0){
            return true;
        }
        return false;
    }

}
