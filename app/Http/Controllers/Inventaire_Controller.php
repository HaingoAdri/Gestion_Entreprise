<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Pv_Reception;
use App\Models\Pv_Utilisation;
use App\Models\Etat_immobilisation;
use App\Models\Details_pv_utilisation;
use App\Models\Immobilisation_reception;
use App\Models\Inventaire;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

use Barryvdh\DomPDF\Facade\Pdf;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Inventaire_Controller extends Controller
{

    public function formulaire_inventaire(){
        $listeImmo = (new Immobilisation_reception())->getAllImmobilisation_reception();
        $listeAmmortissement = (new Immobilisation_reception())->getAllAmmortissement();
        $listeEtats = (new Etat_immobilisation())->getAllEtats();
        return view("immobilisation/faire_inventaire", compact("listeImmo","listeEtats","listeAmmortissement"));
    }

    public function insert_Inventaire(Request $request){
        $date = $request->input('dates');
        $immo = $request->input('immobilisation');
        $etat = $request->input('etat');
        $taux = $request->input('taux');
        $ammortissement = $request->input('ammortissement');
        $type = $request->input('type');
        $libele = $request->input('libele');
        $description = $request->input('description');
        $inventaire = new Inventaire(date:$date, immobilisation:$immo, etat_immobilisation:$etat, description:$description, taux:$taux, ammortissement:$ammortissement, type_inventaire:$type, libele:$libele);
        $inventaire->insert();
        return redirect()->route('faire_inventaire');
    }

    public function liste_Inventaire(){
        $listeInventaire = (new Inventaire())->getListeinventaire();
        return view("immobilisation/inventaire", compact("listeInventaire"));
    }
}
