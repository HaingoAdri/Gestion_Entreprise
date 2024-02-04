<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Maintenance extends Model {
    public $id_maintenance;
    public $id_immobilisation_reception;

    public $id_type_entretien;
    public $designation_type_entretien;

    public $debut_maintenance;
    public $fin_maintenance;
    public $date_prochain_entretient;

    public $id_etat_entretien;
    public $designation_etat_entretien;

    public $designation;
   

    public function __construct($id_maintenance = "", $id_immobilisation_reception = "", $id_type_entretien = "", $designation_type_entretien = "", $debut_maintenance = "", $fin_maintenance = "", $date_prochain_entretient = "", $id_etat_entretien = "", $designation_etat_entretien = "", $designation = "") {
        $this->$id_maintenance = $id_maintenance;
        $this->$id_immobilisation_reception = $id_immobilisation_reception;

        $this->$id_type_entretien = $id_type_entretien;
        $this->$designation_type_entretien = $designation_type_entretien;

        $this->$debut_maintenance = $debut_maintenance;
        $this->$fin_maintenance = $fin_maintenance;
        $this->$date_prochain_entretient = $date_prochain_entretient;

        $this->$id_etat_entretien = $id_etat_entretien;
        $this->$designation_etat_entretien = $designation_etat_entretien;

        $this->designation = $designation;
    }

    public function getNextIDMaintenance() {
        $requette = "select nextID('seqMaintenance', 'MT', 10);";
        $reponse = DB::select($requette);
        $id = "";
        if(count($reponse) > 0){
            $id = $reponse[0]->nextid;
        }
        return $id;
    }

    public function insert() {
        try {
            $requete = "insert into maintenance (id_maintenance, id_immobilisation_reception, id_type_entretien, debut_maintenance, fin_maintenance, date_prochain_entretient, id_etat_entretien) values ('$this->getNextIDMaintenance()', '$this->id_immobilisation_reception', '$this->id_type_entretien', '$this->debut_maintenance', CURDATE(), CURDATE(), '$this->id_etat_entretien', '$this->description')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer maintenance: ".$e->getMessage());
        }    
    }

    public function getListeTypeEntretient(){
        $sql = "select * from type_entretient";
        $respone = DB::select($sql);
        $liste = array();
        if(count($respone) > 0){
            foreach($respone as $resultat) {
                $maintenance = new Maintenance(id_type_entretien: $resultat->id, designation_type_entretien: $resultat->designation);
                $liste[] = $maintenance;
            }
        }
        return $liste;
    }   

    public function getListeEtatEntretient(){
        $sql = "select * from etat_entretient";
        $respone = DB::select($sql);
        $liste = array();
        if(count($respone) > 0){
            foreach($respone as $resultat) {
                $maintenance = new Maintenance(id_etat_entretien: $resultat->id, designation_etat_entretien: $resultat->designation);
                $liste[] = $maintenance;
            }
        }
        return $liste;
    }   

    public function updateMaintenance($id, $fin_maintenance, $id_etat_entretien){
        $sql = "update maintenance set fin_maintenance = '$fin_maintenance', date_prochain_entretient = DATE_ADD('$fin_maintenance', INTERVAL 6 MONTH), id_etat_entretien = $id_etat_entretient where id_maintenance = '$id'";
        $requette = DB::update($sql);
        return $requette;
    }

    public function getListeMaintenanceEnCours() {
        $requette = "select * from maintenance where etat_entretient = 'EE000001'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $maintenance = new Maintenance(id_maintenance: $resultat->id_maintenance, id_immobilisation_reception: $resultat->id_immobilisation_reception, id_type_entretien: $resultat->id_type_entretien, debut_maintenance: $resultat->debut_maintenance, id_etat_entretien: $resultat->id_etat_entretien = "", description: $resultat->description);
                $liste[] = $maintenance;
            }
        }
        return $liste;
    }

    public function getListeMaintenanceTerminer() {
        $requette = "select * from maintenance where etat_entretient = 'EE000002'";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $maintenance = new Maintenance(id_maintenance: $resultat->id_maintenance, id_immobilisation_reception: $resultat->id_immobilisation_reception, id_type_entretien: $resultat->id_type_entretien, debut_maintenance: $resultat->debut_maintenance, id_etat_entretien: $resultat->id_etat_entretien = "", description: $resultat->description);
                $liste[] = $maintenance;
            }
        }
        return $liste;
    }


}
