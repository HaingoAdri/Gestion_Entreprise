<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB

use Carbon\Carbon;


class Pv_Reception extends Model {
    public $id;
    public $date;
    public $code;
    public $id_etat_immobilisation;
    public $id_receptionneur;
    public $id_livreur;

    public function __construct($id = "", $date = "", $code = "", $id_etat_immobilisation = 0, $id_receptionneur = "", $id_livreur = "") {
        $this->id = $id;
        $this->date = $date;
        $this->code = $code;
        $this->id_etat_immobilisation = $id_etat_immobilisation;
        $this->id_receptionneur = $id_receptionneur;
        $this->id_livreur = $id_livreur;
    }

    public function insert() {
        try {
            $requete = "insert into pv_reception(id, date, code, id_etat_immobiisation, id_receptionneur, id_livreur) values ('". $this->id."', '". $this->date ."', '". $this->code."', ". $this->id_etat_immobilisation .", '". $this->id_receptionneur. "', ". $this->id_livreur .")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer un pv de reception: ".$e->getMessage());
        }    
    }

    public function getNextSequence() {
        $requette = "select nextSeqNumero()";
        $reponse = DB::select($requette);
        $id = "";
        if(count($reponse) > 0){
            $index = "" . $reponse[0]->nextseqemploye;
            for($i = 0; $i<(3-(strlen($index))); $i++)  {
                $id = $id . "0";
            }
            $id = $id . $index;
        }
        return $id;
    }

    public function codification($lieu, $id_immobilisation){
        $date = Carbon::parse($this->date);
        $month = $date->format('F');
        $year = $date->format('Y');

        $numero = $this->getNextSequence();

        $resultat = $lieu.$month.$year.$id_immobilisation.$numero;

        $this->code = $resultat;
        $this->insert();
    }

}
