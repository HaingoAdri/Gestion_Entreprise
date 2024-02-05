<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Immobilisation_reception extends Model {
    public $id_immobilisation;
    public $id_pv_reception;
    public $id_etat_immobilisation;
    public $dernier_date;
   

    public function __construct($id_immobilisation = "", $id_pv_reception = "", $id_etat_immobilisation = 0, $dernier_date = "") {
        $this->id_immobilisation = $id_immobilisation;
        $this->id_pv_reception = $id_pv_reception;
        $this->id_etat_immobilisation = $id_etat_immobilisation;
        $this->dernier_date = $dernier_date;
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
            $requete = "insert into Immobilisation_reception (id_immobilisation, id_pv_reception, id_etat_immobilisation, dernier_date) values ('$this->id_immobilisation','$this->id_pv_reception', $this->id_etat_immobilisation, '$this->dernier_date')";
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
        $sql = "update immobilisation_reception set libre = 65 where id_immobilisation = '$id'";
        $requette = DB::update($sql);
        return $requette;
    }

    public function updateImmobilisation($id, $date){
        $sql = "update immobilisation_reception set id_etat_immobilisation = 4, dernier_date = '$date' where id_immobilisation = '$id'";
        $requette = DB::update($sql);
        return $requette;
    }

    public function updateImmobilisationEnCoursMaintenance($id){
        $sql = "update immobilisation_reception set id_etat_immobilisation = 5 where id_immobilisation = '$id'";
        $requette = DB::update($sql);
        return $requette;
    }

    public function getOneImmobilisation($id) {
        $requette = "select * from immobilisation_reception where id_immobilisation = '$id'";
        // $requette = "select * from immobilisation_reception where id_etat_immobilisation = 3 and libre = 60";
        $reponse = DB::select($requette);
        $liste = null;
        if(count($reponse) > 0){
            $Immobilisation_reception = new Immobilisation_reception(id_immobilisation: $reponse[0]->id_immobilisation, id_pv_reception: $reponse[0]->id_pv_reception, id_etat_immobilisation: $reponse[0]->id_etat_immobilisation, dernier_date: $reponse[0]->dernier_date);
            $liste = $Immobilisation_reception;
        }
        return $liste;
    }

    public function getListeImmobilisationInutilisable() {
        $requette = "select * from immobilisation_reception where id_etat_immobilisation = 3";
        // $requette = "select * from immobilisation_reception where id_etat_immobilisation = 3 and libre = 60";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Immobilisation_reception = new Immobilisation_reception(id_immobilisation: $resultat->id_immobilisation, id_pv_reception: $resultat->id_pv_reception, id_etat_immobilisation: $resultat->id_etat_immobilisation, dernier_date: $resultat->dernier_date);
                $liste[] = $Immobilisation_reception;
            }
        }
        return $liste;
    }

}
