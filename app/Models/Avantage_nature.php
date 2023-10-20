<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Avantage_nature extends Model {
    public $id;
    public $id_emp;
    public $avantage;
    public $date;
    public $etat;

    public function __construct($id = "", $id_emp = "", $avantage = "", $date = "", $etat = "") {
        $this->id = $id;
        $this->id_emp = $id_emp;
        $this->avantage = $avantage;
        $this->date = $date;
        $this->etat = $etat;
    }

    public function insert() {
        try {
            $requete = "insert into Avantage_nature (id_emp, idavantage, date, etat) values ('". $this->id_emp."', ". $this->avantage->id.", '". $this->date ."', ". $this->etat .")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Etats: ".$e->getMessage());
        }    
    }

    public function getListeAvanatge() {
        $requette = "select * from Avantage_nature where id_emp = '". $this->id_emp ."' and etat = " . $this.etat . " order by date desc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $type_avantage = (new Type_avantage_nature(id: $resultat->idavantage))->getDonneesTypeAvantage();
                $avanatage = new Avantage_nature($resultat->id, $resultat->id_emp, $type_avantage, $resultat->date, $resultat->etat);
                $liste[] = $avanatage;                
            }
        }
        return $liste;
    }
}
