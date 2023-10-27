<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employer;
use App\Models\Pointage;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

class Pointage_controller extends Controller
{

    // INDEX
    public function index() {
        $listes_employer = (new Employer())->getListe_personnels();
        $listes_pointages = (new Pointage())->getListePointages();

        return view("ajout_pointage", compact("listes_employer","listes_pointages"));
    }

    public function insert_pointage(Request $request) {
        $administrateur = Session::get('administrateur_rh');
        $employer = $request->input('employer');
        $date = $request->input('pointage_date');
        $type_de_pointage = $request->input('type_de_pointage');
        $type_jour_nuit = $request->input('type_jour_nuit');

        // var_dump($administrateur);
        // echo $employer;
        $pointage = new Pointage(id_employer: $employer, date: $date, etat: $type_de_pointage, jour_nuit: $type_jour_nuit, securite: $administrateur->id);
        $pointage->insert();
        
        return redirect()->route('index_pointage');
    }

}
