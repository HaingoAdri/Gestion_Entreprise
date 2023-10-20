<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Contrat_Essaie extends Model
{
    public $id;
    public $id_emp;
    public $lieu_travail;
    public $date_debut;
    public $date_fin;

    public function __construct($id ="", $id_emp ="",  $lieu_travail = "", $date_debut ="", $date_fin = "") {
        $this->id = $id;
        $this->id_emp = $id_emp;
        $this->lieu_travail = $lieu_travail;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
    }

    public function insert() {
        try {
            $requete = "insert into Contrat_Essaie (id_emp, lieu_travail, date_debut, date_fin) values ('". $this->id_emp ."', '". $this->lieu_travail->id ."', '". $this->date_debut ."', '". $this->date_fin ."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer le contrat d'essaie: ".$e->getMessage());
        }    
    }

    public function getListes_Contrats_A_Renouveler() {
        $requette = "select * from liste_contrat_a_renouveler where date_fin < '".$this->date_fin ."' order by date_fin asc";
        $reponse = DB::select($requette);
        $ListeContrat = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $lieu = new Liste_Adresse_entreprise(id: $resultat->lieu_travail);
                $contrat = new Contrat_Essaie($resultat->id, $resultat->id_emp, $lieu, $resultat->date_debut, $resultat->date_fin);
                $ListeContrat[] = $contrat;
            }
        }
        return $ListeContrat;    
    }



}
