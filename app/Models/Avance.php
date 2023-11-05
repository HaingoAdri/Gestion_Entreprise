<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Avance extends Model
{
    public $id;
    public $id_employe;
    public $avance;
    public $date;

    public function __construct($id = "", $id_employe = "", $avance = "", $date = "") {
        $this->id = $id;
        $this->id_employe = $id_employe;
        $this->avance = $avance;
        $this->date = $date;
    }

    public function insert() {
        try {
            $requete = "insert into avance values (default,'".$this->id_emp."', ".$this->avance.",'".$this->date."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert avance: ".$e->getMessage());
        }    
    }

    public function getSomme_Avance_employe($dateDebut, $dateFin, $id_employer) {
        $requette = "select sum(avance) as somme from avance where date >= '". $dateDebut ."' and date < '".$dateFin."' and idEmployer = '".$id_employer."'";
        $reponse = DB::select($requette);
        $somme = null;
        if(count($reponse) > 0){
            $somme = $reponse[0]->somme;
        }
        return $somme;
    }
}

?>
