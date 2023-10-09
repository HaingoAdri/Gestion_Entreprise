<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use App\Models\Module;
use App\Models\Administrateur;
use App\Models\Client;
use App\Controllers\Connexion_controller;

class Inscription_controller extends Controller
{
    public function index() {
        $module = new Module();
        $listeModules = $module->getListeModules();
        return view("inscription", compact("listeModules"));
    }

    public function authentification_inscription(Request $request) {
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $email = $request->input('email');
        $module = $request->input('module');
        $mot_de_passe = $request->input('mot_de_passe');
        $cmot_de_passe = $request->input('cmot_de_passe');

        if($mot_de_passe == $cmot_de_passe){
            $administrateur = new Administrateur();
            $administrateur->insertAdministrateur($nom, $prenom, $email, $mot_de_passe, $module);
            return redirect()->route('connexion');
        }

        return redirect()->route('inscription');
    }

    public function inscription() {
        return view("inscription_client");
    }

    public function inscription_client(Request $request) {
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $email = $request->input('email');
        $date_naissance = $request->input('date_naissance');
        $idGenre = $request->input('idGenre');
        $mot_de_passe = $request->input('mot_de_passe');
        $cmot_de_passe = $request->input('cmot_de_passe');

        if($mot_de_passe == $cmot_de_passe){
            $client = new Client();
            $client->insertClient($nom, $prenom, $email, $mot_de_passe,  $date_naissance, $idGenre);
            return redirect()->route('login');
        }

        return redirect()->route('inscription');
    }
}
