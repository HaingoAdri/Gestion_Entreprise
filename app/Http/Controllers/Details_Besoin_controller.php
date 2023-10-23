<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Poste;
use App\Models\Service;
use App\Models\Situation_Matrimoniale;
use App\Models\Nationalite;
use App\Models\Diplome;
use App\Models\Region;
use App\Models\Ville;
use App\Models\Besoin;
use App\Models\Details_Besoin_Age;
use App\Models\Details_Besoin_Genre;
use App\Models\Details_Besoin_Nationalite;
use App\Models\Details_Besoin_Experience;
use App\Models\Details_Besoin_Matrimoniale;
use App\Models\Details_Besoin_Salaire;
use App\Models\Details_Besoin_Ville;
use App\Models\Details_Besoin_Region;
use App\Models\Details_Besoin_Diplome;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

class Details_Besoin_controller extends Controller
{

    // INSERTION

    // -- DETAILS
    public function insertion_Details_Age(Request $request) {
        $dernierBesoin = Session::get('dernier_besoin');
        $minAge = $request->input('minAge');
        for($i=0; $i<count($minAge); $i++){
            $min = $minAge[$i];
            $max = $request->input('maxAge')[$i];
            $note = $request->input('noteAge')[$i];
            $details_besoin_age = new Details_Besoin_Age();
            $details_besoin_age->insertDetailsBesoin($dernierBesoin->id, $min, $max, $note);
        }
        return redirect()->route('ajout_details_besoin_genre_matrimoniale');
    }

    public function insertion_Details_Genre_Matrimoniale(Request $request) {
        $dernierBesoin = Session::get('dernier_besoin');
        if($request->has('hommeCheckbox')){
            $noteMasculin = $request->input('noteMasculin');
            (new Details_Besoin_Genre())->insertDetailsBesoinGenre($dernierBesoin->id, 1, $noteMasculin);
        }
        if($request->has('femmeCheckbox')){
            $noteFeminin = $request->input('noteFeminin');
            (new Details_Besoin_Genre())->insertDetailsBesoinGenre($dernierBesoin->id, 10, $noteFeminin);
        }

        $situation = $request->input('situation');
        for($i=0; $i<count($situation); $i++){
            $s = $situation[$i];
            $note = $request->input('note')[$i];
            $details = new Details_Besoin_Matrimoniale();
            $details->insertDetailsBesoinMatrimoniale($dernierBesoin->id, $s, $note);
        }

        return redirect()->route('ajout_details_besoin_nationalite');
    }

    public function insertion_Details_Nationalite(Request $request) {
        $dernierBesoin = Session::get('dernier_besoin');
        $nationalite = $request->input('nationalite');
        for($i=0; $i<count($nationalite); $i++){
            $nation = $nationalite[$i];
            $note = $request->input('note')[$i];
            $details = new Details_Besoin_Nationalite();
            $details->insertDetailsBesoinNationalite($dernierBesoin->id, $nation, $note);
        }
        return redirect()->route('ajout_details_besoin_diplome');
    }

    public function insertion_Details_Diplome(Request $request) {
        $dernierBesoin = Session::get('dernier_besoin');
        $diplome = $request->input('diplome');
        for($i=0; $i<count($diplome); $i++){
            $di = $diplome[$i];
            $note = $request->input('note')[$i];
            $details = new Details_Besoin_Diplome();
            $details->insertDetailsBesoinDiplome($dernierBesoin->id, $di, $note);
        }
        return redirect()->route('ajout_details_besoin_region_ville');
    }

    public function insertion_Details_Region_Ville(Request $request) {
        $dernierBesoin = Session::get('dernier_besoin');

        // -- Region
        $region = $request->input('region');
        $noteRegion = $request->input('noteRegion');
        $details_region = new Details_Besoin_Region();
        $details_region->insertDetailsBesoinRegion($dernierBesoin->id, $region, $noteRegion);
        
        // -- Ville
        $ville = $request->input('ville');
        for($i=0; $i<count($ville); $i++){
            $vi = $ville[$i];
            $noteVille = $request->input('noteVille')[$i];
            $details = new Details_Besoin_Ville();
            $details->insertDetailsBesoinVille($dernierBesoin->id, $vi, $noteVille);
        }

        return redirect()->route('ajout_details_besoin_region_ville');
    }

    public function insertion_Details_Experience(Request $request) {
        $dernierBesoin = Session::get('dernier_besoin');
        $annee = $request->input('anneeExperience');
        for($i=0; $i<count($annee); $i++){
            $di = $annee[$i];
            $note = $request->input('note')[$i];
            $details = new Details_Besoin_Experience();
            $details->insertDetailsBesoinExperience($dernierBesoin->id, $di, $note);
        }
        return redirect()->route('ajout_details_besoin_salaire');
    }

    public function insertion_Details_Salaire(Request $request) {
        $dernierBesoin = Session::get('dernier_besoin');
        $salaireMin = $request->input('minSalaire');
        for($i=0; $i<count($salaireMin); $i++){
            $min = $salaireMin[$i];
            $max = $request->input('maxSalaire')[$i];
            $note = $request->input('noteSalaire')[$i];
            $details = new Details_Besoin_Salaire();
            $details->insertDetailsBesoinSalaire($dernierBesoin->id, $min, $max, $note);
        }
        Session::forget('dernier_besoin');
        return redirect()->route('ajout_besoin');
    }


    // -- JSON
    public function sendVille($idRegion){
        $ville = new Ville();
        $tableVille = $ville->getOneVille($idRegion);
    
        return response()->json(['message' => 'You canmnnnnn', 'data' => $tableVille]);
    }
    
}
