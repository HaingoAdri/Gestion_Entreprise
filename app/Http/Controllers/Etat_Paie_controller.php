<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

use App\Models\Pointage;
use App\Models\Historique_embauche;
use App\Models\Salaire;
use App\Models\Conge;
use App\Models\Majoration_nuit;
use App\Models\Prime;
use App\Models\Employer;
use App\Models\Afaka_Qcm;
use App\Models\Qcm_Result;
use App\Models\Qcm_Admis;
use App\Models\CV;
use App\Models\Besoin;
use App\Models\CNAPS;
use App\Models\Tranche_IRSA;
use App\Models\Avantage_nature;
use App\Models\Proche;
use App\Models\Impot;
use App\Models\Avance;

use Carbon\Carbon;

class Etat_Paie_controller extends Controller
{
    public function voir_etat_de_paie() {
        return view("paie/cherche_etat_de_paie");
    }

    public function etat_de_paie($dateDebut, $dateFin, $idEmploye) {

        $employe = (new Employer(id_emp: $idEmploye))->getDonneesEmployer();
        $salaire = (new Salaire(id_emp: $idEmploye, date: $dateDebut))->getSalaireEmploye();
        $taux_journaliers = ($salaire->brut / 30);
        $taux_horaires = ($salaire->brut / 173.33);
        $indice = ($taux_horaires / 1334);

        $liste_avanatge_nature = (new Avantage_nature(id_emp: $idEmploye, date: $dateFin, etat: 8))->getListeAvanatge();
        $avantage_en_nature = "";
        for($i=0; $i<count($liste_avanatge_nature); $i++) {
            if($i == 0) 
                $avantage_en_nature = $liste_avanatge_nature[$i]->avantage->type;
            else
                $avantage_en_nature = $avantage_en_nature ." | ".$liste_avanatge_nature[$i]->avantage->type;
        }

        $historique = new Historique_embauche(id_emp: $idEmploye, date: $dateFin);
        $anciennete = $historique->getPremier_Entretient_Un_Employer();

        $historique_embauche = $historique->getDernier_Entretient_Un_Employer();
        // var_dump($historique_embauche);
        $afaka_Qcm = ((new Afaka_Qcm(id_users: $employe->idClient))->getListe_Afaka_Qcm_Un_Employer($historique_embauche->date))[0];
        $qcm_Result = (new Qcm_Result(id_r: $afaka_Qcm->qcm_r))->getUn_Qcm_Result_Par_id();
        $qcm_Admis = (new Qcm_Admis(idqcm: $qcm_Result->qcm))->getUn_Qcm_Admis_par_id(); 
        $cv = (new CV(idClient: $employe->idClient, idBesoin: $qcm_Admis->id_annonce))->getUn_Cv_Par();
        $besoin = (new Besoin())->getUneBesoin($cv->idBesoin);
        
        
        $liste_pointage_jours = (new Pointage(id_employer: $idEmploye, jour_nuit: 25))->getListe_Pointages_Un_Employe($dateDebut, $dateFin);
        $liste_pointage_nuit = (new Pointage(id_employer: $idEmploye, jour_nuit: 55))->getListe_Pointages_Un_Employe($dateDebut, $dateFin);
        
        $historique_embauche = (new Historique_embauche(id_emp: $idEmploye, date: $dateDebut))->getDernier_Entretient_Un_Employer();
        $liste_conge = (new Conge(id_employer: $idEmploye, debut: $dateDebut, fin: $dateFin))->getListeConges_un_employe();
        
        $conges = $this->calcul_heures_jours_conges($liste_conge);

        $dateDebut = Carbon::parse($dateDebut);
        $dateFin = Carbon::parse($dateFin);
        $nombreDeJours = $dateDebut->diffInDays($dateFin) + 1;
        $weekends = $this->getNombreWeekends($dateDebut->copy(), $dateFin->copy());
        $jours_travail = $nombreDeJours - $weekends;

        $jours = $this->calcul_heures_jours_pointage($liste_pointage_jours, $jours_travail, 1);
        $nuits = $this->calcul_heures_jours_pointage($liste_pointage_nuit, $jours_travail, 2);

        $absence = $jours[0]["jours_absence"] - $conges["jours_conge"];
        $heure_conge = $conges["heure_conge"] - ($conges["jours_conge"]*9); 

        $salaire_brut = 0;

        $absences = array();
        $absences["heures"] = ($absence * 9);
        $absences["prix"] = ($absence * 9 * $taux_horaires);

        // echo $absences["heures"]." >>>>>>>>>>>>>>>>>> ";

        $presences = array();
        $presences["presence_jours"] = $jours[0]["presence_jours"];
        $presences["heures"] = $jours[0]["heures_jours"];
        $presences["prix"] = ($jours[0]["heures_jours"] * $taux_horaires);
        $salaire_brut += $presences["prix"];

        $conges = array();
        $conges["heures"] = $heure_conge;
        $conges["prix"] = ($heure_conge * $taux_horaires);
        $salaire_brut += $conges["prix"];

        $heures_sup_jours = array();
        $heure_sup = $jours[1]["heures_sup"];
        if($heure_sup < 8) {
            $heures_sup_jours["heures"][0] = $heure_sup;
            $heures_sup_jours["heures"][1] = 0;
            $heures_sup_jours["taux"][0] = $heure_sup * ($taux_horaires * 1.3);
            $heures_sup_jours["taux"][1] = 0;
        } else {
            $heures_sup_jours["heures"][0] = 7;
            $heures_sup_jours["heures"][1] = ($heure_sup - 7);
            $heures_sup_jours["taux"][0] = 7 * ($taux_horaires * 1.3);
            $heures_sup_jours["taux"][1] = ($heure_sup - 7) * ($taux_horaires * 1.4);;
        }
        $salaire_brut += $heures_sup_jours["taux"][0] + $heures_sup_jours["taux"][1];

        $majoration = array();
        $majoration["30"] = $taux_horaires * 1.3;
        $majoration["40"] = $taux_horaires * 1.4;

        $majoration_nuit = (new Majoration_nuit(date: $dateFin))->getTauxMajoration($nuits[0]["heures_jours"], $taux_horaires);
        $salaire_brut += $majoration_nuit[count($majoration_nuit)-1]["somme"];

        $prime = array();
        $prime["rendement"] = (new Prime(id: 1, id_employe: $idEmploye))->getUn_Prime_Employe($dateDebut, $dateFin);
        $prime["anciennete"] = (new Prime(id: 2, id_employe: $idEmploye))->getUn_Prime_Employe($dateDebut, $dateFin);
        $prime["divers"] = (new Prime(id: 3, id_employe: $idEmploye))->getUn_Prime_Employe($dateDebut, $dateFin);
        $prime["somme"] = $prime["rendement"]->montant + $prime["anciennete"]->montant + $prime["divers"]->montant;
        $salaire_brut += $prime["somme"];

        $retenu_cnaps = (new CNAPS(date: $dateFin))->getRetenu_CNAPS_Un_Employe($salaire_brut);
        $retenu_sanitaire = $salaire_brut * (1/100);

        $montant_imposable = ($salaire_brut - $retenu_cnaps - $retenu_sanitaire);

        $cnaps = new Tranche_IRSA(date: $dateFin);
        $liste_tranche = $cnaps->getListeTranche_IRSA();
        $liste_Tranche_IRSA = $cnaps->getTranche_IRSA_Un_Employe($salaire_brut, $montant_imposable);
        $total_retenu = $retenu_cnaps + $retenu_sanitaire + $liste_Tranche_IRSA[count($liste_Tranche_IRSA)-1]["somme"];

        $net_a_payer = $salaire_brut - $total_retenu;

        // $indice = number_format($indice, 3);
        // $salaire->brut = number_format($salaire->brut, 3);
        // $salaire->net = number_format($salaire->net, 3);
        // $taux_journaliers = number_format($taux_journaliers, 3);
        // $taux_horaires = number_format($taux_horaires, 3);

        $liste_enfants = (new Proche(id_emp: $idEmploye, etat: 4))->getListeProche();
        $avance = (new Avance())->getSomme_Avance_employe($dateDebut, $dateFin, $employe->id_emp);

        $table = array();
        $table["dateDebut"] = $dateDebut;
        $table["dateFin"] = $dateFin;
        $table["employe"] = $employe;
        $table["besoin"] = $besoin;
        $table["anciennete"] = $anciennete;
        $table["historique_embauche"] = $historique_embauche;
        $table["indice"] = $indice;
        $table["salaire"] = $salaire;
        // $table["taux_journaliers"] = $taux_journaliers;
        // $table["taux_horaires"] = $taux_horaires;
        // $table["majoration"] = $majoration;
        $table["heures_sup_jours"] = $heures_sup_jours;
        $table["conges"] = $conges;
        $table["presences"] = $presences;
        $table["absences"] = $absences;
        $table["retenu_absence"] = $absences["prix"];
        // $table["prime"] = $prime;
        $table["majoration_nuit"] = $majoration_nuit;


        $table["salaire_base"] = $salaire->brut;
        $table["salaire_base_mois"] = $table["salaire_base"] - $table["retenu_absence"];
        $table["salaire_brut"] = $table["salaire_base_mois"] - $table["heures_sup_jours"]["taux"][0];


        $table["retenu_cnaps"] = $retenu_cnaps;
        $table["retenu_sanitaire"] = $retenu_sanitaire;
        
        // $table["liste_Tranche_IRSA"] = $liste_Tranche_IRSA;
        $table["total_retenu"] = $total_retenu;
        // $table["liste_tranche"] = $liste_tranche;
        // $table["avantage_en_nature"] = $avantage_en_nature;
        $table["liste_enfants"] = $liste_enfants;
        $table["montant_enfant_charge"] = (count($liste_enfants))*2000;

        $table["retenu_1%_CNAPS"] = (new CNAPS(date: $dateFin))->getRetenu_CNAPS_Un_Employe($salaire_brut);

        $table["montant_imposable"] = $table["salaire_brut"] - $table["retenu_1%_CNAPS"] - $table["retenu_sanitaire"];

        $table["impot"] = (new Impot())->getImpot_Du($table["salaire_brut"]);
        $table["IGR_Net"] = ($table["impot"] - $table["montant_enfant_charge"]);
        $table["total_retenues"] = ($table["retenu_1%_CNAPS"])+($retenu_sanitaire)+($table["IGR_Net"]);
        $table["salaire_net"] = $table["salaire_brut"] - $table["total_retenues"];
        $table["avance"] = $avance;
        $table["net_a_payer"] = $table["salaire_net"] - $avance;

        // echo( " >>>>> salaire brut: ".$table["salaire_brut"]);
        // echo( " >>>>> cnaps 1%: ".$table["retenu_1%_CNAPS"]);
        // echo( " >>>>> ostie 1%: ".$table["retenu_sanitaire"]);
        // echo( " >>>>> montant: ".$table["montant_imposable"]);
        return $table;
    }

