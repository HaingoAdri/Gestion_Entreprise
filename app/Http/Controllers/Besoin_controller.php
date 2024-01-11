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
use App\Models\CV;
use App\Models\Details_Besoin_Age;
use App\Models\Details_Cv_Salaire;
use App\Models\Details_Cv_Fichier;
use App\Models\Details_Besoin_Diplome;
use App\Models\Details_Besoin_Experience;
use App\Models\Details_Besoin_Genre;
use App\Models\Details_Besoin_Matrimoniale;
use App\Models\Details_Besoin_Nationalite;
use App\Models\Details_Besoin_Region;
use App\Models\Details_Besoin_Salaire;
use App\Models\Details_Besoin_Ville;
use App\Models\Note_Cv;
use App\Models\Client;
use App\Models\Type_Contrat;
use App\Models\Article;
use App\Models\BesoinAchat;
use App\Models\Fournisseur;
use App\Models\Demande;
use App\Models\Proformat;
use App\Models\BonCommande;
use App\Models\Compte;
use App\Models\Finance;
use Carbon\Carbon;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Besoin_controller extends Controller
{

    // INDEX
    public function index() {
        $listePostes = (new Poste())->getListePostes();
        $listeServices = (new Service())->getListeServices();
        $listeBesoins = (new Besoin())->getListeBesoins();        
        $listeTypeContrats = (new Type_Contrat())->getListeTypeContrats();
        
        return view("ajout_besoin", compact("listePostes","listeServices","listeBesoins","listeTypeContrats"));
    }

    public function index_age() {
        return view("details_besoin/ajout_details_besoin_age");
    }

    public function index_genre_matrimoniale() {
        $listeSituations = (new Situation_Matrimoniale())->getListeSituation_Matrimoniales();
        
        return view("details_besoin/ajout_details_besoin_genre_matrimoniale", compact("listeSituations"));
    }

    public function index_nationalite() {
        $listeNationalites = (new Nationalite())->getListeNationalites();
        
        return view("details_besoin/ajout_details_besoin_nationalite", compact("listeNationalites"));
    }

    public function index_diplome() {
        $listeDiplomes = (new Diplome())->getListeDiplomes();
        
        return view("details_besoin/ajout_details_besoin_diplome", compact("listeDiplomes"));
    }

    public function index_region_ville() {
        $listeRegions = (new Region())->getListeRegions();
        $listeVilles = (new Ville())->getListeVilles();
        
        return view("details_besoin/ajout_details_besoin_region_ville", compact("listeRegions","listeVilles"));
    }

    public function index_experience() {
        return view("details_besoin/ajout_details_besoin_experience");
    }

    public function index_salaire() {
        return view("details_besoin/ajout_details_besoin_salaire");
    }

    // INSERTION
    public function insertion_Besoin(Request $request) {
        $id_poste = $request->input('poste_id');
        $id_service = $request->input('service_id');
        $horaireBesoin = $request->input('horaireBesoin');
        $tjh = $request->input('tjh');
        $description = $request->input('description');

        $besoin = new Besoin();
        $besoin->insertBesoin($id_poste, $id_service, $horaireBesoin, $tjh, $description);
        return redirect()->route('ajout_details_besoin_age');
    }
    
    public function annonce() {
        $listeRegions = (new Region())->getListeRegions();
        $listeVilles = (new Ville())->getListeVilles();

        $listeSituations = (new Situation_Matrimoniale())->getListeSituation_Matrimoniales();

        $listeNationalites = (new Nationalite())->getListeNationalites();

        $listeDiplomes = (new Diplome())->getListeDiplomes();

        //liste Annonce:
        $listePostes = (new Poste())->getListePostes();
        $listeServices = (new Service())->getListeServices();
        $listeBesoins = (new Besoin())->getListeBesoins();

                
        return view("liste_annonce", compact("listePostes","listeServices","listeBesoins", "listeRegions","listeVilles", "listeSituations", "listeNationalites", "listeDiplomes"));
    }

    public function note_cv($idBesoin, $idNationalite, $idDiplome, $idSituation, $idRegion, $idVille, $experience, $salaire_min, $salaire_max) {
        $idClient = session('client')->id;
        $note = 0;

        $age = (new Client())->ageClient($idClient);
        $note += (new Details_Besoin_Age())->note_age_cv($idBesoin, $age);

        $note += (new Details_Besoin_Diplome())->note_diplome_cv($idBesoin, $idDiplome);

        $note += (new Details_Besoin_Experience())->note_cv_experience($idBesoin, $experience);

        $idGenre = session('client')->genre->id;
        $note += (new Details_Besoin_Genre())->note_genre_cv($idBesoin, $idGenre);

        $note += (new Details_Besoin_Matrimoniale())->note_situation_matrimonial($idBesoin, $idSituation);

        $note += (new Details_Besoin_Nationalite())->note_nationalite_cv($idBesoin, $idNationalite);

        $note += (new Details_Besoin_Region())->note_region_cv($idBesoin, $idRegion);

        $note += (new Details_Besoin_Salaire())->note_salaire_cv($idBesoin, $salaire_min, $salaire_max);

        $note += (new Details_Besoin_Ville())->note_ville_cv($idBesoin, $idVille);

        return $note;
        
    }

    public function ajout_cv(Request $request) {
        try {

            $request->validate([
                'file_diplome' => 'required|file|max:2048', // Limite à 2 Mo (2048 KB)
                'file_attestation' => 'required|file|max:2048'
            ]);
            
            $idBesoin = $request->input('idBesoin');
            $idNationalite = $request->input('idNationalite');
            $idDiplome = $request->input('idDiplome');
            $idRegion = $request->input('idRegion');
            $idVille = $request->input('idVille');
            $experience = $request->input('experience');
            $salaire_min = $request->input('salaire_min');
            $salaire_max = $request->input('salaire_max');
            $idSituation = $request->input('idSituation');
    
            $file_diplome = null;
            $file_attestation = null;
            $file_diplome_name = null;
            $file_attestation_name = null;
            
            $idClient = session('client')->id;
            echo $idClient;

            $cv = new CV($idClient,  $idBesoin, $idDiplome, $experience, $idSituation, $idVille);
            $cv->insert();
            $idCV = session('dernierCV')->id;
            $details_cv_salaire = new Details_Cv_Salaire($idCV, $salaire_min, $salaire_max);
            $details_cv_salaire->insert();

            $note = $this->note_cv($idBesoin, $idNationalite, $idDiplome, $idSituation, $idRegion, $idVille, $experience, $salaire_min, $salaire_max);
            $note_cv = new Note_Cv($idCV, $note);
            $note_cv->insert();
    
            if ($request->hasFile('file_diplome')) {
                $file_diplome = $request->file('file_diplome');
                $file_diplome_name = $idBesoin . '-1-' . time() . '-' . $file_diplome->getClientOriginalName();
                echo '<br>' . $file_diplome_name;
                $details_cv_fichier = new Details_Cv_Fichier($idCV, $file_diplome_name);
                $details_cv_fichier->insertDetails_Cv_Diplome();
                $file_diplome->storeAs('public', $file_diplome_name);
            }
            else  {
                throw new \Exception('Le fichier a telecharger ne doit pas depasser de 2 Mo (2048 KB)');
            }
    
            if ($request->hasFile('file_attestation')) {
                $file_attestation = $request->file('file_attestation');
                $file_attestation_name = $idBesoin . '-2-' . time() . '-' . $file_attestation->getClientOriginalName();
                echo '<br>' . $file_attestation_name;
                $details_cv_fichier = new Details_Cv_Fichier($idCV, $file_attestation_name);
                $details_cv_fichier->insertDetails_Cv_Travail_Anterieur();
                $file_attestation->storeAs('public', $file_attestation_name);
            }
            return redirect()->route('liste_annonce');
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            echo '<br>Erreur: ' . $e->getMessage();
            return redirect()->route('liste_annonce')->with('erreur', $e->getMessage());
        }
    }

    public function besoinAchat() {
        $profil = Session::get('profil');
        $module = null;
        if($profil == 20)
            $module = Session::get("administrateur_rh")->module->id;
        else {
            $employe = Session::get('employer');
            $module = $employe->getModule();
        }
        $listeArticle = (new Article())->getListeArticle();
        $listeBesoinNonValide = (new BesoinAchat(idModule: $module))->getListeBesoinNonValideParModule();
        return View("besoin_achat", compact("listeArticle", "listeBesoinNonValide", "module"));
    }

    public function ajoutBesoinAchat(Request $request) {
        $date = $request->input('date');
        $idModule = $request->input('idModule');
        $idArticle = $request->input('idArticle');
        $quantite = $request->input('quantite');
        $besoinAchat = new BesoinAchat("", $idModule, $idArticle, $quantite, $date, 28);
        $besoinAchat->insert();
        return redirect()->route('besoinAchat');
    }

    public function getListeBesoinAchatNonValide() {
        $listeBesoinNonValide = (new BesoinAchat())->getListeBesoinNonValide();
        return View("achat/liste_besoin_achat", compact("listeBesoinNonValide"));
    }

    public function getDetailsBesoinAchatNonValide() {
        $listeArticle = (new Article())->getListeArticle();
        $listeBesoinNonValide = (new BesoinAchat())->getDetailsBesoinNonValide();
        return View("achat/details_liste_besoin_achat", compact("listeBesoinNonValide"));
    }

    public function refuserUneBesoinAchat(Request $request) {
        $idBesoinAchat = $request->input('idBesoinAchat');
        $besoinAchat = new BesoinAchat(id: $idBesoinAchat);
        $besoinAchat->updateEtat();
        return redirect()->route('detailsBesoinAchat');
    }

    public function faireUnNouveauDemande() {
        $listeFourisseur = (new Fournisseur())->getListeFournisseur();
        $idDemande = (new Demande())->getNextDemande();
        return View("achat/ajout_demande", compact("listeFourisseur", "idDemande"));
    }

    public function createPDF($date, $nom, $idDemande){
        // $listeBesoinNonValide = (new BesoinAchat())->getListeBesoinNonValide();
        // $pdf = PDF::loadView('pdf_test', compact("listeBesoinNonValide", "date", "nom"));
        // $pdf_name = $idDemande.'_demande_de_proforma.pdf';
        // $pdf->save(storage_path('app/public/'.$pdf_name));
        // return $pdf_name;
    }

    public function send_email($file_path, $email, $name) {
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
        $mail->Subject = "Demande de proforma";

        // Content of the proforma request email
        $content = "<p>Bonjour,</p>";
        $content .= "<p>Veuillez trouver ci-joint la demande de proforma. Les détails complets se trouvent dans le fichier PDF attaché.</p>";
        $content .= "<p>Merci de traiter cette demande dès que possible.</p>";

        $mail->MsgHTML($content);

        // Attachment
        $mail->addAttachment($file_path, "Demande_de_proforma.pdf");

        if(!$mail->Send()) {
            Session::flash("erreur", "Erreur lors de l'envoi de l'e-mail.");
        } else {
            Session::flash("success", "Votre e-mail a bien été envoyé! .");
        }

        return redirect()->route('listeDemandeProformat');
    }

    public function demandeProformat(Request $request) { //mandefa email ato
        set_time_limit(120);
        $date = $request->input('date');
        $idDemande = $request->input('idDemande');
        $nom = $request->input('nom');
        $fournisseurs = $request->input('fournisseur');

        $pdf_name = $this->createPDF($date, $nom, $idDemande);

        $path = storage_path('app/public/'.$pdf_name);

        echo count($fournisseurs);

        if(File::exists($path)){

            foreach ($fournisseurs as $fournisseur) {
                $demande = new Demande("", $nom, $date, $idDemande, $fournisseur, 1);
                $demande->insert();
                $fournisseur_un = (new Fournisseur(id: $fournisseur))->getDonneesUnFournisseur();
                $this->send_email($path, $fournisseur_un->email, $fournisseur_un->nom);
            }

        }
            
        (new BesoinAchat())->ajoutIdDemande($idDemande);

        return redirect()->route('listeDemandeProformat');
    }

    public function listeDemandeProformat() {
        $listeDemande = (new Demande())->getListeDemandeEnAttenteDeProformat();
        return View("achat/liste_demande_proformat", compact("listeDemande"));   
    }

    public function detailsDemandeProformat(Request $request) {
        $idDemande = $request->input('idDemande');
        $fournisseurs = (new Demande(idDemande: $idDemande))->getListeFournisseur();
        $articles = (new BesoinAchat())->getListeArticleParDemande($idDemande);
        return View("achat/ajout_proformat", compact("idDemande", "fournisseurs", "articles"));   
    }

    public function ajoutProformat(Request $request) {
        $idDemande = $request->input('idDemande');
        $date = $request->input('date');
        $idFournisseur = $request->input('idFournisseur');
        $idArticle = $request->input('idArticle');
        $prix = $request->input('prix');
        $TVA = $request->input('tva');
        for($i = 0; $i < count($idArticle); $i++) {
            $proformat = new Proformat("", $idDemande, $idFournisseur, $idArticle[$i], $prix[$i], $TVA[$i], $date);
            $proformat->insert();
        }
        return redirect()->action([Besoin_controller::class, 'detailsDemandeProformat'], ['idDemande' => $idDemande]);
    }

    public function tirerUneBonDeCommande(Request $request) {
        $idDemande = $request->input('idDemande');
        $listeProformat = (new Proformat(idDemande: $idDemande))->getListeMeulleurProformat();
        return View("achat/bon_de_commande", compact("idDemande", "listeProformat"));  
    }

    public function genererLaBonDeCommande(Request $request) {
        $idDemande = $request->input('idDemande');
        $date = $request->input('date');
        $delai = $request->input('delai');
        $idPayement = $request->input('idPayement');

        $bonCommande = new BonCommande(date: $date, idPayement: $idPayement, delaiLivarison: $delai, etat: 32);
        $bonCommande->id = $bonCommande->getNextIDCommande();
        $bonCommande->insertBonCommande();

        $listeProformat = (new Proformat(idDemande: $idDemande))->getListeMeulleurProformat();
        for($i = 0; $i < count($listeProformat)-1; $i++) {
            $detailsBonCommande = new BonCommande(id: $bonCommande->id, idProformat: $listeProformat[$i]->id, etat: 8);
            $detailsBonCommande->insertDetailsCommande();
        }

        return redirect()->action([Besoin_controller::class, 'recuUnBonDeCommande'], ['idBonCommande' => $bonCommande->id]);
    }

    public function recuUnBonDeCommande(Request $request) {
        $idBonCommande = $request->input('idBonCommande');
        $bonCommande = new BonCommande(id: $idBonCommande);
        $bonCommande = $bonCommande->getDonneesUnCommande();
        $listeProformat = $bonCommande->getDetailsBonCommande();
        return view("achat/recu_bon_de_commande", compact('bonCommande', 'listeProformat'));
    }

    public function listeBonCommandeEnAttente() {
        $bonCommande = new BonCommande();
        $module = Session::get("administrateur_rh")->module->id;
        if($module == 1)
            $bonCommande->etat = 32;
        else if($module == 7)
            $bonCommande->etat = 35;
        $listeBonCommande = $bonCommande->getListeEnAttente();
        return view('achat/liste_bon_commande', compact('listeBonCommande'));
    }

    public function validerUnBonCommande(Request $request) {
        $idBonCommande = $request->input('idBonCommande');
        $date = $request->input('date');
        $etat = $request->input('etat');
        $bonCommande = new BonCommande(id: $idBonCommande, date: $date);
        $nouveauDate = Carbon::now();
        
        $module = Session::get("administrateur_rh")->module->id;
        if($module == 1)
            $bonCommande->etat = 35;
        else if($module == 7) {
            $bonCommande->etat = 37;
            $idCompte = $request->input('idCompte');
            $compte =new Compte(id: $idCompte);
            if(!$compte->numeroCompteExisteDeja())
                return redirect()->route('listeBonCommandeEnAttente')->with('erreur', "Le numero de compte $idCompte n'existe pas");
            $resteEnCompte = $compte->getResteEnCompte();
            $listeProformat = (new BonCommande(id: $idBonCommande))->getDetailsBonCommande();
            $montant = $listeProformat[count($listeProformat)-1]->prixAT;
            if($resteEnCompte < $montant)
                return redirect()->route('listeBonCommandeEnAttente')->with('erreur', "L'argent dans le compte est insufisant pour cette retrait, le reste en compte est de $resteEnCompte Ar");                
            $finance = new Finance(idCompte: $idCompte, sortie: $montant, explication: "Payement du bon de commande numero $idBonCommande", date: $nouveauDate);
            $finance->insert();
        }
        $bonCommande->valider($nouveauDate, $etat);
        return redirect()->route('listeBonCommandeEnAttente');        
    }

    public function listeBonCommandeApasser() {
        $bonCommande = new BonCommande();
        $bonCommande->etat = 37;
        $listeBonCommande = $bonCommande->getListeEnAttente();
        return view('achat/liste_bon_commande', compact('listeBonCommande'));
    }

    public function passerUnBonCommande(Request $request) {
        $idBonCommande = $request->input('idBonCommande');
        $date = $request->input('date');
        $etat = $request->input('etat');
        $bonCommande = new BonCommande(id: $idBonCommande, date: $date, etat: 40);
        $nouveauDate = Carbon::now();
        $bonCommande->valider($nouveauDate, $etat);
        return redirect()->route('listeBonCommandeApasser');   
    }

    public function listeBonCommandeEnCours() {
        $bonCommande = new BonCommande();
        $listeBonCommande = $bonCommande->getListeEnCours();
        return view('achat/liste_bon_commande', compact('listeBonCommande'));
    }






}
