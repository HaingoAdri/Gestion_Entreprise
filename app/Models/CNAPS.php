<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class CNAPS extends Model
{
    public $id;
    public $id_emp;
    public $date;
    public $etat;

    public function __construct($id = "", $id_emp = "", $date = "", $etat = "") {
        $this->id = $id;
        $this->id_emp = $id_emp;
        $this->date = $date;
        $this->etat = $etat;
    }

    public function insert() {
        try {
            $requete = "insert into cnaps values ('".$this->id."','".$this->id_emp."', '".$this->date."', ".$this->etat.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert client: ".$e->getMessage());
        }    
    }

    public function updateEtat() {
        try {
            $requete = "update cnaps set etat = $this->etat where id_emp = '$this->id_emp'";
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
        $requette = "select * from cnaps where id_emp = '". $this->id_emp ."' and etat = 8";
        $reponse = DB::select($requette);
        $cnaps = null;
        if(count($reponse) > 0){
            $cnaps = new CNAPS($reponse[0]->id, $reponse[0]->id_emp, $reponse[0]->date, 8);
        }
        return $cnaps;
    }

    public function getDernier_Retenu_CNAPS() {
        $requette = "select * from retenu_cnaps where date <= '". $this->date ."'";
        $reponse = DB::select($requette);
        $retenu = 0;
        if(count($reponse) > 0){
            $retenu = $reponse[0]->plafond;
        }
        return $retenu;   
    }

    public function getRetenu_CNAPS_Un_Employe($salaire_brut) {
        $retenu = $this->getDernier_Retenu_CNAPS();
        $retenu_cnaps = $salaire_brut * (1/100);
        if($retenu_cnaps > $retenu)
            $retenu_cnaps = $retenu;
        return $retenu_cnaps;
    }
}
