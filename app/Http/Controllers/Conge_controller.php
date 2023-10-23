<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Poste;
use App\Models\Client;
use App\Models\Type_Conge;
use App\Models\Conge;
use App\Models\Confirmation_date;
use App\Models\Contrat_Essaie;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;

class Conge_controller extends Controller
{

    // INDEX
    public function index_employe() {
        $id_employer = Session::get("employer")->id_emp;

        $listeTypeConges = (new Type_Conge())->getListeTypeConges();
        $congeAcquis = (new Conge())->calculAcquis($id_employer);
        $congePris = (new Conge())->calculCongePris($id_employer);
        $congeSolde = (new Conge())->calculSolde($id_employer);
        $congeEmployer = (new Conge())->getListeCongesPerEmployer($id_employer);
        $subordonnees = (new Contrat_Essaie())->getEmployer_subordonnees($id_employer);

        return view("client_conge/demande_conge", compact("listeTypeConges", "congeAcquis", "congePris", "congeSolde", "congeEmployer","subordonnees"));
    }

    public function index_accueil_conge() {
        $listeTypeConges = (new Type_Conge())->getListeTypeConges();
        return view("admin_conge/accueil_conge", compact("listeTypeConges"));
    }

    public function index_liste_demande() {
        $demandes_en_attente = (new Conge())->getListeCongesEnAttente();
        return view("admin_conge/liste_demande", compact("demandes_en_attente"));
    }

    public function index_liste_valider() {
        $demandes_valider = (new Conge())->getListeCongesValider();
        return view("admin_conge/liste_conge_confirmation_depart", compact("demandes_valider"));
    }

    public function index_liste_confirmer_retour() {
        $demandes_retour = (new Conge())->getListeCongesConfirmerRetour();
        return view("admin_conge/liste_conge_confirmation_fin", compact("demandes_retour"));
    }

    // UPDATE
    public function changeStatut($id,$statut){
        $conge = (new Conge())->updateStatutConge($id, $statut);
        return redirect()->route('liste_demande');
    }

    public function getAllConge_one_employer($id_emp){
        $demandes_en_attente = (new Conge())->getListeCongesEnAttente_un_employer($id_emp);
        return view("client_conge/action_conge_subordonnees", compact("demandes_en_attente"));
    }

    public function changeStatut_Subordonnees($id, $statut){
        $conge = (new Conge())->updateStatutConge($id, $statut);
        return redirect()->route('ajout_Conge');
    }

    // INSERTION
    public function insertion_type_conge(Request $request) {
        $nom = $request->input('nom');
        $politique = $request->input('politique');
        $commentaires = $request->commentaires;
        $day_default = $request->input('day_default');
        $type_conge = new Type_Conge($nom, $politique, $commentaires, $day_default);
        $type_conge->insertType_Conge();

        return redirect()->route('accueil_Conge');
    }

    public function insertion_conge(Request $request) {
        try {
            $request->validate([
                'file_justificatif' => 'required|file|max:2048|mimes:pdf' // Max 2MB and only PDF files
            ]);
            
            $typeConge = $request->input('type_conge');
            $raison = $request->raison;
            $dateDebut = $request->input('dateDebut');
            $dateFin = $request->input('dateFin');
            $id_employer = Session::get("employer")->id_emp;
            $statut = 1;
    
            $file_justificatif = null;
            $file_justificatif_name = null;

            if(Session::get("erreur") != ""){
                Session::forget("erreur");
            }
            if((new Conge())->checkIfConge($id_employer) != 0){
                if((new Conge())->getIfNegatif($id_employer, $dateDebut, $dateFin) < 0){
                    Session::put("erreur","Vous ne pouvez pas prendre plus de conge que vous le permez votre solde!");
                    return redirect()->route('ajout_Conge');
                }
                echo "okee";
                if((new Conge())->checkIf_Pouvoir_Demande($dateDebut) == 15200){
                    Session::put("erreur","Vous devez faire une demande de conge 1 mois avant, ou au plus tard 15 jours avant le conge que vous voulez!");
                    return redirect()->route('ajout_Conge');
                }
                if ($request->hasFile('file_justificatif')) {
                    $file_justificatif = $request->file('file_justificatif');
                    $file_justificatif_name = '-2-' . time() . '-' . $file_justificatif->getClientOriginalName();
                    echo '<br>' . $file_justificatif_name;
                    $demande_conge = new Conge($id_employer, $typeConge, $raison, $dateDebut, $dateFin, $statut, $file_justificatif_name);
                    $demande_conge->insertConge();
                    $file_justificatif->storeAs('public', $file_justificatif_name);
                }
                return redirect()->route('ajout_Conge');
            }else{
                Session::put("erreur","Vous n'avez pas encore le droit de faire une demande de conge!");
                return redirect()->route('ajout_Conge');
            }
        }
        catch (Exception $e) {
            echo '<br>Erreur: ' . $e->getMessage();
            return redirect()->route('ajout_Conge');
        }
    }

    // public function test_date(){

    //     // Date d'embauche de l'employé
    //     $dateEmbauche = '2022-01-15';

    //     // Date de fin des congés
    //     $dateFinConges = '2023-01-16'; // 1 an et 1 jour plus tard

    //     // Convertir les dates en instances Carbon
    //     $carbonDateEmbauche = Carbon::parse($dateEmbauche);
    //     $carbonDateFinConges = Carbon::parse($dateFinConges);

    //     // Calculer la différence en jours
    //     $joursDifference = $carbonDateEmbauche->diffInDays($carbonDateFinConges);

    //     // Vérifier si l'employé est éligible pour des congés d'au moins 1 an et 1 jour
    //     if ($joursDifference >= 366) {
    //         // L'employé est éligible pour des congés d'au moins 1 an et 1 jour
    //         echo "L'employé est éligible pour des congés d'au moins 1 an et 1 jour.";
    //     } else {
    //         // L'employé n'est pas éligible pour des congés d'au moins 1 an et 1 jour
    //         echo "L'employé n'est pas éligible pour des congés d'au moins 1 an et 1 jour.";
    //     }

    // }

    public function insertion_confirmation_depart(Request $request) {
        $idconge = $request->input('idconge');
        $depart = $request->input('depart');
        $commentaires = $request->commentaires;
        $confirmation_depart = new Confirmation_date(idConge: $idconge, depart: $depart, commentaires: $commentaires);
        $confirmation_depart->insertConfirmation_depart();

        return redirect()->route('liste_valider');
    }

    public function insertion_confirmation_fin(Request $request) {
        $idconge = $request->input('idconge');
        $fin = $request->input('fin');
        $confirmation_fin = new Confirmation_date(idConge: $idconge, fin: $fin);
        $confirmation_fin->insertConfirmation_fin();

        return redirect()->route('liste_retour');
    }


}
