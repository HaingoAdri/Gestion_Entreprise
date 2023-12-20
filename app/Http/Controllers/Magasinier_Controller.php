<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Models\Mouvement;
use App\Models\Article;
use App\Models\Entre;
use App\Models\BesoinAchat;
use App\Models\Proformat;
use App\Models\BonCommande;
use App\Models\BonReception;
use App\Models\Sortie;
use App\Models\Historique_entre;


class Magasinier_Controller extends Controller
{
    public function index(){
        $entre = new Entre();
        $listeEntre = $entre->maka_entre();
        return view("magasinier/entre",  compact("listeEntre"));
    }

    public function bon_de_sortie(){
        $articles = new Article();
        $mouvements = new Mouvement();
        $sortie = new Sortie();
        $listeArticle = $articles->getListeArticle();
        $types = $mouvements->getType_Sortie();
        $allSorties = $sortie->getSortie();
        return view("magasinier/formulaire", compact("listeArticle", "types", "allSorties"));
    }

    public function insertSortie(Request $request){
        $dates = $request->input('date');
        $produit = $request->input('produits');
        $quantites = $request->input('quantite');
        $method = $request->input('sortie');
        $produits  = (new Article())->getArticleMethod($produit);
        
        foreach($produits as $pr){
            if($pr->types == 'FIFO'){
                $listeEntreLifo = (new Entre())->getEntreFifo($produit);
                foreach($listeEntreLifo as $fifo){
                    if($fifo->quantite<$quantites) return redirect()->route('bon_de_sortie')->with('error', 'La quantité est insuffisante.');
                    else if($fifo->quantite > $quantites){
                        $e = $fifo->ide; 
                        
                        $sorties = new Sortie($dates, $produit, $e, $quantites, $method);
                        $sorties->insert();
                        $historique = new Historique_entre($fifo->date, $fifo -> ide , $produit,$fifo->quantite ,$fifo->prixunitaire);
                        $historique->insertBonReception();
                        $entre = new Entre();
                        $reste = $fifo->quantite-$quantites; 
                        $entre->update_Entre($reste, $dates, $e);
                        return redirect()->route('bon_de_sortie')->with('success', 'Sortie finit');
                    }

                }
            }else{
                $listeEntreFifo = (new Entre())->getEntreLifo($produit);
                foreach($listeEntreFifo as $lifo){
                    if($lifo->quantite<$quantite) return redirect()->route('bon_de_sortie')->with('error', 'La quantité est insuffisante.');
                    if($lifo->quantite>$quantite){
                        $e = $lifo->ide; 
                        
                        $sorties = new Sortie($dates, $produit, $e, $quantites, $method);
                        $sorties->insert();
                        $historique = new Historique_entre($lifo->date, $lifo -> ide , $produit,$lifo->quantite ,$lifo->prixunitaire);
                        $historique->insertBonReception();
                        $entre = new Entre();
                        $reste = $fifo->quantite-$quantites; 
                        $entre->update_Entre($reste, $dates, $e);
                        return redirect()->route('bon_de_sortie')->with('success', 'Sortie finit');
                    }
                }
            }
        }
        
        //return redirect()->route('bon_de_sortie');
    }
    
}
?>