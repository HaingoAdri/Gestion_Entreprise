<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Finance;
use App\Models\Details_Bon_Reception;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

use Barryvdh\DomPDF\Facade\Pdf;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Tresorier_controller extends Controller
{

    public function index(){
        $finance = new Finance();
        $listeCompte = $finance->getListeResteEnCompte();
        $total = $finance->total;
        return view("finance/tresorier", compact('listeCompte', 'total'));
    }

    public function mouvement(Request $request){
        $date = $request->get('date');
        $idCompte = $request->get('idCompte');
        $montant = $request->get('montant');
        $type = $request->get('type');
        $explication = $request->get('explication');
        $compte = new Compte(id: $idCompte);
        $mouvement = new Finance(idCompte: $idCompte, explication: $explication, date: $date);
        if(!$compte->numeroCompteExisteDeja())
            return redirect()->route('tresorier')->with('erreur', "Le numero de compte $idCompte n'existe pas!");
        if($type == 5)
            $mouvement->entre = $montant;
        else if($type == 1) {
            $mouvement->sortie = $montant;
            if(!$mouvement->checkArgentDisponisble())
                return redirect()->route('tresorier')->with('erreur', "Vous ne pouvez pas effectue cette sortie, le reste de montant dans le numero de compte $idCompte est de $mouvement->reste Ar");
        }
        $mouvement->insert();
        return redirect()->route('tresorier');
    }

}
