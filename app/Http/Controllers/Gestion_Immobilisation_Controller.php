<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Pv_Reception;
use App\Models\Pv_Utilisation;
use App\Models\Etat_immobilisation;
use App\Models\Details_pv_utilisation;
use App\Models\Inventaire;
use App\Models\Immobilisation_reception;
use App\Models\Employer;
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
        $reception = (new Pv_Utilisation())->getImmobilisation();
        $listeEtat = (new Etat_immobilisation())->getAllEtats();
        return view("immobilisation/pv_utilisation_validation", compact("reception","listeEtat"));
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
            $date = $request->input('date.'.$index);
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
            $immobilisation = (new Immobilisation_reception())->getUnImmobilisationReception($article);
            $pv_reception = (new Pv_Reception($immobilisation[0]->id_pv_reception))->getReception();
            for($i=0; $i<count($pv_reception); $i++){
                $inventaire = new Inventaire(date:$date, immobilisation:$article, etat_immobilisation:$pv_reception[$i]->id_etat_immobilisation, description:$description, taux:$pv_reception[$i]->taux, ammortissement:$pv_reception[$i]->id_type_ammortissement, type_inventaire:"Pv utilisation premiere utilisation",libele:"Pv utilisation premiere usage du materiel");
                $inventaire->insert();
            }
            
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
