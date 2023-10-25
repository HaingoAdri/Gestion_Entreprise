<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Administrateur;
use App\Models\Client;
use App\Models\Module;
use App\Models\Note_Cv;
use App\Models\Besoin;
use App\Models\CV;
use App\Models\Question_poses;
use App\Models\Qcm_Admis;
use App\Models\Reponse_Faux;
use App\Models\Reponse_Vrai;
use App\Models\Qcm_Result;
use App\Models\Afaka_Qcm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Tester_Qcm_Controller extends Controller
{
    
    public function faire_Qcm() {
        $note_cv = new Note_Cv();
        $besoin = new Besoin();
        $cv = new CV();
        $question_posee = new Question_poses();
        $faux = new Reponse_Faux();
        $vrai = new Reponse_Vrai();
        $qcm_admis = new Qcm_Admis();
        $listeQuestion = new Question_poses();
        $listesNote = $note_cv->getDetailNote();
        $listeBesoin = $besoin->getListeBesoins();
        $listeCv = $cv->selectCV();
        $listesd = array();
        $listeQuestions = array();
        $listeVrai = array();
        $listeFaux = array();
        foreach($listesNote as $notes){
            foreach($listeCv as $cv){
                if($notes->idCV == $cv->id){
                    if($notes->note >= 25){
                        $liste_qcm = $qcm_admis->getQcmByAnnonce($cv->idbesoin);
                        $listesd = $liste_qcm;
                        foreach($liste_qcm as $ls){
                            $qust =  $listeQuestion->getQcmByQcmId($ls->id_qcm);
                            $listeQuestions = $qust;
                            foreach($qust as $qs){
                                $listeV = $vrai->getReponseVraiByQuestion($qs->id_q);
                                $listeF = $faux->getReponseFauxByQuestion($qs->id_q);
                                $listeVrai[] = $listeV;
                                $listeFaux[] = $listeF;
                            }
                        }
                    }
                }
            }      
        }
        // var_dump($listeVrai[1][0]);
        // var_dump($listeFaux);
        return view("qcm/test_qcm", compact("listesd","listeQuestions","listeVrai","listeFaux"));
    }

    public function insererResultatQcm(Request $request) {
        $qcm = $request->input('qcm');
        $vrai = $request->input('marina');
        $diso = $request->input('diso');
        $question = $request->input('question');
        
        $qcm_result = new Qcm_Result();
        $l_vrai = new Reponse_Vrai();
        
        $totalPoints = 0;
        $linesCorrect = 0; 
            for ($i = 0; $i < count($vrai); $i++) {
                // Obtenir les réponses vraies pour la question en cours
                $listV = $l_vrai->getReponseVraiByQuestion($question[$i]);
                
                // Vérifier si la réponse de l'utilisateur est correcte
                if (in_array($vrai[$i], array_column($listV, 'reponse'))) {
                    // La réponse est correcte, ajouter des points (ajuster le calcul des points selon vos besoins)
                    if ($linesCorrect > 0) {
                        // Si au moins une ligne est correcte, attribuer 5 points
                        $totalPoints += 5;
                    } else {
                        // Sinon, attribuer la note normale
                        $totalQuestionPoints = 0;
                        foreach ($listV as $reponse) {
                            $totalQuestionPoints += $reponse->note; // Utilisation de la syntaxe de point pour accéder à la propriété 'note'
                        }
                        $totalPoints += $totalQuestionPoints;
                    }
                    
                    // Incrémenter le nombre de lignes correctes
                    $linesCorrect++;
                }
            }

        for ($i = 0; $i < count($question); $i++) {
            try {
                $qcm_result = new Qcm_Result(qcm: $qcm[$i], notes_r: $totalPoints);
                $insererResultat = $qcm_result->insert(); // Insérez les données dans la base de données ici
            } catch (\Exception $e) {
                // Gérer l'exception ici, par exemple, en journalisant l'erreur ou en renvoyant un message d'erreur à l'utilisateur
                return "Erreur lors de l'insertion dans la base de données : " . $e->getMessage();
            }
        }
        // Maintenant, $totalPoints contient la note totale du QCM
        $qcm_admis = new Qcm_Admis();
        $listesd = array();
        
        return view('qcm/confirmation_test');
    }

    public function afaka_Qcm($qcm){
        $qcm_result = new Qcm_Result();
        $afaka_qcm = new Afaka_Qcm();
        
        $listeVita = $qcm_result->getQcmResult($qcm);
        foreach($listeVita as $listes){
            if($listes->notes_r >= 10){
                $client = Session::get('client');
                $clientId = $client->id;
                var_dump($clientId);
                var_dump($listes->qcm);
                $afaka_qcm->insert($listes->id_r, $clientId);
                var_dump($afaka_qcm);
            }
        }
        return view("qcm/tafiditre");
    }
    
}