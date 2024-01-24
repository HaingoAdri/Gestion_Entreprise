<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Categorie;
use App\Models\Description;
use Carbon\Carbon;

class Immobilier_controller extends Controller
{

    public function index(Request $request) {
        $descriptions = array();
        $idCategorie = $request->input('idCategorie');
        $categorie = new Categorie(id: $idCategorie);
        if($idCategorie != "") {
            $categorie = $categorie->getDonneesUncategorie();
        }
        $listeCategorie = $categorie->getListecategorie();
        return view ("immobilisation/description", compact("listeCategorie", "categorie"));
    }

    public function ajoutDescripcion(Request $request) {
        $idCategorie = $request->input('idCategorie');
        $descriptions = $request->input('description');
        for($i = 0; $i < count($descriptions); $i++) {
            $description = new Description(description: $descriptions[$i]);
            $description->ajouter($idCategorie);
        }
        return redirect()->action([Immobilier_controller::class, 'index'], ['idCategorie' => $idCategorie]); 
    }

    public function listeCategorie() {
        $listeCategorie = (new Categorie())->getListecategorie();
        return view ("immobilisation/categorie", compact("listeCategorie"));
    }

    public function ajoutCatgeorie(Request $request) {
        $id = $request->input('id');
        $idCategorie = $request->input('categorie');

        $categorie = new Categorie($id, $nom);
        if($categorie->isCategorieExisteDeja())
            return redirect()->route('listeCategorie')->with('erreur', "Le nom de categorie $nom existe deja!");
        if($categorie->getDonneesUncategorie() != null)
            return redirect()->route('listeCategorie')->with('erreur', "L'ID categorie $id existe deja!");
        $categorie->insert();
        return redirect()->route('listeCategorie');
    }

    public function listeTypeImmobilisation(Request $request) {
        $idType = $request->input('idType');
        $type = new Compte(id: $idType);
        $types = $type->getListeTypeImmobilisation();
        $listeCategorie = (new Categorie())->getListecategorie();
        if($idType != "")
            $type = $type->getDonneesUnTypeImmobilisation();
        return view("immobilisation/liste_type_immobilisation", compact("types", "listeCategorie", "type"));
    }

    public function ajoutSousCategorie(Request $request) {
        $idType = $request->input('idType');
        $idCategorie = $request->input('idCategorie');
        $categorie = (new Categorie(id: $idCategorie))->getUnCategorie();    
        $compte = (new Compte(id: $idType))->getCompte();
        if($compte->isSousCategorieExisteDeja($idCategorie))
            return redirect()->action([Immobilier_controller::class, 'listeTypeImmobilisation'], ['idType' => $idType])->with('erreur', "Le categorie $categorie->categorie est deja un sous categorie de $compte->nom");
        $categorie->ajoutType($compte->id);
        return redirect()->action([Immobilier_controller::class, 'listeTypeImmobilisation'], ['idType' => $idType]); 

    }

    public function nouveauTypeImmobilisation(Request $request) {
        $id = $request->get('id');
        $nom = $request->get('nom');
        $compte = new Compte($id, $nom, 8);
        if($compte->numeroCompteExisteDeja())
            return redirect()-action([Immobilier_controller::class, 'listeTypeImmobilisation'], ['idType' => $id])->with('erreur', "Le numero de compte immobilisation $id existe deja!");
        $compte->insert();
        return redirect()->action([Immobilier_controller::class, 'listeTypeImmobilisation'], ['idType' => $id]); 
    }

}
