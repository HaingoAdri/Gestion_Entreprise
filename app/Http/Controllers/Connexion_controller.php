<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Administrateur;
use App\Models\Client;
use App\Models\Module;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

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
            Session::put('administrateur_rh', $connecteur);
            return view('accueil');
        }
        return view("connexion", compact("listeModules"));
    }

    public function login() {
        return view('login');
    }

    public function authentification_client(Request $request) {
        $Client = new Client();
        $email = $request->input('email');
        $mot_de_passe = $request->input('mot_de_passe');
        $connecteur = $Client->getClient($email, $mot_de_passe);
        if($connecteur != null){
            return view('accueil');
        }
        $erreur = "Email ou Mot de passe incorrect";
        return view("login", compact($erreur));
    }
}
