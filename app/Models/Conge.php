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
        $this->fin = $fin;
        $this->statut = $statut;
        $this->justificatif = $justificatif;
    }

    public function insertConge() {
        try {

            $requete = "insert into conge(id_employer, id_type_conge, raison, debut, fin, statut, justificatif) values ('".$this->id_employer."',".$this->id_type_conge.",'".$this->raison."','".$this->debut."','".$this->fin."',".$this->statut.",'".$this->justificatif."')";
            echo $requete;
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
                $conge->employer = (new Employer(id_emp: $conge->id_employer))->getDonneesEmployer();

                $liste[] = $conge;
            }
        }
        return $liste;
    }

    public function getListeCongesPerEmployer($id_employer) {
        $requette = "select * from conf_conge where statut = 21 and id_employer = '".$id_employer."'";
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
                $conge->employer = (new Employer(id_emp: $conge->id_employer))->getDonneesEmployer();

                $liste[] = $conge;
            }
        }
        return $liste;
    }

    public function getListeCongesEnAttente() {
        $requette = "select * from conge where statut = 1";
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
                $conge->employer = (new Employer(id_emp: $conge->id_employer))->getDonneesEmployer();

                $liste[] = $conge;
            }
        }
        return $liste;
    }

    public function getListeCongesValider() {
        $requette = "select * from conf_conge where statut = 21 and depart is null";
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
                $conge->employer = (new Employer(id_emp: $conge->id_employer))->getDonneesEmployer();

                $liste[] = $conge;
            }
        }
        return $liste;
    }

    public function getListeCongesConfirmerRetour() {
        $requette = "select * from conf_conge where statut = 21 and depart is not null and retour is null";
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
                $conge->employer = (new Employer(id_emp: $conge->id_employer))->getDonneesEmployer();

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

    public function checkIfConge($id_emp){
        $historique_embauche = (new Historique_embauche(id_emp: $id_emp))->getDate_Embauche_Employer();
        // var_dump($historique_embauche);
        $dateEmbauche = $historique_embauche[0]->date;

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

    public function calculAcquis($id_emp){
        $historique_embauche = (new Historique_embauche(id_emp: $id_emp))->getDate_Embauche_Employer();
        // var_dump($historique_embauche);
        $dateEmbauche = $historique_embauche[0]->date;

        // Date de fin des congés
        $dateActuel = Carbon::now();

        // Convertir les dates en instances Carbon
        $carbonDateEmbauche = Carbon::parse($dateEmbauche);
        $carbonDateActuel = Carbon::parse($dateActuel);

        // Calculer la différence en jours
        $monthsDifference = $carbonDateEmbauche->diffInMonths($carbonDateActuel);

        return (2.5 * $monthsDifference);
    }

    public function ifDebutFin($id_emp){
        $requette = "SELECT id_type_conge,COALESCE(EXTRACT(DAY FROM AGE(fin, debut)),0) AS months_difference FROM conf_conge WHERE id_employer = '".$id_emp."'";
        // echo $requette;
        $reponse = DB::select($requette);
        $congePris = 0;

        if(count($reponse) > 0) {
            $congePris = $reponse[0]->months_difference;
            $type_conge = (new Type_Conge())->getUnTypeConge($reponse[0]->id_type_conge);
            if($type_conge->day_default > 0){
                return $congePris;
            }
        }
        return $congePris;
    }

    public function calculCongePris($id_emp){
        $requette = "SELECT id_type_conge,depart,retour,COALESCE(EXTRACT(DAY FROM AGE(retour, depart)),0) AS months_difference FROM conf_conge WHERE id_employer = '".$id_emp."'";
        // echo $requette;
        $reponse = DB::select($requette);
        $congePris = 0;

        if(count($reponse) > 0) {
            if($reponse[0]->depart == '' || $reponse[0]->retour == ''){
                $debutFin = $this->ifDebutFin($id_emp);
                return $debutFin;
            }

            $congePris = $reponse[0]->months_difference;
            $type_conge = (new Type_Conge())->getUnTypeConge($reponse[0]->id_type_conge);
            if($type_conge->day_default > 0){
                return $congePris;
            }
        }
        return $congePris;
    }

    public function calculSolde($id_emp){
        $acquis = $this->calculAcquis($id_emp);
        $pris = $this->calculCongePris($id_emp);
        $resultat = ($acquis - $pris);

        return $resultat;
    }

    public function getIfNegatif($id_emp, $debut, $fin){
        $solde = $this->calculSolde($id_emp);

        $carbonDateDebut = Carbon::parse($debut);
        $carbonDateFin = Carbon::parse($fin);

        // Calculer la différence en jours
        $joursDifference = $carbonDateDebut->diffInDays($carbonDateFin);

        return ($solde - $joursDifference);
    }

    public function getListeConges_un_employe() {
        $requette = " select * from conge where id_employer='$this->id_employer' and statut=21 and debut>='$this->debut' and fin<='$this->fin';";
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
                $conge->employer = (new Employer(id_emp: $conge->id_employer))->getDonneesEmployer();

                $liste[] = $conge;
            }
        }
        return $liste;
    }


}
