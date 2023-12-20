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

use Barryvdh\DomPDF\Facade\Pdf;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Bon_controller extends Controller
{

    public function show_bon_de_livraison(){
        $bon_commande_en_cours = (new BonCommande())->getListeEnCours();
        return view("bon/bon_de_livraison_form", compact("bon_commande_en_cours"));
    }

    public function show_bon_de_reception(){
        $bon_commande_en_cours = (new BonCommande())->getListeEnCours();
        return view("bon/bon_de_reception_form", compact("bon_commande_en_cours"));
    }

    public function restesArticlesAVAliderPourCeBonCommande($numero, $bonCommande){
        $resultat = array();

        $listeProformat = $bonCommande->getDetailsBonCommande();
        $dansBonReception = (new BonReception(id_bon_commande: $numero))->getDetailsBonReceptionValiderPourUnBonCommande();

        $idArticles = [];
        foreach ($dansBonReception as $objet) {
            $idArticles[] = $objet->id_article;
        }

        for ($i=0; $i < count($listeProformat) - 1; $i++) { 
            if(count($idArticles) > 0){
                if(!in_array($listeProformat[$i]->idArticle, $idArticles)){
                    echo "Bebeeeeeee ".$listeProformat[$i]->idArticle."\n";
                    $resultat[] = $listeProformat[$i];
                }
            }else{
                return $listeProformat;
            }
        }

        $resultat[] = $listeProformat[count($listeProformat)-1];

        // var_dump($resultat);
        return $resultat;
    }

    public function create_bon_de_reception(Request $request){
        $resultat = array();
        $resultat["date"] = $request->input('date');
        $resultat["lieu"] = $request->input('lieu');
        $resultat["numero"] = $request->input('numero');

        $bonCommande = new BonCommande(id: $resultat["numero"]);
        $bonCommande = $bonCommande->getDonneesUnCommande();
        $listeProformat = $this->restesArticlesAVAliderPourCeBonCommande($resultat["numero"], $bonCommande);

        // var_dump($listeProformat);

        return view("bon/bon_de_reception", compact("resultat", "bonCommande","listeProformat"));
    }

    public function send_email($reclamation, $email, $name) {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";

        $mail->SMTPDebug  = 0;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "layahanjaratiana877@gmail.com";
        $mail->Password   = "myoq cybw mrhc mias";

        $mail->IsHTML(true);
        $mail->AddAddress($email, $name);
        $mail->Subject = "Reclamation";

        // Content of the proforma request email
        $content = "<p>Bonjour,</p>";
        $content .= "<p>J'aimerais faire une reclamation pour certaines produits qui ne correspondent pas au bon de commande que je vous ai fait parvenir.";
        $content .= "<ul><li>".$reclamation->getArticle()." pour quantites = ".$reclamation->quantite." </li></ul>";
        $content .= "<p>Merci de prendre en consideration cette demande le plus rapidement possible.</p>";

        $mail->MsgHTML($content);

        if(!$mail->Send()) {
            Session::flash("erreur", "Erreur lors de l'envoi de l'e-mail.");
        } else {
            Session::flash("success", "Votre e-mail a bien été envoyé! .");
        }

        return redirect()->route('listeDemandeProformat');
    }

    public function insertReception($lieu, $date, $id_bon_commande){
        $resultat = null;
        $bonReception = new BonReception(id_bon_commande: $id_bon_commande);
        if(($bonReception->ifExist()) != null){
            $resultat = $bonReception->ifExist();
        } else {
            $bonReception->id = $bonReception->getNextIDReception();
            $bonReception->lieu = $lieu;
            $bonReception->date = $date;
            $bonReception->id_recepteur = Session::get('administrateur_rh')->id;
            $bonReception->etat = 32;
            $bonReception->insertBonReception();
            $resultat = $bonReception;
        }
        return $resultat;
    }

    public function insertDetailsReception($reception, $details){
        $details = new Details_Bon_Reception(id_bon_reception: $reception->id, id_article: $details->idArticle, id_fournisseur: $details->idFournisseur, date: $reception->date, etat: 32);
        $details->insertDetailsBonReception();
    }

    public function checkArticleNonValide($article_non_valide){
        if(count($article_non_valide) > 0){
            // var_dump($resultat);
            foreach ($article_non_valide as $article) {
                $fournisseur = (new Fournisseur(id: $article->idFournisseur))->getDonneesUnFournisseur();
                $this->send_email($article, $fournisseur->email, $fournisseur->nom);
            }

            Session::flash("erreur", "La reclamation a bien ete faite!");
        }else{
            echo "nety eeeeeeeeeeeeeeeeeee!";
            Session::flash("success", "Tout a bien ete livre en heure et en temps, avec toutes les articles commandes pour la bonne quantite!");
        }
    }

    public function terminerBonCommande($numero){

        $bonCommande = new BonCommande(id: $numero);
        $bonCommande = $bonCommande->getDonneesUnCommande();
        $resultat = $this->restesArticlesAVAliderPourCeBonCommande($numero, $bonCommande);
        if(count($resultat) == 1){
            $bonCommande->etat = 45;
            $bonCommande->valider();
        }

        return redirect()->route('bon_de_reception_form');
    }

    public function create_facture($numero){
        $bonCommande = new BonCommande(id: $numero);
        $bonCommande = $bonCommande->getDonneesUnCommande();
        $resultat = $this->restesArticlesAVAliderPourCeBonCommande($numero, $bonCommande);
        if(count($resultat) == 1){
            return redirect()->route('create_facture_livraison', ['idBonCommande' => $numero]);
        }
    }

    public function validation_bon_reception(Request $request){

        $numero = $request->input('numero');

        $bonCommande = new BonCommande(id: $numero);
        $bonCommande = $bonCommande->getDonneesUnCommande();
        $listeProformat = $bonCommande->getDetailsBonCommande();

        $reception = $this->insertReception($request->input('lieu'),$request->input('date'),$numero);

        $article_non_valide = array();
        $temp = 0;
        for($i=0; $i<count($listeProformat) -1 ; $i++){
            $isChecked = $request->has('article_'.$listeProformat[$i]->id);
            if($isChecked != 1){
                $article_non_valide[$temp] = $listeProformat[$i];
                $temp ++;
            }else if($isChecked == 1){
                $this->insertDetailsReception($reception, $listeProformat[$i]);
            }
        }

        $this->checkArticleNonValide($article_non_valide);

        // $this->terminerBonCommande($numero, $bonCommande);

        $resultat = $this->restesArticlesAVAliderPourCeBonCommande($numero, $bonCommande);
        if(count($resultat) == 1){
            return redirect()->route('create_facture_livraison', ['idBonCommande' => $numero]);
        }else{
            return redirect()->route('bon_de_reception_form');
        }

    }

    public function create_facture_livraison($idBonCommande){
        $bonCommande = new BonCommande(id: $idBonCommande);
        $bonCommande = $bonCommande->getDonneesUnCommande();
        $listeProformat = $bonCommande->getDetailsBonCommande();
        return view("bon/facture", compact('bonCommande', 'listeProformat'));
    }

    public function create_bon_de_livraison(Request $request){

        $resultat = array();
        $resultat["date"] = $request->input('date');
        $resultat["lieu"] = $request->input('lieu');
        $resultat["numero"] = $request->input('numero');
        $resultat["livreur"] = $request->input('livreur');
        $resultat["information"] = $request->information;

        $bonCommande = new BonCommande(id: $resultat["numero"]);
        $bonCommande = $bonCommande->getDonneesUnCommande();
        $listeProformat = $this->restesArticlesAVAliderPourCeBonCommande($resultat["numero"], $bonCommande);

        return view("bon/bon_de_livraison", compact("resultat"));
    }

    public function export_PDF($idBonCommande){
        set_time_limit(240);
        $bonCommande = new BonCommande(id: $idBonCommande);
        $bonCommande = $bonCommande->getDonneesUnCommande();
        $listeProformat = $bonCommande->getDetailsBonCommande();
        $pdf = PDF::loadView('bon/pdf_facture', compact("bonCommande", "listeProformat"));
        $pdf_name = $idBonCommande.'_PDF.pdf';
        $pdf->save(storage_path('app/public/'.$pdf_name));
        return redirect()->route('bon_de_reception_form');
    }

}
