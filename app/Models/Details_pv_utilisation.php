<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class Details_pv_utilisation extends Model
{
    public $pv_utilisation;
    public $immobilisation;
    public $description;
    public $etat_immobilisation;

    public function __construct($pv_utilisation="" ,$immobilisation = "", $description = "", $etat_immobilisation = "") {
        $this->pv_utilisation = $pv_utilisation;
        $this->immobilisation = $immobilisation;
        $this->description = $description;
        $this->etat_immobilisation = $etat_immobilisation;
    }

    public function insertDetails_pv_utilisation() {
        try {

            $requete = "insert into details_utilisation(pv_utilisation, immobilisation, description, etat_immobilisation) values ('$this->pv_utilisation','".$this->immobilisation."','".$this->description."', ".$this->etat_immobilisation.")";
            DB::insert($requete);

        } catch (Exception $e) {
            throw new Exception("Impossible to insert Details_pv_utilisation: ".$e->getMessage());
        }    
    }

    public function getListeTypeContrats() {
        $requette = "select * from Detail_utilisation";
        $reponse = DB::select($requette);
        return $reponse;
    }

    public function getUnTypeContrat($pv_utilisation) {
        $requette = "select * from Detail_utilisation where pv_utilisation = " . $pv_utilisation;
        $reponse = DB::select($requette);
        return $reponse;
    }

    public function updateDetails_Utilisation($id){
        $requette = "update details_utilisation set etat = 45 where iddu = '$id'";
        try {
            $reponse = DB::update($requette);
        } catch (Exception $e) {
            throw new Exception("Impossible to update Details_pv_utilisation: ".$e->getMessage());
        } 
    }
}