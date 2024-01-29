<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Pv_Reception;
use App\Models\Pv_Utilisation;
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

    public function pv_besoin_de_validation(){
        return view("immobilisation/pv_utilisation_validation");
    }

    public function insert_demande_pv_utlisation(Request $request){
        $date = $request->input('dates');
        $reception = $request->input('reception');
        $immobilisation = $request->input('module');
        $pv_utilisation = new Pv_Utilisation(dates:$date, reception:$reception, module:$immobilisation);
        $pv_utilisation->insert_Pv_utilisation();
        return redirect()->route('demande_pv_utilisation');
    }
}
