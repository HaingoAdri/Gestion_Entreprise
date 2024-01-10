<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class Finance extends Model
{
    public $id;
    public $idCompte;
    public $entre;
    public $sortie;
    public $explication;
    public $date;

    public $reste;
    public $compte;
    public $total;

    public function __construct($id = "", $idCompte = "", $entre = 0, $sortie = 0, $explication = "", $date = "") {
        $this->id = $id;
        $this->idCompte = $idCompte;
        $this->entre = $entre;
        $this->sortie = $sortie;
        $this->explication = $explication;
        $this->date = $date;
    }

    public function insert() {
        try {
            $requete = "insert into finance(idCompte, entre, sortie, explication, date) values ('$this->idCompte', $this->entre, $this->sortie, '$this->explication', '$this->date')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert finance: ".$e->getMessage());
        }    
    }

    public function getReste() {
        $requette =  "select idCompte, sum(entre) entre, sum(sortie) sortie, sum(entre)-sum(sortie) as reste from finance where date <= '$this->date' and idCompte = '$this->idCompte' group by idCompte";
        $reponse = DB::select($requette);
        $reste = 0;
        if(count($reponse) > 0){
            $reste = $reponse[0]->reste;
        }
        return $reste;
    }

    public function checkArgentDisponisble() {
        $this->reste = $this->getReste();
        if($this->reste >= $this->sortie)
            return true;
        return false;
    }

    public function getListeResteEnCompte() {
        $requette =  "select * from reste_argents_avec_nom_compte order by idCompte";
        $reponse = DB::select($requette);
        $liste = array();
        $total = 0;
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $compte = new Finance(idCompte: $resultat->idcompte);
                $compte->nom = $resultat->nom;
                $compte->reste = $resultat->reste;
                $total += $compte->reste;
                $liste[] = $compte;
            }
        }
        $this->total = $total;
        return $liste;
    }
}
