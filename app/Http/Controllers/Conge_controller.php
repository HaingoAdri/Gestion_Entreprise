<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Poste;
use App\Models\Client;
use App\Models\Type_Conge;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;

class Conge_controller extends Controller
{

    // INDEX
    public function index_employe() {
        $listeTypeConges = (new Type_Conge())->getListeTypeConges();
        return view("client_conge/demande_conge", compact("listeTypeConges"));
    }

    public function index_accueil_conge() {
        $listeTypeConges = (new Type_Conge())->getListeTypeConges();
        return view("admin_conge/accueil_conge", compact("listeTypeConges"));
    }

    public function index_liste_demande() {
        return view("admin_conge/liste_demande");
    }

    // INSERTION
    public function insertion_type_conge(Request $request) {
        $nom = $request->input('nom');
        $politique = $request->input('politique');
        $commentaires = $request->commentaires;
        $type_conge = new Type_Conge($nom, $politique, $commentaires);
        $type_conge->insertType_Conge();

        return redirect()->route('accueil_Conge');
    }

    public function insertion_conge(Request $request) {
        try {
            $request->validate([
                'file_justificatif' => 'required|file|max:2048' // Limite à 2 Mo (2048 KB)
            ]);
            
            $typeConge = $request->input('typeConge');
            $raison = $request->raison;
            $dateDebut = $request->input('dateDebut');
            $dateFin = $request->input('dateFin');
            $id_employer = Session::get("employer")->id_emp;
            $statut = 1;
    
            $file_justificatif = null;
            $file_justificatif_name = null;

            if((new Employer())->checkIfConge($id_employer) != 0){
                if ($request->hasFile('file_justificatif')) {
                    $file_justificatif = $request->file('file_justificatif');
                    $file_justificatif_name = $idBesoin . '-2-' . time() . '-' . $file_justificatif->getClientOriginalName();
                    echo '<br>' . $file_justificatif_name;
                    $demande_conge = new Conge($id_employer, $typeConge, $raison, $dateDebut, $dateFin, $statut, $file_justificatif_name);
                    $demande_conge->insertConge();
                    $file_justificatif->storeAs('public', $file_justificatif_name);
                }
                return redirect()->route('ajout_Conge');
            }else{
                Session::put("erreur","Vous n'avez pas encore le droit de faire une demande de conge!");
            }
        }
        catch (Exception $e) {
            echo '<br>Erreur: ' . $e->getMessage();
            return redirect()->route('ajout_Conge');
        }
    }

    public function test_date(){

        // Date d'embauche de l'employé
        $dateEmbauche = '2022-01-15';

        // Date de fin des congés
        $dateFinConges = '2023-01-16'; // 1 an et 1 jour plus tard

        // Convertir les dates en instances Carbon
        $carbonDateEmbauche = Carbon::parse($dateEmbauche);
        $carbonDateFinConges = Carbon::parse($dateFinConges);

        // Calculer la différence en jours
        $joursDifference = $carbonDateEmbauche->diffInDays($carbonDateFinConges);

        // Vérifier si l'employé est éligible pour des congés d'au moins 1 an et 1 jour
        if ($joursDifference >= 366) {
            // L'employé est éligible pour des congés d'au moins 1 an et 1 jour
            echo "L'employé est éligible pour des congés d'au moins 1 an et 1 jour.";
        } else {
            // L'employé n'est pas éligible pour des congés d'au moins 1 an et 1 jour
            echo "L'employé n'est pas éligible pour des congés d'au moins 1 an et 1 jour.";
        }

    }


}
