<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class CNAPS extends Model
{
    public $id;
    public $employe;
    public $date;
    public $etat;

    public function __construct($id = "", $employe = "", $date = "", $etat = "") {
        $this->id = $id;
        $this->employe = $employe;
        $this->date = $date;
        $this->etat = $etat;
    }

    public function insert() {
        try {
            $requete = "insert into cnaps values ('".$this->id."','".$this->employe->id_emp."', '".$this->date."', ".$this->etat.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert client: ".$e->getMessage());
        }    
    }

    public function getNextId() {
        $requette = "select nextSeqCnaps()";
        $reponse = DB::select($requette);
        $id = "CNP";
        if(count($reponse) > 0){
            $index = "" . $reponse[0]->nextseqcnaps;
            for($i = 0; $i<(10-(strlen($index)+3)); $i++)  {
                $id = $id . "0";
            }
            $id = $id . $index;
        }
        return $id;
    }

    public function getDonnees_Cnaps_Un_Employer() {
        $requette = "select * from cmaps where id_emp = '". $employe->id_emp ."' and etat = 8";
        $reponse = DB::select($requette);
        $cnaps = null;
        if(count($reponse) > 0){
            $employe = (new Employer(id_emp: $reponse[0]->id_emp))->getDonneesEmployer();
            $cnaps = new CNAPS($reponse[0]->id, $employe, $reponse[0]->date, 8);
        }
        return $cnaps;
    }
}
