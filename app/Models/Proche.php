<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Proche extends Model {
    public $id;
    public $id_emp;
    public $nom;
    public $prenom;
    public $dateDeNaissance;
    public $genre;
    public $etat;

    public function __construct($id = "", $id_emp = "", $nom = "", $prenom = "", $dateDeNaissance = "", $genre = "", $etat = "") {
        $this->id = $id;
        $this->id_emp = $id_emp;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateDeNaissance = $dateDeNaissance;
        $this->genre = $genre;
        $this->etat = $etat;
    }

    public function insert() {
        try {
            $requete = "insert into proche(id_emp, nom, prenom, datedenaissance, idgenre, etat) values ('". $this->id_emp."', '". $this->nom ."', '". $this->prenom ."', '". $this->dateDeNaissance ."', ". $this->genre->id. ", ". $this->etat .")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer un proche: ".$e->getMessage());
        }    
    }

    public function getListeProche() {
        $requette = "select * from proche where id_emp = '".$this->id_emp ."'";
        if($this->etat != "")
            $requette = "select * from proche where id_emp = '".$this->id_emp ."' and etat = ".$this->etat;
        $reponse = DB::select($requette);
        $ListeFamille = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $genre = new Genre($resultat->idgenre);
                $proche = new Proche($resultat->id, $resultat->id_emp, $resultat->nom, $resultat->prenom, $resultat->datedenaissance, $genre, $resultat->etat);
                $ListeFamille[] = $proche;
            }
        }
        return $ListeFamille;    
    }
}
