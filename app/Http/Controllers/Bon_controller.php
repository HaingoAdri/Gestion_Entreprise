<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BonCommande;
use App\Models\Fournisseur;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

class Bon_controller extends Controller
{

    public function show_bon_de_livraison(){
        return view("bon/bon_de_livraison_form");
    }

    public function show_bon_de_reception(){
        $bon_commande_en_cours = (new BonCommande())->getListeEnCours();
        return view("bon/bon_de_reception_form", compact("bon_commande_en_cours"));
    }

    public function create_bon_de_livraison(Request $request){

        $resultat = array();
        $resultat["date"] = $request->input('date');
        $resultat["lieu"] = $request->input('lieu');
        $resultat["numero"] = $request->input('numero');
        $resultat["livreur"] = $request->input('livreur');
        $resultat["information"] = $request->information;

        // var_dump($resultat);

        return view("bon/bon_de_livraison", compact("resultat"));
    }

    public function create_bon_de_reception(Request $request){
        $resultat = array();
        $resultat["date"] = $request->input('date');
        $resultat["lieu"] = $request->input('lieu');
        $resultat["numero"] = $request->input('numero');

        $bonCommande = new BonCommande(id: $resultat["numero"]);
        $bonCommande = $bonCommande->getDonneesUnCommande();
        $listeProformat = $bonCommande->getDetailsBonCommande();

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
        $content .= "<ul><li></li></ul>";
        $content .= "<p>Merci de prendre en consideration cette demande le plus rapidement possible.</p>";

        $mail->MsgHTML($content);

        if(!$mail->Send()) {
            Session::flash("erreur", "Erreur lors de l'envoi de l'e-mail.");
        } else {
            Session::flash("success", "Votre e-mail a bien été envoyé! .");
        }

        return redirect()->route('listeDemandeProformat');
    }

    public function validation_bon_reception(Request $request){

        $bonCommande = new BonCommande(id: $request->input('numero'));
        $bonCommande = $bonCommande->getDonneesUnCommande();
        $listeProformat = $bonCommande->getDetailsBonCommande();

        $article_non_valide = array();
        $temp = 0;
        for($i=0; $i<count($listeProformat) -1 ; $i++){
            $isChecked = $request->has('article_'.$listeProformat[$i]->id);
            if($isChecked != 1){
                $article_non_valide[$temp] = $listeProformat[$i];
                $temp ++;
            }
        }

        $collection = collect($article_non_valide);

        if(count($collection) > 0){
            $resultat = $collection->groupBy("idFournisseur");
            // var_dump($resultat);
            foreach ($resultat as $idFournisseur => $articles) {
                $fournisseur = (new Fournisseur(id: $idFournisseur->idFournisseur))->getDonneesUnFournisseur();
                $this->send_email($idFournisseur, $fournisseur->email, $fournisseur->nom);
            }

            Session::flash("erreur", "La reclamation a bien ete faite!");
        }else{
            echo "nety eeeeeeeeeeeeeeeeeee!";
            Session::flash("success", "Tout a bien ete livre en heure et en temps, avec toutes les articles commandes pour la bonne quantite!");
        }

        return redirect()->route('bon_de_reception_form');

    }

}