    public function sommeTotal($listesEtats){
        $table = array();

        $table["total_salaire_base"] =  0;
        $table["total_salaire_base_mois"] =  0;
        $table["total_heure_sup_maj"] =  0;
        $table["total_cnaps_1"] = 0;
        $table["total_ostie_1"] = 0; 
        $table["total_revenue_imposable"] = 0;
        $table["total_impot_du"] = 0;
        $table["total_montant_enfant"] = 0;
        $table["total_IGR_Net"] = 0; 
        $table["total_salaire_net"] = 0; 
        $table["total_net_a_payer"] = 0; 
        $table["total_net_du_mois"] = 0;
        $table["total_retenu_absence"] = 0;
        $table["total_salaire_brut"] = 0;
        $table["total_avance"] = 0;
        $table["total_total_retenues"] = 0;

        for($i=0 ; $i<count($listesEtats) ; $i++ ){
            $table["total_salaire_base"] +=  $listesEtats[$i]["salaire_base"];
            $table["total_salaire_base_mois"] +=  $listesEtats[$i]["salaire_base_mois"];
            $table["total_heure_sup_maj"] +=  $listesEtats[$i]["heures_sup_jours"]["taux"][0];
            $table["total_cnaps_1"] += $listesEtats[$i]["retenu_1%_CNAPS"];
            $table["total_ostie_1"] += $listesEtats[$i]["retenu_sanitaire"]; 
            $table["total_revenue_imposable"] += $listesEtats[$i]["montant_imposable"]; 
            $table["total_impot_du"] += $listesEtats[$i]["impot"];
            $table["total_montant_enfant"] += $listesEtats[$i]["montant_enfant_charge"];
            $table["total_IGR_Net"] += $listesEtats[$i]["IGR_Net"]; 
            $table["total_salaire_net"] += $listesEtats[$i]["salaire_net"]; 
            $table["total_net_a_payer"] += $listesEtats[$i]["net_a_payer"]; 
            $table["total_net_du_mois"] += $listesEtats[$i]["net_a_payer"];
            $table["total_retenu_absence"] += $listesEtats[$i]["retenu_absence"];
            $table["total_salaire_brut"] += $listesEtats[$i]["salaire_brut"];
            $table["total_avance"] += $listesEtats[$i]["avance"];
            $table["total_total_retenues"] += $listesEtats[$i]["total_retenues"];
        }

        return $table;
    }

