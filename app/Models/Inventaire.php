<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class Inventaire extends Model
{
    public $id;
    public $date;
    public $immobilisation;
    public $etat_immobilisation;
    public $description;
    public $taux;
    public $ammortissement;
    public $type_inventaire;
    public $libeller;

    public function __construct($id = "", $date="", $immobilisation="", $etat_immobilisation="", $description="", $taux="", $ammortissement="", $type_inventaire="", $libele="") {
        $this->id = $id;
        $this->date = $date;
        $this->immobilisation = $immobilisation;
        $this->etat_immobilisation = $etat_immobilisation;
        $this->description = $description;
        $this->taux = $taux;
        $this->ammortissement = $ammortissement;
        $this->type_inventaire = $type_inventaire;
        $this->libeller = $libele;
    }

    public function insert() {
        try {
            $requete = "insert into inventaire(date, immobilisation, etat_immobilisation, description, taux, ammortissement,type_inventaire,libeller) values ('$this->date', '$this->immobilisation', '$this->etat_immobilisation', '$this->description', $this->taux, $this->ammortissement,'$this->type_inventaire','$this->libeller')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert inventaire: ".$e->getMessage());
        }    
    }

    public function getUninventaire() {
        $requette =  "select * from inventaire where id = '$this->id'";
        $reponse = DB::select($requette);
        return $reponse;
    }

    public function getListeinventaire() {
        $requette =  "select * from inventaire";
        $reponse = DB::select($requette);
        return $reponse;
    }
}