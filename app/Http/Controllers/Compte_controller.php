<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Details_Bon_Reception;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

use Barryvdh\DomPDF\Facade\Pdf;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Compte_controller extends Controller
{

    public function index(){
        $listeCompte = (new Compte())->getListeCompte();
        return view("finance/compte", compact("listeCompte"));
    }

    public function ajoutCompte(Request $request){
        $id = $request->get('id');
        $nom = $request->get('nom');
        $compte = new Compte($id, $nom, 8);
        // try{
        //     $compte->insert();
        // }
        // catch(Exception $e){
        //     return redirect()->route('listeCompte')->with('erreur', e->getMessage());
        // }
        if($compte->numeroCompteExisteDeja())
            return redirect()->route('listeCompte')->with('erreur', "Le numero de compte $id existe deja!");
        $compte->insert();
        return redirect()->route('listeCompte');
    }

}
