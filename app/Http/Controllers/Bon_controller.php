<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use App\Models\Employer;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

class Bon_controller extends Controller
{

    public function show_bon_de_livraison(){
        return view("bon/bon_de_livraison_form");
    }

    public function show_bon_de_reception(){
        return view("bon/bon_de_reception_form");
    }

    public function create_bon_de_livraison(Request $request){

        $resultat = array();
        $resultat["date"] = $request->input('date');
        $resultat["lieu"] = $request->input('lieu');
        $resultat["numero"] = $request->input('numero');
        $resultat["livreur"] = $request->input('livreur');
        $resultat["information"] = $request->information;

        return view("bon/bon_de_livraison", compact("resultat"));
    }

    public function create_bon_de_reception(Request $request){
        $resultat = array();
        $resultat["date"] = $request->input('date');
        $resultat["lieu"] = $request->input('lieu');
        $resultat["numero"] = $request->input('numero');

        return view("bon/bon_de_reception", compact("resultat"));
    }

}
