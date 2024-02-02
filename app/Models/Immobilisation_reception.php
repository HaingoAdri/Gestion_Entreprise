<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Immobilisation_reception extends Model {
    public $id_immobilisation;
    public $id_pv_reception;
    public $id_etat_immobilisation;
   

    public function __construct($id_immobilisation = "", $id_pv_reception = "", $id_etat_immobilisation = 0) {
        $this->id_immobilisation = $id_immobilisation;
        $this->id_pv_reception = $id_pv_reception;
        $this->id_etat_immobilisation = $id_etat_immobilisation;
    }

    public function getNextIDImmobilisationReception() {
        $requette = "select nextID('seqImmobilisation_reception', 'IR', 10);";
        $reponse = DB::select($requette);
        $id = "";
        if(count($reponse) > 0){
            $id = $reponse[0]->nextid;
        }
        return $id;
    }

    public function insert() {
        try {
            $requete = "insert into Immobilisation_reception (id, id_pv_reception, id_etat_immobilisation) values ('$this->getNextIDImmobilisationReception','$this->id_pv_reception', $this->id_etat_immobilisation)";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Etat_immobilisation: ".$e->getMessage());
        }    
    }

    public function getAllImmobilisation_reception(){
        $sql = "select * from immobilisation_reception";
        $respone = DB::select($sql);
        return $respone;
    }   

    public function getUnImmobilisationReception($id){
        $sql = "select * from immobilisation_reception where id_immobilisation = '$id'";
        $reponse = DB::select($sql);
        return $reponse;
    }

    public function getAllAmmortissement(){
        $sql ="select * from type_ammortissement";
        $requette = DB::select($sql);
        return $requette;
    }

    public function updateEtatImmobilisation($id){
        $sql = "update immobilisation_reception set libre = 2 where id_immobilisation = '$id'";
        $requette = DB::update($sql);
        return $requette;
    }
}
