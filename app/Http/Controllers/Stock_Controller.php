<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

use App\Models\BonReception;
use App\Models\Article;
use App\Models\Module;
use App\Models\Entre;
use App\Models\Explication;
use App\Models\Sortie;
use App\Models\Sortie_Vente;
use App\Models\Sortie_Departement;
use App\Models\Historique;
use App\Models\BesoinAchat;

class Stock_Controller extends Controller
{
    public function show_entrer_manuelle(){
        $listebonReception = (new BonReception())->getAllReception();
        $listeArticle = (new Article)->getListeArticle();
        $listeModule = (new Module())->getListeModules();
        return view("stock/entre_manuele",compact("listebonReception","listeArticle","listeModule"));
    }

    public function show_entrer_checkBox(){
        $listeEntre = (new Entre())->getReceptionDetails();
        $listebonReception = (new BonReception())->getAllReception();
        $listeArticle = (new Article)->getListeArticle();
        return view("stock/entre_checkBox",compact("listeEntre","listebonReception","listeArticle"));
    }

    public function show_historique(){
        $listeHistorique = (new Historique())->getHistorique();
        return view("stock/historique",compact("listeHistorique"));
    }

    public function show_liste_stock(){
        $listeEntre = (new Entre())->getAllEntre();
        return view("stock/liste_stock",compact("listeEntre"));
    }

    public function show_recherche_stock(){
        $listeArticle = (new Article)->getListeArticle();
        $listeEntre = (new Entre())->getAllEntre();
        return view("stock/recherche_stock",compact("listeEntre","listeArticle"));
    }

    public function show_sortie_stock(){
        $listeArticle = (new Article)->getListeArticle();
        $listeType = (new Sortie())->getTypesSortie();
        return view("stock/sortie_simple",compact("listeArticle","listeType"));
    }

    public function show_liste_sortie_stock(){
        $listeSortie = (new Sortie())->getAllSortie();
        return view("stock/liste_sortie", compact("listeSortie"));
    }

    public function show_liste_vente(){
        $listeVente = (new Sortie_Vente())->getSortieVente();
        return view("stock/liste_vente",compact("listeVente"));
    }

    public function show_recherche_vente(){
        $listeArticle = (new Article)->getListeArticle();
        return view("stock/recherche_vente",compact("listeArticle"));
    }

    public function trouverStock(Request $request){
        $article = $request->input('article');
        $date = $request->input('date');
        $datefin = $request->input('datefin');
        $getEntre = (new Entre())->rechercheEntre($article,$date,$datefin);
        return Redirect::route('recherche_stock')->with('result',$getEntre);
    }

    public function show_liste_departement(){
        $listeDepart = (new Sortie_Departement())->getSortie_Departement();
        return view("stock/dispatch_departement",compact("listeDepart"));
    }

    public function liste_explication_stock(){
        $listExplication = (new Explication())->getAllExplication();
        return view("stock/voir_explication",compact("listExplication"));
    }

    // insertion 
    public function insertion_Entre_Check_Box(Request $request){
        $check = $request->input('valider');
        $idArray = $request->input('id');
        $datesArray = $request->input('dates');
        $articleArray = $request->input('article');
        $quantiteArray = $request->input('quantite');
        $prixUnitaireArray = $request->input('prix_unitaire');
        $moduleArray = $request->input('module');
        $demandearray =$request->input('demande');

        foreach($check as $index => $valeur) {
            // Utilisez les tableaux correspondants pour accéder aux valeurs des champs hidden
            $id = $idArray[$index];
            $dates = $datesArray[$index];
            $article = $articleArray[$index];
            $quantite = $quantiteArray[$index];
            $prixUnitaire = $prixUnitaireArray[$index];
            $module = $moduleArray[$index];
            $demande = $demandearray[$index];

            $entre = new Entre(dates: $dates,reception: $id,article: $article,quantite: $quantite,prix_unitaire: $prixUnitaire, module: $module);
            $besoin_achat = new BesoinAchat(etat: 50);
            $besoin_achat->updateEtatBesoin_Achat($module,$article,$demande);
            $entre->insertEntre();
            //echo $id." , ".$dates." , ".$article." , ".$quantite." , ".$prixUnitaire." , ".$module."<br>";
            
            // Faites le traitement nécessaire avec les données
        }
        try {
            $entre->insertEntre(); 
            return redirect()->route('entre_checkBox')->with('success','Insertion finit avec succes !');
        } catch (Exception $e) {
            return redirect()->route('entre_checkBox')->with('error','Erreur pour insertion entre '.$e->getMessage());
        }
    }

