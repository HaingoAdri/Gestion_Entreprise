<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BonCommande;
use App\Models\Fournisseur;
use App\Models\BonReception;
use App\Models\Details_Bon_Reception;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

class Ammortissement_controller extends Controller
{

    public function show_form(){
        $bon_commande_en_cours = (new BonCommande())->getListeEnCours();
        return view("immobilisation/ammortissement_form");
    }

    
    public function voir_ammortissement(Request $request){
        $annee = $request->input('annee');
        $reference = $request->input('reference');

        $tableau = array();

        return view("immobilisation/tableau_ammortissement", compact("tableau"));
    }

}
