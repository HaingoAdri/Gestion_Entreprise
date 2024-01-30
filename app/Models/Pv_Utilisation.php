<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Pv_Utilisation extends Model
{
    public $id;
    public $dates;
    public $reception;
    public $module;

    public function __construct($id="",$dates="",$reception="",$module=""){
        $this->id = $id;
        $this->dates = $dates;
        $this->reception = $reception;
        $this->module = $module;
    }

    public function insert_Pv_utilisation() {
        try {
            $requete = "insert into pv_utilisation(id, date, reception, module) values ('$this->id','".$this->dates."', '".$this->reception."', ".$this->module.") returning id";
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
        $requette = "select * from view_detail_utilisation where etat = 40";
        $reponse = DB::select($requette);
        return $reponse;
    }

    public function getImmobilisationFromPv($pv){
        $requette = "select *from immobilisation_reception where id_pv_reception = '".$pv."'";
        $reponse = DB::select($requette);
        return $reponse;
    }
}
