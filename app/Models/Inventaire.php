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
    public $immobisation;
    public $etat_immobilisation;
    public $description;
    public $taux;
    public $ammortissement;

    public function __construct($id = "", $date="", $immobisation="", $etat_immobilisation="", $description="", $taux="", $ammortissement) {
        $this->id = $id;
        $this->date = $date;
        $this->immobilisation = $immobisation;
        $this->etat_immobilisation = $etat_immobilisation;
        $this->description = $description;
        $this->taux = $taux;
        $this->ammortissement = $ammortissement;
    }

    public function insert() {
        try {
            $requete = "insert into inventaire(id, date, immobilisation, etat_immobilisation, description, taux, ammortissement) values ('$this->id', '$this->date', '$this->immobilisation', '$this->etat_immobilisation', '$this->description', $this->taux, $this->ammortissement)";
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
        $requette =  "select * from inventaire where id_etat = 32";
        $reponse = DB::select($requette);
        return $reponse;
    }
}