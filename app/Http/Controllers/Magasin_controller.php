<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Caisse;
use App\Models\Magasin;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

use Barryvdh\DomPDF\Facade\Pdf;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Magasin_controller extends Controller
{

    public function index(){
        $magasin = new Magasin();
        $listeMagasin = $magasin->getListeMagasin();
        return view("magasin/magasin", compact('listeMagasin'));
    }

    public function nouveauMagasin(Request $request){
        $nom = $request->get('nom');
        $lieu = $request->get('lieu');
        $date = $request->get('date');
        $magasin = new Magasin(nom: $nom, lieu: $lieu, date: $date);
        if($magasin->nomExisteDeja())
            return redirect()->route('magasin')->with('erreur', "Le nom de magasin $nom existe deja!");
        $magasin->insert();
        return redirect()->route('magasin');
    }

    public function voirCaisseMagasin(Request $request) {
        $idMagasin = $request->get('idMagasin');
        $magasin = new Magasin();
        $listeMagasin = $magasin->getListeMagasin();
        if($idMagasin != "") {
            $magasin->id = $idMagasin;
            $magasin = $magasin->getMagasin();
        } else {
            $magasin = null;
        }
        return view("magasin/caisse_magasin", compact('listeMagasin', 'magasin'));
    }

    public function nouveauCaisseMagasin(Request $request) {
        $idMagasin = $request->get('idMagasin');
        $idCaisse = $request->get('idCaisse');
        $caisse = new Caisse(id: $idCaisse);
        if(!$caisse->caisseExisteDeja()) {
            return redirect()->route('voirCaisseMagasin', ['idMagasin' => $idMagasin])->with('erreur', "Le numero de caisse: $idCaisse n'existe pas!");
        }
        (new Magasin(id: $idMagasin))->ajoutCaisse($idCaisse);
        return redirect()->route('voirCaisseMagasin', ['idMagasin' => $idMagasin]);

    }
    

}
