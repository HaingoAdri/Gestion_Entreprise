<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class Livreur extends Model
{
    public $id;
    public $nom;
    public $contact;
    public $id_fournisseur;

    public function __construct($id = "", $nom = "", $contact = "", $id_fournisseur = 0) {
        $this->id = $id;
        $this->nom = $nom;
        $this->contact = $contact;
        $this->id_fournisseur = $id_fournisseur;
    }

    public function insert() {
        try {
            $requete = "insert into livreur(id, nom, contact, id_fournisseur) values (default, '$this->nom', '$this->contact', $this->id_fournisseur)";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert livreur: ".$e->getMessage());
        }    
    }

    public function getUnLivreur() {
        $requette =  "select * from livreur where id = '$this->id'";
        $reponse = DB::select($requette);
        $livreur = null;
        if(count($reponse) > 0){
            $livreur = new Livreur(id: $reponse[0]->id, nom: $reponse[0]->nom, contact: $reponse[0]->contact, id_fournisseur: $reponse[0]->id_fournisseur);
        }
        return $livreur;
    }

    public function getListeLivreur() {
        $requette =  "select * from livreur";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $livreur = new Livreur(id: $resultat->id, nom: $resultat->nom, contact: $resultat->contact, id_fournisseur: $resultat->id_fournisseur);
                $liste[] = $livreur;
            }
        }
        return $liste;
    }
}