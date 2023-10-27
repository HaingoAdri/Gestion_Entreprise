<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Afaka_Qcm extends Model {
    public $id_as;
    public $qcm_r;
    public $id_users;
    
    
    public function __construct($id_as = "", $qcm_r = "", $id_users = "") {
        $this->id_as = $id_as;
        $this->qcm_r = $qcm_r;
        $this->id_users = $id_users;
        
    }

    public function insert() {
        try {
            $requete = "insert into afaka_qcm(qcm_r, id_users) values (".$this->qcm_r.",".$this->id_users.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer qcm result: ".$e->getMessage());
        }    
    }

    public function getid_usersQcm($iduser) {
        $requette = "select * from afaka_qcm where id_users = " . $iduser;
        $id_users = DB::select($requette);
        $Afaka_Qcm = null;
        if(count($id_users) > 0) {
            $Afaka_Qcm = new Afaka_Qcm();
            $Afaka_Qcm->id_as  = $id_users[0]->id_as;
            $Afaka_Qcm->qcm_r  = $id_users[0]->qcm_r;
            $Afaka_Qcm->id_users  = $id_users[0]->id_users;
          
        }
        return $Afaka_Qcm;
    }

    public function getListeSituation_Matrimoniales() {
        $requette = "select * from Afaka_Qcm";
        $reponse = DB::select($requette);
        return $reponse;
    }

    public function getListe_Afaka_Qcm_Un_Employer($date) {
        $requette = "select * from liste_afaka_qcm where dates <= '". $date ."' and id_users = ". $this->id_users ." order by dates desc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Afaka_Qcm = new Afaka_Qcm();
                $Afaka_Qcm->id_as  = $resultat->id_as;
                $Afaka_Qcm->qcm_r  = $resultat->qcm_r;
                $Afaka_Qcm->id_users  = $resultat->id_users;
                $liste[] = $Afaka_Qcm;
            }
        }
        return $liste;
    }
}
