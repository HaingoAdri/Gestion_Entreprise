<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Pv_Reception;
use App\Models\Pv_Utilisation;
use App\Models\Etat_immobilisation;
use App\Models\Details_pv_utilisation;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

use Barryvdh\DomPDF\Facade\Pdf;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Gestion_Immobilisation_Controller extends Controller
{

    public function show_pv_utilisation(){
        $module = new Module();
        $listeModules = $module->getListeModules();
        $pv_reception = (new Pv_Reception())->getListeReception();
        return view("immobilisation/pv_utilisation", compact("listeModules", "pv_reception"));
    }

    public function insert_demande_pv_utlisation(Request $request){
        $date = $request->input('dates');
        $reception = $request->input('reception');
        $immobilisation = $request->input('module');
        $id = (new Pv_Utilisation())->getNextIDPvUtilsation();
        $pv_utilisation = new Pv_Utilisation(id:$id, dates:$date, reception:$reception, module:$immobilisation);
        $pv_utilisation->insert_Pv_utilisation();
        $listeImmo = $pv_utilisation->getImmobilisationFromPv($reception);
        $listeEtat = (new Etat_immobilisation())->getAllEtats();
        return view("immobilisation/pv_utilisation_validation" , compact("listeImmo", "listeEtat","date","reception","id"));
    }

    public function insert_Details_demande_utilisation(Request $request)
    {
         // Récupérer les indices des cases cochées
        $checkedIndexes = $request->input('c', []);

        // Créer une liste pour stocker les détails
        $detailsList = [];

        // Parcourir les indices des cases cochées et récupérer les données correspondantes
        foreach ($checkedIndexes as $index) {
            // Récupérer les données associées à l'index
            $id = $request->input('id.' . $index);
            $article = $request->input('article.' . $index);
            $etat = $request->input('etats.' . $index);
            $description = $request->input('description.' . $index);

            // Créer un nouvel objet Details_pv_utilisation
            $details = new Details_pv_utilisation(
                pv_utilisation:$id,
                immobilisation :$article,
                description: $description,
                etat_immobilisation :$etat
            );
            $details->insertDetails_pv_utilisation();
            // Ajouter l'objet à la liste
            $detailsList[] = $details;
        }
        return redirect()->route('demande_pv_utilisation');
    }

    public function liste_Demande(){
        $listeDemande = (new Pv_Utilisation())->get_demande_utilisation();
        return view("immobilisation/validation_utilisation", compact("listeDemande"));
    }

    public function valider_demande(Request $request){
        $checkedIndexes = $request->input('c', []);
        foreach ($checkedIndexes as $index) {
            $id = $request->input('id.' . $index);
            $new_details = (new Details_pv_utilisation())->updateDetails_Utilisation($id);
        }
        return redirect()->route('liste_demande_pv_utilisation');
    }
}
