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
    public $id_type_ammortissement;
    public $taux;
    public $id_receptionneur;
    public $id_livreur;
    public $id_bon_commande;

    public $nom_ammortissement;

    public function __construct($id = "", $date = "", $code = "", $id_etat_immobilisation = 0, $id_type_ammortissement = 0, $taux = 0, $id_receptionneur = "", $id_livreur = "", $id_bon_commande = "") {
        $this->id = $id;
        $this->date = $date;
        $this->code = $code;
        $this->id_etat_immobilisation = $id_etat_immobilisation;
        $this->id_type_ammortissement = $id_type_ammortissement;
        $this->taux = $taux;
        $this->id_receptionneur = $id_receptionneur;
        $this->id_livreur = $id_livreur;
        $this->id_bon_commande = $id_bon_commande;
    }

    public function insert() {
        try {
            $requete = "insert into pv_reception(id, date, code, id_etat_immobilisation, id_type_ammortissement, taux, id_receptionneur, id_livreur, id_bon_commande) values ('". $this->id."', '". $this->date ."', '". $this->code."', ". $this->id_etat_immobilisation .", ".$this->id_type_ammortissement.", ".$this->taux.", '". $this->id_receptionneur. "', ". $this->id_livreur .",'".$this->id_bon_commande."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer un pv de reception: ".$e->getMessage());
        }    
    }

    public function getNextIDPvReception() {
        $requette = "select nextID('seqPvReception', 'PR', 10);";
        $reponse = DB::select($requette);
        $id = "";
        if(count($reponse) > 0){
            $id = $reponse[0]->nextid;
        }
        return $id;
    }

    public function toUpperCase($mot){
        return strtoupper($mot);
    }

    public function getFirstLetter($mot){
        $upper = $this->toUpperCase($mot);
        return substr($upper, 0, 3);
    }

    public function getListeTypeAmmortissement() {
        $requette = "select * from type_ammortissement order by id";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $ammortissement = new Pv_Reception(id_type_ammortissement: $resultat->id);
                $ammortissement->nom_ammortissement = $resultat->nom;
                $liste[] = $ammortissement;
            }
        }
        return $liste;
    }


    public function getNextSequence() {
        $requette = "select nextSeqNumero()";
        $reponse = DB::select($requette);
        $id = "";
        if(count($reponse) > 0){
            $index = "" . $reponse[0]->nextseqnumero;
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

        $resultat = $lieu.$this->getFirstLetter($month).$year.$id_immobilisation.$numero;

        $this->code = $resultat;
        $this->id = $this->getNextIDPvReception();
        $this->insert();

        return $this->id;
    }

}
