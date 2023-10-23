<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Note_Cv extends Model {
    public $id;
    public $idCV;
    public $note;

    

    public function insert($idCV,$note) {
        try {
            $requete = "insert into Note_Cv(idCV, note) values (".$idCV.",'".$note."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Note_Cv: ".$e->getMessage());
        }    
    }

    public function getUneDetailNote($idCv) {
        $requette = "select * from Note_Cv where idCv = " . $idCv;
        $reponse = DB::select($requette);
        $Note_Cv = null;
        if(count($reponse) > 0) {
            $Note_Cv = new Note_Cv();
            $Note_Cv->id = $reponse[0]->id;
            $Note_Cv->idCV = $reponse[0]->idCV;
            $Note_Cv->note = $reponse[0]->note;
        }
        return $Note_Cv;
    }
    public function getDetailNote() {
        $requette = "select * from Note_Cv ";
        $reponse = DB::select($requette);
        $Note_Cv = null;
        $table = array();
        if(count($reponse) > 0) {
            foreach($reponse as $rs){
                $Note_Cv = new Note_Cv();
                $Note_Cv->id = $rs->id;
                $Note_Cv->idCV = $rs->idcv;
                $Note_Cv->note = $rs->note;
                $table[] = $Note_Cv;
            }
        }
        return $table;
    }
}