    public function listes_etat_de_paie(Request $request){
        $listesEtats = array();
        $dateDebut = $request->input('dateDebut');
        $dateFin = $request->input('dateFin');

        $listes_employer = (new Employer())->getListe_personnels();

        for ($i=0; $i < count($listes_employer); $i++) { 
            $listesEtats[$i] = $this->etat_de_paie($dateDebut, $dateFin, $listes_employer[$i]->id_emp);
            // echo ($listesEtats[$i]["employe"]->id_emp);
        }

        $total = $this->sommeTotal($listesEtats);

        return view("paie/etat_de_paie", compact("listesEtats","dateDebut","dateFin","total"));

    }

    public function calcul_heures_jours_pointage($liste_pointage, $jours_travail, $etat) {
        $presence_jours = 0;
        $jours_sup = 0;
        $heures_jours = 0;
        $heures_sup = 0;
        for($i = 0; $i <count($liste_pointage); $i+=2) {
            $date_jour = Carbon::parse($liste_pointage[$i]->date); 
            $debut = Carbon::parse($liste_pointage[$i+1]->date);
            $fin = Carbon::parse($liste_pointage[$i]->date);
            $heure = ($debut->diff($fin))->h;
            if($etat == 1) {
                if($date_jour->isWeekend()) {
                    $jours_sup ++;
                    $heures_sup += $heure;
                    // echo "week: ". $liste_pointage[$i+1]->date. " a ". $liste_pointage[$i]->date ." ==> heures: ". $heure ."<br>";
                }
                else {
                    $presence_jours ++;
                    $heures_jours += $heure; 
                    // echo "jour: ". $liste_pointage[$i+1]->date. " a ". $liste_pointage[$i]->date ." ==> heures: ". $heure ."<br>";
                }
            } else {
                $presence_jours ++;
                $heures_jours += $heure;
                // echo "nuit: ". $liste_pointage[$i+1]->date. " a ". $liste_pointage[$i]->date ." ==> heures: ". $heure ."<br>";
            }
        }

        $tab = array();
        $tab[0]["presence_jours"] = $presence_jours;
        $tab[0]["heures_jours"] = $heures_jours;
        if($etat == 1) {
            $jours_absence = $jours_travail - $presence_jours;
            $tab[0]["jours_absence"] = $jours_absence;
            $tab[1]["jours_sup"] = $jours_sup;
            $tab[1]["heures_sup"] = $heures_sup;
        }
        return $tab;
    }

