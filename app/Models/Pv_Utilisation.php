<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Pv_Utilisation extends Model
{
    public $id;
    public $date;
    public $immobilisation;
    public $employer;
    public $etat;

    public function __construct($id=" ", $date=" ", $immobilisation=" ", $employer=" ", $etat=" "){
        $this->id = $id;
        $this->date = $date;
        $this->immobilisation = $immobilisation;
        $this->employer = $employer;
        $this->etat = $etat;
    }

    public function insert_Pv_utilisation() {
        try {
            $requete = "insert into pv_utilisation(id, date, immmobilisation,id_employer, etat_immobilisation) values ('$this->id','$this->date', '$this->immobilisation', '$this->employer', $this->etat)";
            $reponse = DB::insert($requete);
            return $reponse;
        } catch (Exception $e) {
            throw new Exception("Impossible to insert pv_utilisation: " . $e->getMessage());
        }    
    }

    public function getNextIDPvUtilsation() {
        $requette = "select nextID('seq_pv_utilisation', 'PU', 10);";
        $reponse = DB::select($requette);
        $id = "";
        if(count($reponse) > 0){
            $id = $reponse[0]->nextid;
        }
        return $id;
    }

    public function get_demande_utilisation() {
        $requette = "select * from pv_utilisation where etat = 40";
        $reponse = DB::select($requette);
        return $reponse;
    }

    public function getImmobilisation(){
        $requette = "select *from immobilisation_reception where id_etat_immobilisation = 4 and libre = 1";
        $reponse = DB::select($requette);
        return $reponse;
    }

    public function update_Pv_Utilisation($id){
        $sql = "update pv_utilisation set etat = 45 where id = '$id'";
        $requette = DB::update($sql);
        return $requette; 
    }
}
