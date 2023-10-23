<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Qcm_Result extends Model {
    public $id_r;
    public $qcm;
    public $notes_r;
    

    public function insert($qcm,$notes_r) {
        try {
            $requete = "insert into qcm_result(id_r, qcm, notes_r) values (default,".$qcm.",".$notes_r.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer question qcm result: ".$e->getMessage());
        }    
    }

    public function getQcmResult($idqcm) {
        $requette = "select * from qcm_result where qcm = ? ";
        $reponse = DB::select($requette, [$idqcm]);
        return $reponse;
    }

    public function allResult(){
        $requete = "select * from qcm_result";
        $reponse = DB::select($requete);
        return $reponse;
    }
}
