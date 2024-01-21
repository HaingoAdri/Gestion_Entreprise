<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Compte;
use Carbon\Carbon;

class Immobilier_controller extends Controller
{

    public function index(Request $request) {
        $descriptions = array();
        $type = $request->input('type');
        $compte = new Compte(id: $type);
        if($type != "") {
            $descriptions = $compte->getListeDescription();
        }
        $types = $compte->getListeTypeImmobilisation();
        return view ("immobilisation/description", compact("types", "descriptions"));
    }

    public function ajoutDescripcion(Request $request) {
        $type = $request->input('type');
        $descriptions = $request->input('description');
        $compte = new compte(id: $type);
        for($i = 0; $i < count($descriptions); $i++) {
            $compte->description = $descriptions[$i];
            $compte->ajoutDescription();
        }
        return redirect()->action([Immobilier_controller::class, 'index'], ['type' => $type]); 
    }

}