    public function insert_Entre_Manuelle(Request $request){
        $dates = $request->input('date');
        $reception = $request->input('reception');
        $article = $request->input('article');
        $quantite = $request->input('quantite');
        $prix = $request->input('prix');
        $module = $request->input('depart');
        $entre = new Entre(dates: $dates,reception: $reception,article: $article,quantite: $quantite,prix_unitaire: $prix, module: $module);
        try {
            $entre->insertEntre(); 
            return redirect()->route('entre_manuelle')->with('success','Insertion finit avec succes !');
        } catch (Exception $e) {
            return redirect()->route('entre_manuelle')->with('error','Erreur pour insertion entre '.$e->getMessage());
        }
           
    }

    public function insertSortie(Request $request){
        $date = $request->input('dates');
        $quantite = $request->input('quantite');
        $article = $request->input('article');
        $type = $request->input('sortie_type');
        $lieu = $request->input('lieu');
        $sortie_caisse = $request->input('numero');
        $articleSafidy = (new Article())->getArticleMethod($article);
        if($articleSafidy[0]->method == 1){
            if($type == 1){
                $listeEntres = (new Entre())->getEntreMethodFifo($article);
                foreach($listeEntres as $listeEntre){
                    if($listeEntre->quantite < $quantite){
                        return redirect()->route('sortie_stock')->with('error', 'La quantité est insuffisante.');
                    }else{

                            $quantites = $listeEntre->quantite - $quantite;
                            $sortie = new Sortie(dates:$date,entre:$listeEntre->id,article:$article,quantite:$quantite,types:$type);
                            $sortie->insertSortie();
                            $historique = (new Historique(dates:$listeEntre->dates,entre:$listeEntre->id,article:$listeEntre->article,quantite:$listeEntre->quantite))->insertHistorique();
                            $entre = (new Entre())->updateEntre($quantites,$listeEntre->id,$date);
                            $sortieMety = (new Sortie())->makaSortie($listeEntre->id);
                            foreach($sortieMety as $sorties){
                                $sortieDepartement = (new Sortie_Departement(sortie_details: $sorties->id, module: $listeEntre->module))->insertSotrieDepartement();
                                return redirect()->route('sortie_stock')->with('success', 'Sortie departement finit');
                            }
                    }
                }
            }
            else if($type == 2){
                $listeEntreAchat = (new Entre())->getEntreMethodFifoAchat($article);
                if(count($listeEntreAchat) == 0){
                    return redirect()->route('sortie_stock')->with('error', 'Le produits que vous inserer n appartient pas aux departement achat le produits doit etre aux departement achat.');
                }else{
                
                    foreach($listeEntreAchat as $achat){
                        if($achat->quantite < $quantite){
                            return redirect()->route('sortie_stock')->with('error', 'La quantité est insuffisante.');
                        }else{
                            
                                $quantites = $achat->quantite - $quantite;
                                $sortie = new Sortie(dates:$date,entre:$achat->id,article:$article,quantite:$quantite,types:$type);
                                $sortie->insertSortie();
                                $historique = (new Historique(dates:$achat->dates,entre:$achat->id,article:$achat->article,quantite:$achat->quantite))->insertHistorique();
                                $entre = (new Entre())->updateEntre($quantites,$achat->id,$date);
                                $tva = 2;
                                $sortieMety = (new Sortie())->makaSortie($achat->id);
                                foreach($sortieMety as $sorties){
                                    $sortieVente = (new Sortie_Vente(sortieDetails:$sorties->id, prix_unitaire:$achat->prix_unitaire, tva:$tva,lieu_vente:$lieu,numero:$sortie_caisse))->insertSortieVente();
                                    return redirect()->route('sortie_stock')->with('success', 'Sortie vente finit');
                                }
                            
                        }
                    }
                }
            }
            // var_dump($listeEntres);
        }else if($articleSafidy[0]->method == 2){
            if($type == 1){
                $listeEntres = (new Entre())->getEntreMethodLifo($article);
                foreach($listeEntres as $listeEntre){
                    if($listeEntre->quantite < $quantite){
                        return redirect()->route('sortie_stock')->with('error', 'La quantité est insuffisante.');
                    }else{

                            $quantites = $listeEntre->quantite - $quantite;
                            $sortie = new Sortie(dates:$date,entre:$listeEntre->id,article:$article,quantite:$quantite,types:$type);
                            $sortie->insertSortie();
                            $historique = (new Historique(dates:$listeEntre->dates,entre:$listeEntre->id,article:$listeEntre->article,quantite:$listeEntre->quantite))->insertHistorique();
                            $entre = (new Entre())->updateEntre($quantites,$listeEntre->id,$date);
                            $sortieMety = (new Sortie())->makaSortie($listeEntre->id);
                            foreach($sortieMety as $sorties){
                                $sortieDepartement = (new Sortie_Departement(sortie_details: $sorties->id, module: $listeEntre->module))->insertSotrieDepartement();
                                return redirect()->route('sortie_stock')->with('success', 'Sortie departement finit');
                            }
                    }
                }
            }
            else if($type == 2){
                $listeEntreAchat = (new Entre())->getEntreMethodLifoAchat($article);
                if(count($listeEntreAchat) == 0){
                    return redirect()->route('sortie_stock')->with('error', 'Le produits que vous inserer n appartient pas aux departement achat le produits doit etre aux departement achat.');
                }else{
                
                    foreach($listeEntreAchat as $achat){
                        if($achat->quantite < $quantite){
                            return redirect()->route('sortie_stock')->with('error', 'La quantité est insuffisante.');
                        }else{
                            
                                $quantites = $achat->quantite - $quantite;
                                $sortie = new Sortie(dates:$date,entre:$achat->id,article:$article,quantite:$quantite,types:$type);
                                $sortie->insertSortie();
                                $historique = (new Historique(dates:$achat->dates,entre:$achat->id,article:$achat->article,quantite:$achat->quantite))->insertHistorique();
                                $entre = (new Entre())->updateEntre($quantites,$achat->id,$date);
                                $tva = 2;
                                $sortieMety = (new Sortie())->makaSortie($achat->id);
                                foreach($sortieMety as $sorties){
                                    $sortieVente = (new Sortie_Vente(sortieDetails:$sorties->id, prix_unitaire:$achat->prix_unitaire, tva:$tva,lieu_vente:$lieu,numero:$sortie_caisse))->insertSortieVente();
                                    return redirect()->route('sortie_stock')->with('success', 'Sortie vente finit');
                                }
                            
                        }
                    }
                }
            }
            
            // var_dump($listeEntres);
        }
    }
    public function insertExplication(Request $request){
        $dates = $request->input('dates');
        $reception = $request->input('id');
        $article = $request->input('article');
        $quantite = $request->input('quantite');
        $motif = $request->input('motif');
        $module = $request->input('module');

        $explication = (new Explication(motif:$motif,module:$module,dates:$dates, reception:$reception,article : $article, quantite:$quantite));
        try {
            $explication->insertExplications();
            return redirect()->route('entre_checkBox')->with('success','Insertion finit avec succes !');
        } catch (Exception $e) {
            return redirect()->route('entre_checkBox')->with('error','Erreur pour insertion entre '.$e->getMessage());
        }
        
    }
}