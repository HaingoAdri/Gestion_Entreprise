<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Afaka_Qcm;
use App\Models\Entretient;
use App\Models\Ok_Vita;
use App\Models\Etats;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

class Entretient_Controller extends Controller
{

    // INDex
    public function index() {
       $afaka_qcm = (new Afaka_Qcm)->getListeSituation_Matrimoniales();
       
        return view("insert_entretient", compact("afaka_qcm"));
    }

    public function insert(Request $request){
        $afaka = $request->input('afaka_qcm');
        $lieu = $request->input('lieu');
        $dure = $request->input('heure');
        $dates = $request->input('dates');
        $entretient = new Entretient(aa: $afaka, dates: $dates, heures: $dure, lieu: $lieu);
        $entretient->insert();
        return redirect()->route('entretient');
    }

    public function allEntretient(){
        $entretients = (new Entretient())->getEntretientAa();
        $etats = (new Etats())->getEtats();
        return view("entretient/entretient", compact("entretients", "etats"));
    }

    public function inserer_Ok_Vita_Entretient(Request $request){
        $etats = $request->input('etats');
        $entretient = $request->input('entretients');
        $ok = new Ok_Vita(id_e:$entretient , id_et:$etats );
        $ok->insert();
        return redirect()->route('liste_entretient');
    }
    
}
