<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class Caisse extends Model
{
    public $id;
    public $nom;
    public $idCompte;
    public $etat;

    public function __construct($id = "", $nom = "", $idCompte = "") {
        $this->id = $id;
        $this->nom = $nom;
        $this->idCompte = $idCompte;
    }

    public function setId() {
        $requette = "select nextID('seqCaisse', 'CS', 10)";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            $this->id = $reponse[0]->nextid;
        }
    }

    public function insert() {
        try {
            $this->setId();
            $requete = "insert into Caisse values ( '".$this->id."', '".$this->nom."', '".$this->idCompte."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Le numero de Caisse $this->id existe deja!");
        }    
    }

    public function getListeCaisse() {
        $requette = "select * from Caisse order by nom";
        if($this->id != "")
            $requete = "select * from Caisse where id = '$this->id'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Caisse = new Caisse($resultat->id, $resultat->nom, $resultat->idcompte);
                $liste[] = $Caisse;
            }
        }
        return $liste;
    }

    public function compteCaisseExisteDeja() {
        $requette = "select * from Caisse where idCompte = '$this->idCompte'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            return true;
        }
        return false;
    }

    public function caisseExisteDeja() {
        $requette = "select * from Caisse where id = '$this->id'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            return true;
        }
        return false;
    }

    public function nomCaisseExisteDeja() {
        $requette = "select * from Caisse where nom = '$this->nom'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            return true;
        }
        return false;
    }

    public function getListeCaisseParMagasin($idMagasin) {
        $requette = "select * from liste_caisse_magasin where idMagasin = '$idMagasin'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Caisse = new Caisse($resultat->id, $resultat->nom, $resultat->idcompte);
                $Caisse->etat = $resultat->etat;
                $liste[] = $Caisse;
            }
        }
        return $liste;
    }

    public function caisseAppartientMagasin() {
        $requette = "select * from caisse_magasin where idCaisse = '$this->id'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            return true;
        }
        return false;
    }

    public function caisseExisteDansUnMagasin($idMagasin) {
        $requette = "select * from caisse_magasin where idCaisse = '$this->id' and idmagasin = '$idMagasin'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            return true;
        }
        return false;
    }
}
