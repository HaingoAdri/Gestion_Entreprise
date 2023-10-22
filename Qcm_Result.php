<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Qcm_Result extends Model {
    public $id_r;
    public $qcm;
    public $notes_r;
    

    public function __construct($id_r, $qcm, $notes_r) {
        $this->id_r = $id_r;
        $this->qcm = $qcm;
        $this->notes_r = $notes_r;
       
    }

    public function insert() {
        try {
            $requete = "insert into qcm_result(id_r, qcm, notes_r) values (".$this->id_r.",".$this->qcm.",".$this->notes_r.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer question qcm result: ".$e->getMessage());
        }    
    }

    public function getQcmResult($idqcm) {
        $requette = "select * from qcm_result where qcm = " . $idqcm;
        $reponse = DB::select($requette);
        $Qcm_Result = null;
        if(count($reponse) > 0) {
            $Qcm_Result = new Qcm_Result();
            $Qcm_Result->id_r  = $reponse[0]->id_r;
            $Qcm_Result->qcm  = $reponse[0]->qcm;
            $Qcm_Result->notes_r  = $reponse[0]->notes_r;    
        }
        return $Qcm_Result;
    }
}
