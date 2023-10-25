<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Ok_Vita extends Model {
    public $id_o;
    public $id_e;
    public $id_et;

    public function __construct($id_o, $id_e, $id_et) {
        $this->id_o = $id_o;
        $this->id_e = $id_e;
        $this->id_et = $id_et;
    }

    public function insert() {
        try {
            $requete = "insert into ok_vita (id_o, id_e, id_et) values (".$this->id_o.",".$this->id_e.",".$this->id_et.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Ok_Vita: ".$e->getMessage());
        }    
    }

    public function getOk_VitaAa($aa) {
        $requette = "select * from ok_vita ";
        $reponse = DB::select($requette);
        $Ok_Vita = null;
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Ok_Vita = new Ok_Vita();
                $Ok_Vita->id_o  = $resultat->id_o;
                $Ok_Vita->id_e  = $resultat->id_e;
                $Ok_Vita->id_et  = $resultat->id_et;
            }
        }
        return $Ok_Vita;
    }
}
