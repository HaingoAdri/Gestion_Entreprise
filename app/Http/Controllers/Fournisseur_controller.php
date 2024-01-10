<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Fournisseur;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

class Fournisseur_controller extends Controller
{

    // INDEX
    public function index() {       
        $listeFourisseur = (new Fournisseur())->getListeFournisseur();
        return view("fournisseur", compact("listeFourisseur"));
    }

    public function ajoutFournisseur(Request $request) {
        $nom = $request->input('nom');
        $email = $request->input('email');
        $adresse = $request->input('adresse');
        $telephone = $request->input('telephone');
        $responsable = $request->input('responsable');
        $fournisseur = new Fournisseur("", $nom, $email, $adresse, $telephone, $responsable);
        $fournisseur->insert();
        return redirect()->route('listeFournisseur');
    }

    

}
