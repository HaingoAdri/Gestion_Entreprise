<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Employer extends Model {
    public $id_emp;
    public $idClient;
    public $client;
    public $cin;
    public $adresse;
    public $telephone;
    public $etat;

    public function __construct($id_emp = "", $idClient = "", $etat = "") {
        $this->id_emp = $id_emp;
        $this->idClient = $idClient;
        $this->etat = $etat;
    }

    public function insert() {
        try {
            $requete = "insert into employer (id_emp, idClient, etat) values (".$this->id_emp.",".$this->idClient.",'".$this->etat."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Employer: ".$e->getMessage());
        }    
    }

    public function updateEtat() {
        try {
            $requete = "update employer set etat = '".$this->etat."' where id_emp = '".$this->id_emp."'";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Employer: ".$e->getMessage());
        }    
    } 

    public function getEmployerAa($aa) {
        $requette = "select * from employer ";
        $reponse = DB::select($requette);
        $Employer = null;
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Employer = new Employer($resultat->id_emp, $resultat->idclient, $resultat->etat);
            }
        }
        return $Employer;
    }

    public function getListeEmployer_EntretientFini() {
        $requette = "select * from employer where etat = " . $this->etat ." order by id_emp asc";
        $reponse = DB::select($requette);
        $ListeEmployees = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Employer = new Employer($resultat->id_emp, $resultat->idclient, $resultat->etat);
                $Employer->client = (new Client())->getDonneesClient($resultat->idclient);
                $ListeEmployees[] = $Employer;
            }
        }
        return $ListeEmployees;    
    }

    public function ajoutAutreDonnees($cin, $adresse, $telephone) {
        try {
            $requete = "update employer set cin = '". $cin ."', adresse = '". $adresse ."', telephone = '". $telephone ."' where id_emp = '". $this->id_emp ."'";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer le CIN/Adresse/Telephone de cet employe: ".$e->getMessage());
        }    
    }

    public function getDonneesEmployer() {
        $requette = "select * from employer where id_emp = '". $this->id_emp ."'";
        $reponse = DB::select($requette);
        $Employer = null;
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Employer = new Employer($resultat->id_emp, $resultat->idclient, $resultat->etat);
                $Employer->cin = $resultat->cin;
                $Employer->adresse = $resultat->adresse;
                $Employer->telephone = $resultat->telephone;
                $Employer->client = (new Client())->getDonneesClient($resultat->idclient);
                break;
            }
        }
        return $Employer;
    }
}
