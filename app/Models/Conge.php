<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;

class Conge extends Model
{
    public $id;
    public $id_employer;
    public $id_type_conge;
    public $raison;
    public $debut;
    public $fin;
    public $statut; // -- 1: en attente, 21: approuve, 41: refuse
    public $justificatif;

    public $nomStatut;
    public $employer;
    public $type_conge;

    public function __construct($id_employer = "", $id_type_conge = "", $raison = "", $debut = "", $fin = "", $statut = "", $justificatif = "") {
        $this->id_employer = $id_employer;
        $this->id_type_conge = $id_type_conge;
        $this->raison = $raison;
        $this->debut = $debut;
        $this->fin = fin;
        $this->statut = $statut;
        $this->justificatif = $justificatif;
    }

    public function insertConge() {
        try {

            $requete = "insert into conge(id_employer, id_type_conge, raison, debut, fin, statut, justificatif) values (".$this->id_employer.",".$this->id_type_conge.",'".$this->debut."','".$this->fin."',".$this->Statut.",'".$this->justificatif."')";
            DB::insert($requete);

        } catch (Exception $e) {
            throw new Exception("Impossible to insert Conge: ".$e->getMessage());
        }    
    }

    public function updateStatutConge($id, $statut) {
        try {

            $requete = "update conge set statut = ".$statut." where id = ".$id;
            DB::insert($requete);

        } catch (Exception $e) {
            throw new Exception("Impossible to update conge : ".$e->getMessage());
        }    
    }

    public function defineStatut($statut){
        $nomStatut = null;
        if($statut == 1){
            $nomStatut = "En attente";
        }elseif($statut == 21){
            $nomStatut = "Approuvee";
        }elseif($statut == 41){
            $nomStatut = "Refuse";
        }

        return $nomStatut;
    }

    public function getListeConges() {
        $requette = "select * from conge";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $conge = new Conge();
                $conge->id = $resultat->id;
                $conge->id_employer = $resultat->id_employer;
                $conge->id_type_conge = $resultat->id_type_conge;
                $conge->raison = $resultat->raison;
                $conge->debut = $resultat->debut;
                $conge->fin = $resultat->fin;
                $conge->statut = $resultat->statut;
                $conge->justificatif = $resultat->justificatif;

                $conge->nomStatut = $this->defineStatut($resultat->statut);
                $conge->type_conge = (new Type_Conge())->getUnTypeConge($resultat->id_type_conge);

                $liste[] = $conge;
            }
        }
        return $liste;
    }

    public function getUnConge($id) {
        $requette = "select * from conge where id = " . $id;
        $reponse = DB::select($requette);
        $conge = null;
        if(count($reponse) > 0) {
            $conge = new Conge();
            $conge->id = $reponse->id;
            $conge->idPoste = $reponse->idPoste;
            $conge->conge_horaire = $reponse->conge_horaire;
            $conge->heure_jour_homme = $reponse->heure_jour_homme;
            $conge->description = $reponse->description;
        }
        return $conge;
    }

    public function checkIfConge($id){
        $dateEmbauche = '2022-01-15';

        // Date de fin des congés
        $dateActuel = Carbon::now();

        // Convertir les dates en instances Carbon
        $carbonDateEmbauche = Carbon::parse($dateEmbauche);
        $carbonDateActuel = Carbon::parse($dateActuel);

        // Calculer la différence en jours
        $joursDifference = $carbonDateEmbauche->diffInDays($carbonDateActuel);

        // Vérifier si l'employé est éligible pour des congés d'au moins 1 an et 1 jour
        if ($joursDifference >= 366) {
            // L'employé est éligible pour des congés d'au moins 1 an et 1 jour
            echo "L'employé est éligible pour des congés d'au moins 1 an et 1 jour.";
            return 100;
        } else {
            // L'employé n'est pas éligible pour des congés d'au moins 1 an et 1 jour
            echo "L'employé n'est pas éligible pour des congés d'au moins 1 an et 1 jour.";
        }

        return 0;
    }
}
