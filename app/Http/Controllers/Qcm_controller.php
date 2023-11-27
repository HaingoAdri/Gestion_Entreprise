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
use App\Models\Qcm_Admis;
use App\Models\Question_poses;
use App\Models\Reponse_Faux;
use App\Models\Reponse_Vrai;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class Qcm_controller extends Controller
{
    public function index(){
       echo "hello";
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

                
        return view("insert_qcm", compact("listePostes","listeServices","listeBesoins", "listeRegions","listeVilles", "listeSituations", "listeNationalites", "listeDiplomes"));
    }

    public function insertQcm(Request $rest){
        try{
            $annonce = $rest->input('besoin');
            $qcm_noms = $rest->input('qcm');
            $descriptions = $rest->input('description');
            $durer = $rest->input('durer');
            $note = $rest->input('note');
            $qcm_inserer = new Qcm_Admis();
            $qcm_inserer->insert($qcm_noms,$descriptions,$durer,$annonce,$note);
            return redirect()->route('qcm_avoaka');
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function allQcmSelect(){
        $listeQcm = (new Qcm_Admis())->allQcm();
        return view("qcm/qcm",compact("listeQcm"));
    }

    public function insererQuestionQcm(Request $rest){
        try {
            $questions = $rest->input('questions');
            $idqcm = $rest->input('annonce'); // Supposons que l'ID du QCM est le même pour toutes les questions
            $Question_poses = new Question_poses();
            $Question_poses -> insert($questions,$idqcm);
            return redirect()->route('listeQcm');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function mampiditraReponseByQuestions($idqcm){
        $quest = (new Question_poses()) -> getQcmByQcmId($idqcm);
        $idqq = session()->get('idqcm');
        return view ('qcm/reponse_qcm', compact('idqq','quest'));
    }

    public function mampiditraReponse(Request $request){
        try{
            $listeQcm = (new Qcm_Admis())->allQcm();
            $reponse_v = $request->input('reponseVrai');
            $reponse_f = $request->input('reponseFaux');
            $question = $request->input('annonce');
            $faux = new Reponse_Faux();
            $vrai = new Reponse_Vrai();
            $faux->insert($question,$reponse_f);
            $vrai->insert($question,$reponse_v);
            return view("qcm/qcm",compact("listeQcm"));
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function getFunctionByQuestion($idQuestion){
        $res = (new Reponse_Vrai())->getReponseVraiByQuestion($idQuestion);
        $reponse = (new Reponse_Faux())->getReponseFauxByQuestion($idQuestion);
        return view("qcm/reponse_details", compact('res','reponse'));
    }
    
}