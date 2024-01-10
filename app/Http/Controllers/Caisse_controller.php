<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Caisse;
use App\Models\Compte;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

use Barryvdh\DomPDF\Facade\Pdf;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Caisse_controller extends Controller
{

    public function index(){
        $caisse = new Caisse();
        $listeCaisse = $caisse->getListeCaisse();
        return view("finance/caisse", compact('listeCaisse'));
    }

    public function nouveauCaisse(Request $request){
        $nom = $request->get('nom');
        $idCompte = $request->get('idCompte');
        $caisse = new Caisse(nom: $nom, idCompte: $idCompte);
        if($caisse->nomCaisseExisteDeja())
            return redirect()->route('caisse')->with('erreur', "Le nom de caisse: $nom existe deja!");
        if(!((new Compte(id: $idCompte))->numeroCompteExisteDeja()))
            return redirect()->route('caisse')->with('erreur', "Le numero de compte $idCompte n'existe pas encore!");
        if($caisse->compteCaisseExisteDeja())
            return redirect()->route('caisse')->with('erreur', "Le numero de compte $idCompte appartient deja a une autre caisse!");
        $caisse->insert();
        return redirect()->route('caisse') ;
    }
    

}