    public function calcul_heures_jours_conges($liste_conge) {
        $heure_conge = 0;
        $jours_conge = 0;
        for($i=0; $i<count($liste_conge); $i++) {
            $debut = Carbon::parse($liste_conge[$i]->debut);
            $fin = Carbon::parse($liste_conge[$i]->fin);
            $diffHeure = ($debut->diffInHours($fin));
            $days = ($debut->diffInDays($fin));
            if($days == 0) {
                $heure_conge += $diffHeure;
                if($diffHeure == 9)
                    $jours_conge ++;

            } else {
                while ($debut < $fin) {
                    if (!$debut->isWeekend()) {
                        $arina = $debut->copy()->addDay();
                        if ($arina > $fin) {
                            $arina = $fin;
                        }
                        $diffHeure = $debut->floatDiffInHours($arina);
                        if($diffHeure == 24) {
                            $diffHeure = 9;
                            $jours_conge ++;
                        } else if($diffHeure == 9) {
                            $jours_conge ++;
                        }
                        $heure_conge += $diffHeure;
                    }
                    $debut->addDay();
                }
            }
        }
        $tab = array();
        $tab["heure_conge"] = $heure_conge;
        $tab["jours_conge"] = $jours_conge;
        return $tab;
    }

    function getNombreWeekends($dateDebut, $dateFin) {
        $nombreDeWeekends = 0;
        while ($dateDebut <= $dateFin) {
            if ($dateDebut->isWeekend()) {
                $nombreDeWeekends++;
            }
            $dateDebut->addDay(); // Passez au jour suivant
        }
        return $nombreDeWeekends;
    }

}
