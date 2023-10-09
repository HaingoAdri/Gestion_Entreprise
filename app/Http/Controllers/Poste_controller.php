<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Poste;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

class Poste_controller extends Controller
{
    public function index() {
        $poste = new Poste();
        $listePostes = $poste->getListePostes();

        $session = Session::get('administrateur_rh');

        return view('ajout_poste', compact("listePostes"));
    }

    public function insertPoste(Request $request) {
        $Poste_name = $request->input('poste_name');

        $Poste = new Poste();
        $Poste->insertPoste($Poste_name);

        return redirect()->route('ajout_poste');
    }
}
