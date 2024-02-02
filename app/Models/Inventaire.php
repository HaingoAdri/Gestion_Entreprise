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
    public $autre_description;
    public $ammortissement;
    public $information;

    public function __construct($id = "", $date="", $immobilisation="", $etat_immobilisation="", $description="", $autre_description="", $ammortissement="", $information="") {
        $this->id = $id;
        $this->date = $date;
        $this->immobilisation = $immobilisation;
        $this->etat_immobilisation = $etat_immobilisation;
        $this->description = $description;
        $this->autre_description = $autre_description;
        $this->ammortissement = $ammortissement;
        $this->information = $information;
    }

    public function insert() {
        try {
            $requete = "insert into inventaire(date, immobilisation, etat_immobilisation, autre_description) values ('$this->date', '$this->immobilisation', $this->etat_immobilisation,'$this->autre_description')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert inventaire: ".$e->getMessage());
        }    
    }

    public function insert_Details_Inventaire() {
        try {
            $requete = "insert into details_inventaire(id_inventaire, id_description, information) values ('$this->id, '$this->description','$this->information')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert details_inventaire: ".$e->getMessage());
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