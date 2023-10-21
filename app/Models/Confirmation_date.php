<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class Confirmation_date extends Model
{
    public $id;
    public $idConge;
    public $depart;
    public $commentaires;

    public $conge;

    public function insertConfirmation_date() {
        try {
            $requete = "insert into confirmation_date(idConge, depart, commentaires) values (".$this->idConge.",'".$this->depart."','".$this->commentaires."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert confirmation date ".$e->getMessage());
        }    
    }

    public function getListeConfirmation_dates() {
        $requette = "select * from confirmation_date";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $confiramtion_date = new Confirmation_date();
                $confiramtion_date->id = $resultat->id;
                $confiramtion_date->idConge = $resultat->idConge;
                $confiramtion_date->depart = $resultat->depart;
                $confiramtion_date->commentaires = $resultat->commentaires;

                $liste[] = $besoin;
            }
        }
        return $liste;
    }

    public function getUneConfirmation_date($id) {
        $requette = "select * from confirmation_date where id = " . $id;
        $reponse = DB::select($requette);
        $confirmation_date = null;
        if(count($reponse) > 0) {
            $confirmation_date = new Confirmation_date();
            $confirmation_date->id = $reponse->id;
            $confirmation_date->idConge = $reponse->idConge;
            $confirmation_date->depart = $reponse->Depart;
            $confirmation_date->commentaires = $reponse->commentaires;
        }
        return $confirmation_date;
    }
}
