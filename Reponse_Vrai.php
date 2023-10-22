<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Reponse_Vrai extends Model {
    public $id_r;
    public $id_question;
    public $reponse;
    public $note;

    public function insert($id_question, $reponse) {
        try {
            $requete = "insert into reponse_q (id_r, id_question, reponse) values (default,".$id_question.",'".$reponse."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer reponse vrai: ".$e->getMessage());
        }    
    }

    // public function getReponseQcm($idr) {
    //     $requette = "select * from reponse_q where id_question = " . $idr;
    //     $reponse = DB::select($requette);
    //     $Reponse_Vrai = null;
    //     if(count($reponse) > 0) {
    //         $Reponse_Vrai = new Reponse_Vrai();
    //         $Reponse_Vrai->id_r  = $reponse[0]->id_r;
    //         $Reponse_Vrai->id_question  = $reponse[0]->id_question;
    //         $Reponse_Vrai->reponse  = $reponse[0]->reponse;
    //         $Reponse_Vrai->note  = $reponse[0]->note;
           
    //     }
    //     return $Reponse_Vrai;
    // }

    public function getReponseVraiByQuestion($idqcm){
        $query = "select * from reponse_q where id_question = ? ";
        $reponse = DB::select($query, [$idqcm]);
        return $reponse;
    }
}
