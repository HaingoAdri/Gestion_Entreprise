<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

use App\Models\Poste;
use App\Models\Employer;
use App\Models\Historique_embauche;
use App\Models\Afaka_Qcm;
use App\Models\Qcm_Result;
use App\Models\Qcm_Admis;
use App\Models\Note_Cv;
use App\Models\CV;
use App\Models\Besoin;
use App\Models\Diplome;
use App\Models\Situation_Matrimoniale;
use App\Models\Contrat_Essaie;
use App\Models\Proche;
use App\Models\CNAPS;

use Carbon\Carbon;

class Personnel_controller extends Controller
{
    public function index() {
        return view("personnel/fiche_de_poste");
    }

    public function fiche_de_poste(Request $request) {
        $idEmploye = $request->input('idEmploye');
        $employe = (new Employer(id_emp: $idEmploye))->getDonneesEmployer();
        if($employe == null) {
            return redirect()->route('recherche_un_personnel')->with("erreur", "Cette numero de matricule n'existe pas encore");
        }
        $dateDuSysteme = (Carbon::now())->format('Y-m-d');

    //maka an'ilay cv an'ilay olona    
        $historique_embauche = (new Historique_embauche(id_emp: $idEmploye, date: $dateDuSysteme))->getDernier_Entretient_Un_Employer();
        if($historique_embauche == null) {
            return redirect()->route('recherche_un_personnel')->with("erreur", "Ce n'est pas encore un employe");
        }
        $afaka_Qcm = ((new Afaka_Qcm(id_users: $employe->idClient))->getListe_Afaka_Qcm_Un_Employer($historique_embauche->date))[0];
        $qcm_Result = (new Qcm_Result(id_r: $afaka_Qcm->qcm_r))->getUn_Qcm_Result_Par_id();
        $qcm_Admis = (new Qcm_Admis(idqcm: $qcm_Result->qcm))->getUn_Qcm_Admis_par_id(); 
        $cv = (new CV(idClient: $employe->idClient, idBesoin: $qcm_Admis->id_annonce))->getUn_Cv_Par();

        $besoin = (new Besoin())->getUneBesoin($cv->idBesoin);
        $experience  = $cv->experiences;
        $diplome = (new Diplome())->getUneDiplome($cv->idDiplome);
        $situation_Matrimoniale = (new Situation_Matrimoniale())->getUneMatrimoniale($cv->idMatrimoniale);
        $liste_enfants = (new Proche(id_emp: $idEmploye, etat: 4))->getListeProche();

        
        $historique_contrat_essaie = (new Historique_embauche(id_emp: $idEmploye, date: $historique_embauche->date))->getDernier_Contrat_Essaie(">");
        if($historique_contrat_essaie == null) {
            return redirect()->route('recherche_un_personnel')->with("erreur", "Cette employe n'a pas encore un contrat d'essaie");
        }
        $contrat_Essaie = (new Contrat_Essaie(id_emp: $idEmploye, date_debut: $historique_contrat_essaie->date))->getUn_Contrat_Essaie_Un_Employer_Par_Date("=");
        $superieur = "";
        if($contrat_Essaie->superieur != "")  {
            $superieur = (new Employer(id_emp: $contrat_Essaie->superieur))->getDonneesEmployer();
        }
        $fiche = "fiche";     
        return view("personnel/fiche_de_poste", compact("employe", "fiche", "situation_Matrimoniale", "diplome", "experience", "besoin", "contrat_Essaie", "liste_enfants", "superieur"));
    }

    public function listes_personnels() {
        $listeEmployees = (new Employer())->getListe_personnels();
        echo count($listeEmployees);
        $liste = array();
        $dateDuSysteme = (Carbon::now())->format('Y-m-d');
        for($i = 0; $i < count($listeEmployees); $i++) {
            $employe = $listeEmployees[$i];
            $idEmploye = $employe->id_emp;

            $liste[$i]["employe"] = $employe;

            //maka an'ilay cv an'ilay olona    
            $historique_embauche = (new Historique_embauche(id_emp: $idEmploye, date: $dateDuSysteme))->getDernier_Entretient_Un_Employer();
            $afaka_Qcm = ((new Afaka_Qcm(id_users: $employe->idClient))->getListe_Afaka_Qcm_Un_Employer($historique_embauche->date))[0];
            $qcm_Result = (new Qcm_Result(id_r: $afaka_Qcm->qcm_r))->getUn_Qcm_Result_Par_id();
            $qcm_Admis = (new Qcm_Admis(idqcm: $qcm_Result->qcm))->getUn_Qcm_Admis_par_id(); 
            $cv = (new CV(idClient: $employe->idClient, idBesoin: $qcm_Admis->id_annonce))->getUn_Cv_Par();

            $liste[$i]["historique_embauche"] = $historique_embauche;

            $besoin = (new Besoin())->getUneBesoin($cv->idBesoin);
            $experience  = $cv->experiences;
            $liste[$i]["besoin"] = $besoin;

            $dateDeNaissance = $employe->client->date_naissance;
            $dateDeNaissance = Carbon::parse($dateDeNaissance);
            $dateDuSysteme = Carbon::parse($dateDuSysteme);
            $annees = $dateDuSysteme->diffInYears($dateDeNaissance);

            if($annees >= 60) 
                $liste[$i]["retraite"] = "Doit passer en retraite";
            $liste[$i]["retraite"] = "Peut Toujours Travailler";

            if($annees >= 18) 
                $liste[$i]["capacite"] = "Faible";
            $liste[$i]["capacite"] = "Normal";
        }
        return view("personnel/liste_personnels", compact("liste"));
    }

    public function fiche_personnel (Request $request) {
        $idEmploye = $request->input('idEmploye');
        $employe = (new Employer(id_emp: $idEmploye))->getDonneesEmployer();
        $liste_enfants = (new Proche(id_emp: $idEmploye, etat: 4))->getListeProche();
        $pere = (new Proche(id_emp: $idEmploye, etat: 1))->getListeProche();
        $mere = (new Proche(id_emp: $idEmploye, etat: 2))->getListeProche();
        $conjoint = (new Proche(id_emp: $idEmploye, etat: 3))->getListeProche();

        if(count($pere) == 0)
            $pere = null;
        else
            $pere = $pere[0];
            
        if(count($mere) == 0)
            $mere = null;
        else
            $mere = $mere[0];

        if(count($conjoint) == 0)
            $conjoint = null;
        else
            $conjoint = $conjoint[0];
        // var_dump($pere);
        return view("personnel/fiche_perso", compact("employe", "liste_enfants", "mere", "pere", "conjoint"));
    }

    public function debouche (Request $request) {
        $idEmploye = $request->input('idEmploye');
        $employe = (new Employer(id_emp: $idEmploye))->getDonneesEmployer();
        $employe->etat = 10;
        $employe->updateEtat();

        $cnaps = new CNAPS(id_emp: $idEmploye, etat: 7);
        $cnaps->updateEtat();

        $dateDuSysteme = (Carbon::now())->format('Y-m-d');
        $historique_embauche = (new Historique_embauche(id_emp: $idEmploye, date: $dateDuSysteme, etat: 10))->insert();


        return redirect()->route('listes_personnels');
        
    }

    
}
