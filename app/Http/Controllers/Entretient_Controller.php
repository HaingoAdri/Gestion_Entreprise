<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Afaka_Qcm;
use App\Models\Entretient;
use App\Models\Ok_Vita;
use App\Models\Etats;
use App\Models\Tafiditra_Mpiasa;
use App\Models\Salaire;
use App\Models\Employer;
use App\Models\Historique_embauche;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

class Entretient_Controller extends Controller
{

    // INDex
    public function index() {
       $afaka_qcm = (new Afaka_Qcm())->getListeSituation_Matrimoniales();
   
        return view("insert_entretient", compact("afaka_qcm"));
    }

    public function insert(Request $request){
        $afaka = $request->input('afaka_qcm');
        $lieu = $request->input('lieu');
        $dure = $request->input('heure');
        $dates = $request->input('dates');
        $entretient = new Entretient(aa: $afaka, dates: $dates, heures: $dure, lieu: $lieu);
        $entretient->insert();
        return redirect()->route('liste_entretient');
    }

    public function allEntretient(){
        $entretients = (new Entretient())->getEntretientAa();
        $etats = (new Etats())->getEtats();
        return view("entretient/entretient", compact("entretients", "etats"));
    }

    public function inserer_Ok_Vita_Entretient(Request $request){
        $etats = $request->input('etats');
        $entretient = $request->input('entretients'); 
        $date = $request->input('dates');
        $salaire_brute = $request->input('salaire_brut');
        $salaire_net = $request->input('salaire_net');
        $qcm = $request->input('qcm_afaka');

        if($etats == 15 || $etats == 20 || $etats == 8 || $etats == 12){
            $afaka = (new Afaka_Qcm())->getAfakaByUser($qcm);
            foreach($afaka as $aa){
                 $emp = new Employer(idClient: $aa->id_users, etat: $etats);
                 $emp->id_emp = $emp->getNextId();
                 $emp->insert();

                $historique = (new Historique_embauche(id_emp:$emp->id_emp ,date:$date  ,etat:$etats))->insert();

                $salaire = (new Salaire(id_emp:$emp->id_emp, brut:$salaire_brute, net: $salaire_net, date:$date ))->insert();

                $ok = new Ok_Vita(id_e:$entretient , id_et:$etats );
                $ok->insert();
                
                $ok_vita = (new Ok_Vita())->getOk_VitaAa($entretient);
                $tafa = new Tafiditra_Mpiasa(id_ok: $ok_vita[0]->id_o, date: $date);
                $tafa->insert();
            }
           return redirect()->back()->with('success','Information insérée avec succès.');
        }
        
    }

    
}
