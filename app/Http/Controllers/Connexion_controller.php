<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Administrateur;
use App\Models\Client;
use App\Models\Employer;
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
        $idModule = $request->input('module');
        $connecteur = $administrateur->getAdministrateur($email, $mot_de_passe, $idModule);
        if($connecteur != null){
            Session::put('administrateur_rh', $connecteur);
            Session::put('profil', 20); //profil: 20 ==> Admin
            var_dump($connecteur);
            // return view('accueil');
        }
        $erreur = "Email ou Mot de passe incorrect";
        return redirect()->route('connexion')->with([
            'erreur' => $erreur,
            'email' => $email,
            'mot_de_passe' => $mot_de_passe,
        ]);
        
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
            Session::put('client', $connecteur);
            Session::put('profil', 5); //profil: 5 ==> Client

            if(((new Employer())->checkIfEmployer($connecteur->id)) != null) {
                Session::put('employer', (new Employer())->checkIfEmployer($connecteur->id));
            }else{
                Session::put('employer', 'null');
            }
            return view('accueil');
        }
        $erreur = "Email ou Mot de passe incorrect";
        // return view("login", compact("erreur", "email", "mot_de_passe"));
        return redirect()->route('login')->with([
            'erreur' => $erreur,
            'email' => $email,
            'mot_de_passe' => $mot_de_passe,
        ]);
    }

    public function deconnect(){
        // Pour détruire une seule clé de session
        // Session::forget('nom_de_la_cle');

        // Pour détruire toutes les données de session
        Session::flush();
        return redirect()->route('login');
    }
}
