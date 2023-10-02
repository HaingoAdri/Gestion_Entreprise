<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Administrateur;
use App\Models\Module;
use Illuminate\Support\Facades\DB; // Importez la classe DB

class Connexion_controller extends Controller
{
    public function index() {
        $module = new Module();
        $listeModules = $module->getListeModules();
        return view("connexion", compact("listeModules"));
    }

    public function authentification_connexion(Request $request) {
        $module = new Module();
        $listeModules = $module->getListeModules();

        $administrateur = new Administrateur();
        $email = $request->input('email');
        $mot_de_passe = $request->input('mot_de_passe');
        $connecteur = $administrateur->getAdministrateur($email, $mot_de_passe);
        if($connecteur != null){
            return view('accueil');
        }
        return view("connexion", compact("listeModules"));
    }
}
