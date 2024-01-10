<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class Magasin extends Model
{
    public $id;
    public $nom;
    public $lieu;
    public $date;

    public $listeCaisse;

    public function __construct($id = "", $nom = "", $lieu = "", $date = "") {
        $this->id = $id;
        $this->nom = $nom;
        $this->lieu = $lieu;
        $this->date = $date;
    }

    public function setId() {
        $requette = "select nextID('seqMagasin', 'MG', 10)";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            $this->id = $reponse[0]->nextid;
        }
    }

    public function insert() {
        try {
            $this->setId();
            $requete = "insert into Magasin values ('".$this->id."' , '".$this->nom."', '".$this->lieu."', '".$this->date."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Le numero de Magasin $this->id existe deja!");
        }    
    }

    public function getListeMagasin() {
        $requette = "select * from Magasin order by nom";
        if($this->id != "")
        $requette = "select * from Magasin where id = '$this->id'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Magasin = new Magasin($resultat->id, $resultat->nom, $resultat->lieu, $resultat->date);
                $liste[] = $Magasin;
            }
        }
        return $liste;
    }

    public function nomExisteDeja() {
        $requette = "select * from Magasin where nom = '$this->nom'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            return true;
        }
        return false;
    }

    public function setListeCaisse() {
        $listeCaisse = (new Caisse())->getListeCaisseParMagasin($this->id);
        $this->listeCaisse = $listeCaisse;
    }

    public function getMagasin() {
        $magasin = $this->getListeMagasin()[0];
        $magasin->setListeCaisse();
        return $magasin;
    }

    public function ajoutCaisse($idCaisse) {
        try {
            $requete = "insert into caisse_magasin(idMagasin, idCaisse) values ('".$this->id."', '".$idCaisse."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }    
    }

}
