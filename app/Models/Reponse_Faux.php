<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Reponse_Faux extends Model {
    public $id_f;
    public $id_q;
    public $reponse;
    public $note;
   

    public function insert($id_q, $reponse) {
        try {
            $requete = "insert into reponse_faux(id_f, id_q, reponse_f) values (default,".$id_q.",'".$reponse."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer reponse Faux: ".$e->getMessage());
        }    
    }

    // public function getReponseQcm($idq) {
    //     $requette = "select * from reponse_faux where id_q = " . $idq;
    //     $reponse = DB::select($requette);
    //     $Reponse_Faux = null;
    //     if(count($reponse) > 0) {
    //         $Reponse_Faux = new Reponse_Faux();
    //         $Reponse_Faux->id_f  = $reponse[0]->id_f;
    //         $Reponse_Faux->id_q  = $reponse[0]->id_q;
    //         $Reponse_Faux->reponse  = $reponse[0]->reponse;
    //         $Reponse_Faux->note  = $reponse[0]->note;
           
    //     }
    //     return $Reponse_Faux;
    // }

    public function getReponseFauxByQuestion($idqcm){
        $query = "select * from reponse_faux where id_q = ? ";
        $reponse = DB::select($query, [$idqcm]);
        return $reponse;
    }
}
