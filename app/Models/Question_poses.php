<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Question_poses extends Model {
    public $id_q;
    public $questions;
    public $note;
    public $id_qcm;
    
    public function insert($questions, $id_qcm) {
        try {
            $requete = "insert into question_posee values (default,'".$questions."',".$id_qcm.");";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer question qcm: ".$e->getMessage());
        }    
    }

    // public function getQcm($idqcm) {
    //     $requette = "select * from question_posee where id_qcm = " . $idqcm;
    //     $reponse = DB::select($requette);
    //     $Question_poses = null;
    //     if(count($reponse) > 0) {
    //         // $Question_poses = new Question_poses();
    //         // $Question_poses->id_q  = $reponse[0]->id_q;
    //         // $Question_poses->questions  = $reponse[0]->questions;
    //         // $Question_poses->note  = $reponse[0]->note;
    //         // $Question_poses->id_qcm  = $reponse[0]->id_qcm;
           
    //     }
    //     return $Question_poses;
    // }

    public function getQcmByQcmId($idqcm){
        $query = "select * from question_posee where id_qcm = ? ";
        $reponse = DB::select($query, [$idqcm]);
        return $reponse;
    }
}
