<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

class Fournisseur extends Model
{
    public $id;
    public $nom;
    public $email;
    public $adresse;
    public $telephone;
    public $responsable;

    public function __construct($id = "", $nom = "", $email = "", $adresse = "", $telephone = "", $responsable = "") {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
        $this->responsable = $responsable;
    }

    public function insert() {
        try {
            $requete = "insert into fournisseur(nom, email, adresse, telephone, responsable) values ('".$this->nom."', '".$this->email."', '".$this->adresse."', '".$this->telephone."', '".$this->responsable."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Fournisseur: ".$e->getMessage());
        }    
    }

    public function getListeFournisseur() {
        $requette = "select * from fournisseur order by nom";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $fournisseur = new Fournisseur($resultat->id, $resultat->nom, $resultat->email, $resultat->adresse, $resultat->telephone, $resultat->responsable);
                $liste[] = $fournisseur;
            }
        }
        return $liste;
    }

    public function getDonneesUnFournisseur() {
        $requette = "select * from fournisseur where id = $this->id";
        $reponse = DB::select($requette);
        $fournisseur = null;
        if(count($reponse) > 0){
            $fournisseur = new Fournisseur($reponse[0]->id, $reponse[0]->nom, $reponse[0]->email, $reponse[0]->adresse, $reponse[0]->telephone, $reponse[0]->responsable);
        }
        return $fournisseur;
    }
}
